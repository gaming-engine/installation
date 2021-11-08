<template>
    <form v-if="hasConfigurations" class="md:w-1/2 m-auto" method="post" @submit.prevent="submit">
        <component
            :is="'drop-down'"
            id="database.engine"
            v-model="form.engine"
            :description="configurations.engine.description"
            :disabled="disabled"
            :label="configurations.engine.title"
            :options="databaseOptions"
            :required="!configurations.engine.nullable"
            class="mb-3"
        />
        <component
            :is="'input-field'"
            id="database.host"
            v-model="form.host"
            :description="configurations.host.description"
            :disabled="disabled"
            :label="configurations.host.title"
            :required="!configurations.host.nullable"
            class="mb-3"
        />
        <component
            :is="'input-field'"
            id="database.database-name"
            v-model="form['database-name']"
            :description="configurations['database-name'].description"
            :disabled="disabled"
            :label="configurations['database-name'].title"
            :required="!configurations['database-name'].nullable"
            class="mb-3"
        />
        <component
            :is="'input-field'"
            id="database.username"
            v-model="form.username"
            :description="configurations.username.description"
            :disabled="disabled"
            :label="configurations.username.title"
            :required="!configurations.username.nullable"
            class="mb-3"
        />
        <component
            :is="'password-field'"
            id="database.password"
            v-model="form.password"
            :description="configurations.password.description"
            :disabled="disabled"
            :label="configurations.password.title"
            :required="!configurations.password.nullable"
            autocomplete="database-password"
            class="mb-3"
        />

        <warning-alert
            v-if="!form.password"
            :body="configurations.password.warning"
            :title="resources.configurations.password.title"
        />

        <warning-alert v-if="!connectivity.is_complete"
                       ref="warning"
                       :body="connectivity.description"
                       :title="connectivity.title"
                   />

        <div class="text-center">
            <component
                :is="'form-button'"
                :class="{
                    'hover:bg-green-300': !disabled
                }"
                :disabled="disabled"
                :text="resources.button"
                class="bg-green-500"
                style="color: white"
            />
        </div>
    </form>
</template>

<script>
import axios from 'axios';
import InterpretResponse from '@mixins/interpret-response';
import HasState from '@mixins/state';
import WarningAlert from '@components/alert/WarningAlert';

export default {
  name: 'database-requirements',

  components: {
    WarningAlert,
  },

  data: () => ({
    validations: [],
    configurations: {},
    form: {},
    resources: {},
  }),

  mixins: [InterpretResponse, HasState],

  computed: {
    databaseOptions() {
      return [
        {
          value: 'mysql',
          text: 'MySQL',
        },
        {
          value: 'pgsql',
          text: 'Postgres',
        },
      ];
    },

    disabled() {
      return 'idle' !== this.state;
    },

    connectivity() {
      return this.validations.connectivity;
    },

    hasConfigurations() {
      return 0 < Object.keys(this.configurations).length;
    },

    url: () => '/api/v1/installation/database/requirements',
  },

  async created() {
    const { data } = (
      await axios.get(this.url)
    ).data;

    this.processResponse(data);
  },

  methods: {
    async submit() {
      if (this.disabled) {
        return;
      }

      this.setState('attempting');

      try {
        const { data } = (
          await axios.post(this.url, this.form)
        ).data;

        this.processResponse(data);
      } catch (error) {
        console.log(error);
      }

      this.setState('idle');
    },
  },

  watch: {
    connectivity(connectivity) {
      this.$emit('completed', connectivity?.is_complete);
    },
  },
};
</script>
