import axios from 'axios';
import { shallowMount } from '@vue/test-utils';
import Step from './Step.vue';

jest.mock('axios');

describe('server requirements step', () => {
  describe('created', () => {
    it('automatically retrieves the current status', () => {
      axios.get.mockResolvedValue({
        data: {
          data: {
            validations: [],
            resources: {
              button: 'hello',
            },
          },
        },
      });

      shallowMount(Step);

      expect(axios.get).toHaveBeenCalledWith(
        '/api/v1/installation/requirements/server',
      );
    });
  });

  describe('refresh', () => {
    it('automatically retrieves the current status', async () => {
      axios.get.mockResolvedValue({
        data: {
          data: {
            validations: [],
            resources: {
              button: 'hello',
            },
          },
        },
      });

      const { vm } = shallowMount(Step);
      await vm.refresh();

      expect(axios.get).toHaveBeenCalledWith(
        '/api/v1/installation/requirements/server',
      );
    });

    it('emits an event stating if all of the steps are complete', async () => {
      axios.get.mockResolvedValue({
        data: {
          data: {
            validations: [],
            resources: {
              button: 'hello',
            },
          },

        },
      });

      const wrapper = shallowMount(Step);
      await wrapper.vm.refresh();

      expect(wrapper.emitted().completed).toBeTruthy();
      expect(wrapper.emitted('completed')[0]).toEqual([true]);
    });

    it('emits an event stating false if there are incomplete tasks',
      async () => {
        axios.get.mockResolvedValue({
          data: {
            data: {
              validations: {
                configuration: {
                  is_complete: false,
                  tests: [],
                },
              },
              resources: {
                button: 'testing',
              },
            },
          },
        });

        const wrapper = shallowMount(Step);
        await wrapper.vm.refresh();

        expect(wrapper.emitted().completed).toBeTruthy();
        expect(wrapper.emitted('completed')[0]).toEqual([false]);
      });
  });
});
