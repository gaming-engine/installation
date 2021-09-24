import { shallowMount } from '@vue/test-utils';
import Wizard from './Wizard.vue';

describe('Wizard', () => {
  const steps = [
    { identifier: 'foo', is_complete: false },
    { identifier: 'bar', is_complete: false },
    { identifier: 'foobar', is_complete: false },
  ];

  describe('created', () => {
    it('defaults the current to the first step', () => {
      const { vm } = shallowMount(Wizard, {
        props: {
          steps,
        },
      });

      expect(vm.current).toEqual(steps[0]);
    });

    it('defaults all of the statuses', () => {
      const { vm } = shallowMount(Wizard, {
        props: {
          steps,
        },
      });

      expect(vm.statuses).toEqual({
        foo: false,
        bar: false,
        foobar: false,
      });
    });
  });

  describe('computed', () => {
    describe('step width', () => {
      it.each`
                stepList | columnTotal
                ${1}     | ${3}
                ${2}     | ${3}
                ${3}     | ${3}
                ${4}     | ${3}
                ${5}     | ${2}
            `(
        'will set up the $columnTotal columns when $stepList are provided',
        ({ stepList, columnTotal }) => {
          const { vm } = shallowMount(Wizard, {
            props: {
              steps: [...Array(stepList)].map((i) => ({
                identifier: `identifier-${i}`,
                is_complete: true,
              })),
            },
          });

          expect(vm.stepWidth).toBe(columnTotal);
        },
      );
    });

    describe('has previous step', () => {
      it('is says there is not a previous step when you are at the first step',
        () => {
          const { vm } = shallowMount(Wizard, {
            props: {
              steps,
            },
          });

          expect(vm.hasPreviousStep).toBe(false);
        });

      it('is says there is a previous step when you are at the second step',
        () => {
          const { vm } = shallowMount(Wizard, {
            props: {
              steps,
            },
          });
          [, vm.current] = steps;

          expect(vm.hasPreviousStep).toBe(true);
        });
    });

    describe('has next step', () => {
      it('if you only have one step, you do not have a next step', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps: [steps[0]],
          },
        });

        expect(vm.hasNextStep).toBe(false);
      });

      it(
        `if there are multiple steps, and you are at the beginning,
        then you will see more`,
        () => {
          const { vm } = shallowMount(Wizard, {
            props: {
              steps,
            },
          });

          expect(vm.hasNextStep).toBe(true);
        },
      );

      it(
        `if there are multiple steps, and you are at the end,
         then you will not see any`,
        () => {
          const { vm } = shallowMount(Wizard, {
            props: {
              steps,
            },
          });
          [, , vm.current] = steps;

          expect(vm.hasNextStep).toBe(false);
        },
      );

      it(
        `if there are multiple steps, and you are in the middle,
         then you will see more`,
        () => {
          const { vm } = shallowMount(Wizard, {
            props: {
              steps,
            },
          });
          [, vm.current] = steps;

          expect(vm.hasNextStep).toBe(true);
        },
      );
    });

    describe('can go to next step', () => {
      it('is false if the current step is not complete', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        expect(vm.canGoToNextStep).toBe(false);
      });

      it('is false if there are no other steps', () => {
        const [singleStep] = steps;

        const { vm } = shallowMount(Wizard, {
          props: {
            steps: [singleStep],
          },
        });

        expect(vm.canGoToNextStep).toBe(false);
      });

      it('is true if there are other steps and the current is complete', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        vm.statuses.foo = true;

        expect(vm.canGoToNextStep).toBe(true);
      });
    });

    describe('current index', () => {
      it('returns -1 if the step is not found', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        vm.current = { identifier: 'bad' };

        expect(vm.currentIndex).toBe(-1);
      });

      it('finds the index of the the step is present', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        vm.current = { identifier: 'bar' };

        expect(vm.currentIndex).toBe(1);
      });
    });

    describe('next step', () => {
      it('if there are no items it will return -1', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps: [],
          },
        });

        expect(vm.nextStep).toBe(-1);
      });

      it('if there are no incomplete items it will return -1', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps: [{ identifier: 'foo', is_complete: false }],
          },
        });

        vm.statuses.foo = true;

        expect(vm.nextStep).toBe(-1);
      });

      it('if the first item is incomplete, it will return 0', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        expect(vm.nextStep).toBe(0);
      });

      it(`if another element is incomplete,
       it will return the related index`, () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        vm.statuses.foo = true;

        expect(vm.nextStep).toBe(1);
      });
    });
  });

  describe('methods', () => {
    describe('change to next step', () => {
      it('does nothing if the current step is incomplete', () => {
        // Arrange
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        vm.statuses.foo = false;

        // Act
        vm.changeToNextStep();

        // Assert
        expect(vm.currentIndex).toBe(0);
      });

      it('moves to the next step if the current step is complete', () => {
        // Arrange
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        vm.statuses.foo = true;

        // Act
        vm.changeToNextStep();

        // Assert
        expect(vm.currentIndex).toBe(1);
      });
    });

    describe('change to previous step', () => {
      it('does nothing if you are on the first step', () => {
        // Arrange
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });
        [vm.current] = steps;

        // Act
        vm.changeToPreviousStep();

        // Assert
        expect(vm.currentIndex).toBe(0);
      });

      it('moves to the previous step when it exists', () => {
        // Arrange
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });
        [, vm.current] = steps;

        // Act
        vm.changeToPreviousStep();

        // Assert
        expect(vm.currentIndex).toBe(0);
      });
    });

    describe('is step complete', () => {
      it('returns false for unknown steps', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        expect(vm.isStepComplete({ identifier: 'bad' })).toBe(false);
      });

      it('returns false for incomplete steps', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        vm.statuses.foo = false;

        expect(vm.isStepComplete({ identifier: 'foo' })).toBe(false);
      });

      it('returns true for complete steps', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        vm.statuses.foo = true;

        expect(vm.isStepComplete({ identifier: 'foo' })).toBe(true);
      });
    });

    describe('update status', () => {
      it('sets the status variable for the step', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        vm.updateStatus({ identifier: 'foo' }, true);

        expect(vm.statuses.foo).toBe(true);
      });

      it('does nothing if the value is not a boolean', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        vm.updateStatus({ identifier: 'foo' }, 'true');

        expect(vm.statuses.foo).toEqual(false);
      });
    });

    describe('change to step', () => {
      it('allows you to navigate if the step is complete', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        const step = {
          identifier: 'bar',
        };

        vm.statuses.foo = true;
        vm.statuses.bar = true;

        vm.changeToStep(step);

        expect(vm.current).toEqual(step);
      });

      it('does not allow access to future tasks that are incomplete', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        const step = {
          identifier: 'foobar',
        };

        vm.statuses.foo = true;
        const { current } = vm;

        vm.changeToStep(step);

        expect(vm.current).toEqual(current);
      });

      it('allows the next incomplete step', () => {
        const { vm } = shallowMount(Wizard, {
          props: {
            steps,
          },
        });

        const step = {
          identifier: 'bar',
        };

        vm.statuses.foo = true;
        vm.changeToStep(step);

        expect(vm.current).toEqual(step);
      });
    });
  });
});
