<template>
    <div class="md:w-1/2 m-auto">
        <ul class="ml-5">
            <li v-for="step in sortedSteps" :key="`install-${step.identifier}`">
                <div class="w-6 inline-block ml-3 mr-3">
                    <component :is="`${step.identifier}-icon`">{{
                            step.identifier[0].toUpperCase()
                        }}
                    </component>
                </div>

                <strong>{{ step.title }}</strong>

                <div class="inline-block float-right">
                    <spinner v-if="'processing' === status[step.identifier]" :size="5"/>
                    <complete v-else-if="'complete' === status[step.identifier]"
                              class="text-green-600"/>
                    <error v-else-if="'error' === status[step.identifier]"
                           class="text-red-600"/>
                </div>

                <error-alert
                    v-if="errors[step.identifier]"
                    :body="errors[step.identifier]"
                />
            </li>
        </ul>

        <div v-if="'complete' !== state" class="text-center mt-5">
            <button
                :disabled="'idle' !== state"
                class="
                    inline-flex
                    items-center
                    px-6
                    py-3
                    rounded-md
                    hover:bg-green-200
                    hover:text-white-600
                    bg-green-400 text-white
                "
                @click.prevent="process">
                {{ resources.button }}
            </button>
        </div>
        <div v-else>
            <success-alert :title="resources.complete"/>

            <a class="
                    inline-flex
                    items-center
                    px-6
                    py-3
                    rounded-md
                    hover:bg-green-200
                    hover:text-white-600
                    bg-green-400 text-white
                "
               href="/">
                {{ resources.finish }}
            </a>
        </div>

    </div>
</template>

<script>
import axios from 'axios';
import Error from '@components/utilities/Error';
import Spinner from '@components/utilities/Spinner';
import Complete from '@components/utilities/Complete';
import ErrorAlert from '@components/alert/ErrorAlert';
import SuccessAlert from '@components/alert/SuccessAlert';

export default {
  name: 'finalize-installation',

  components: {
    ErrorAlert,
    SuccessAlert,
    Complete,
    Error,
    Spinner,
  },

  props: {
    steps: {
      type: Array,
      required: true,
    },
  },

  data: () => ({
    state: 'idle',
    status: {},
    stepDetails: {},
    errors: {},
    resources: {},
  }),

  computed: {
    url: () => '/api/v1/installation/finalize/requirements',

    sortedSteps() {
      return [...this.steps].sort((a, b) => {
        if ('database' === a.identifier) {
          return -1;
        }

        if ('database' === b.identifier) {
          return 1;
        }

        return 0;
      });
    },
  },

  async created() {
    await this.refreshState();
  },

  methods: {
    setState(state) {
      this.state = state;
    },

    async refreshState() {
      Object.keys(this.sortedSteps)
        .forEach((stepNumber) => {
          const step = this.sortedSteps[stepNumber];
          this.status[step.identifier] = 'pending';
          delete this.errors[step.identifier];
          this.stepDetails[step.identifier] = step;
        });

      const { data } = await axios.get(this.url);
      this.resources = data.resources;
    },

    async process() {
      if ('idle' !== this.state) {
        return;
      }

      await this.refreshState();

      this.setState('processing');

      const properties = Object.values(this.stepDetails);
      let complete = true;

      for (let index = 0; index < properties.length; index += 1) {
        const step = properties[index];
        this.status[step.identifier] = 'processing';

        try {
          // eslint-disable-next-line no-await-in-loop
          await axios.put(step.apply);

          this.status[step.identifier] = 'complete';
        } catch (error) {
          this.status[step.identifier] = 'error';
          this.errors[step.identifier] = error.response.data.error;
          complete = false;
          this.setState('idle');
          break;
        }
      }

      if (complete) {
        this.setState('complete');
      }
    },
  },
};
</script>
