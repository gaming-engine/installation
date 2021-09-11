import axios from 'axios';
import { shallowMount } from '@vue/test-utils';
import Step from './Step.vue';

jest.mock('axios');

describe('database requirements step', () => {
  const sampleConfigurations = {
    engine: {
      name: 'foo',
      description: 'foo',
      value: 'foo',
      nullable: false,
    },
    host: {
      name: 'foo',
      description: 'foo',
      value: 'foo',
      nullable: false,
    },
    'database-name': {
      name: 'foo',
      description: 'foo',
      value: 'foo',
      nullable: false,
    },
    username: {
      name: 'foo',
      description: 'foo',
      value: 'foo',
      nullable: false,
    },
    password: {
      name: 'foo',
      description: 'foo',
      value: 'foo',
      nullable: false,
    },
  };

  const sampleValidations = {
    connectivity: {
      is_complete: true,
    },
  };

  describe('created', () => {
    it('automatically retrieves the current status', () => {
      axios.get.mockResolvedValue({
        data: {
          data: {
            validations: [],
            configurations: {},
          },
        },
      });

      shallowMount(Step);

      expect(axios.get).toHaveBeenCalledWith(
        '/api/v1/installation/requirements/database',
      );
    });
  });

  describe('computed', () => {
    describe('database options', () => {
      it('defaults the values', () => {
        const { vm } = shallowMount(Step);

        expect(vm.databaseOptions)
          .toEqual([
            {
              value: 'mysql',
              text: 'MySQL',
            },
            {
              value: 'pgsql',
              text: 'Postgres',
            },
          ]);
      });
    });

    describe('disabled', () => {
      it('is true if the state is not idle', () => {
        const { vm } = shallowMount(Step);

        vm.setState('bar');

        expect(vm.disabled)
          .toBe(true);
      });

      it('is false if the state is idle', () => {
        const { vm } = shallowMount(Step);

        vm.setState('idle');

        expect(vm.disabled)
          .toBe(false);
      });
    });
  });

  describe('methods', () => {
    describe('set state', () => {
      it('passes through the state', () => {
        const { vm } = shallowMount(Step);

        vm.setState('bar');

        expect(vm.state)
          .toBe('bar');
      });
    });

    describe('submit', () => {
      it('does not fire a request if the state is not idle', () => {
        const { vm } = shallowMount(Step);

        vm.setState('bar');
        vm.submit();

        expect(axios.post).not.toHaveBeenCalledWith(
          '/api/v1/installation/requirements/database',
        );
      });

      it('fires a request if the state is idle', () => {
        axios.post.mockResolvedValue({
          data: {
            data: {
              validations: [],
              configurations: {},
            },
          },
        });

        const { vm } = shallowMount(Step);

        vm.submit();

        expect(axios.post).not.toHaveBeenCalledWith(
          '/api/v1/installation/requirements/database',
        );
      });
    });

    describe('process response', () => {
      it('throws an error if the response is invalid', () => {
        const { vm } = shallowMount(Step);

        expect.assertions(1);

        try {
          vm.processResponse({});
        } catch (error) {
          expect(error)
            .toBeTruthy();
        }
      });

      it('throws an error if the response is undefined', () => {
        const { vm } = shallowMount(Step);

        expect.assertions(1);

        try {
          vm.processResponse(undefined);
        } catch (error) {
          expect(error)
            .toBeTruthy();
        }
      });

      it('updates the configuration values once provided', () => {
        const { vm } = shallowMount(Step);

        vm.processResponse({
          configurations: sampleConfigurations,
          validations: sampleValidations,
        });

        expect(vm.form)
          .toEqual({
            engine: 'foo',
            host: 'foo',
            'database-name': 'foo',
            username: 'foo',
            password: 'foo',
          });
      });

      it('shows an alert if the database could not be connected to',
        async () => {
          const { vm } = shallowMount(Step);

          vm.processResponse({
            configurations: sampleConfigurations,
            validations: {
              ...sampleValidations,
              connectivity: {
                is_complete: false,
              },
            },
          });

          await vm.$nextTick();

          expect(vm.$refs.warning)
            .toBeTruthy();
        });
    });
  });
});
