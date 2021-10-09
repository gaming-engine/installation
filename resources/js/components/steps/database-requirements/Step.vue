<template>
    <form v-if="hasConfigurations" class="w-1/2 m-auto" method="post" @submit.prevent="submit">
        <component
            :is="'drop-down'"
            id="database.engine"
            v-model="form.engine"
            :description="configurations.engine.description"
            :disabled="disabled"
            :label="configurations.engine.name"
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
            :label="configurations.host.name"
            :required="!configurations.host.nullable"
            class="mb-3"
        />
        <component
            :is="'input-field'"
            id="database.database-name"
            v-model="form['database-name']"
            :description="configurations['database-name'].description"
            :disabled="disabled"
            :label="configurations['database-name'].name"
            :required="!configurations['database-name'].nullable"
            class="mb-3"
        />
        <component
            :is="'input-field'"
            id="database.username"
            v-model="form.username"
            :description="configurations.username.description"
            :disabled="disabled"
            :label="configurations.username.name"
            :required="!configurations.username.nullable"
            class="mb-3"
        />
        <component
            :is="'password-field'"
            id="database.password"
            v-model="form.password"
            :description="configurations.password.description"
            :disabled="disabled"
            :label="configurations.password.name"
            :required="!configurations.password.nullable"
            autocomplete="database-password"
            class="mb-3"
        />

        <div
            v-if="!form.password"
            class="
            bg-blue-100
            border-l-4
            border-blue-500
            text-blue-700
            p-4
            mb-4
            "
            role="alert"
        >
            <p class="font-bold">{{ configurations.password.name }}</p>
            <p>{{ resources.configuration.password.warning }}</p>
        </div>

        <div
            v-if="!connectivity.is_complete"
            ref="warning"
            class="
            bg-yellow-100
            border-l-4
            border-yellow-500
            text-yellow-700
            p-4
            mb-4
            "
            role="alert"
        >
            <p class="font-bold">{{ connectivity.name }}</p>
            <p>{{ connectivity.description }}</p>
        </div>

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
import InterpretResponse from '../../../mixins/interpret-response';
import HasState from '../../../mixins/state';

export default {
  name: 'database-requirements',

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
