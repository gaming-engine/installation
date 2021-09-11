<template>
    <form v-if="hasConfigurations" class="w-1/2 m-auto" method="post" @submit.prevent="submit">
        <component
            :is="'drop-down'"
            id="engine"
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
            id="host"
            v-model="form.host"
            :description="configurations.host.description"
            :disabled="disabled"
            :label="configurations.host.name"
            :required="!configurations.host.nullable"
            class="mb-3"
        />
        <component
            :is="'input-field'"
            id="database-name"
            v-model="form['database-name']"
            :description="configurations['database-name'].description"
            :disabled="disabled"
            :label="configurations['database-name'].name"
            :required="!configurations['database-name'].nullable"
            class="mb-3"
        />
        <component
            :is="'input-field'"
            id="username"
            v-model="form.username"
            :description="configurations.username.description"
            :disabled="disabled"
            :label="configurations.username.name"
            :required="!configurations.username.nullable"
            class="mb-3"
        />
        <component
            :is="'password-field'"
            id="password"
            v-model="form.password"
            :description="configurations.password.description"
            :disabled="disabled"
            :label="configurations.password.name"
            :required="!configurations.password.nullable"
            autocomplete="database-password"
            class="mb-3"
        />

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
                class="bg-green-500"
                style="color: white"
                text="Test Connection"
            />
        </div>
    </form>
</template>

<script>
import axios from 'axios';

export default {
  name: 'database-requirements',
  data: () => ({
    validations: [],
    collapsed: {},
    configurations: {},
    form: {},
    state: 'idle',
  }),

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
      return this.state !== 'idle';
    },
    connectivity() {
      return this.validations.connectivity;
    },

    hasConfigurations() {
      return Object.keys(this.configurations).length > 0;
    },
  },

  async created() {
    await this.refresh();
  },

  methods: {
    setState(state) {
      this.state = state;
    },

    async refresh() {
      const { data } = (
        await axios.get('/api/v1/installation/requirements/database')
      ).data;

      this.processResponse(data);
    },

    async submit() {
      if (this.state !== 'idle') {
        return;
      }

      this.setState('attempting');

      try {
        const { data } = (
          await axios.post(
            '/api/v1/installation/requirements/database',
            this.form,
          )
        ).data;

        this.processResponse(data);
      } catch (error) {
        console.log(error);
      }

      this.setState('idle');
    },

    processResponse(data) {
      const { configurations, validations } = data || {};

      if (!configurations || !validations) {
        throw Error('Invalid response');
      }

      this.configurations = configurations;
      this.validations = validations;

      Object.entries(configurations)
        .forEach(([key, value]) => {
          this.form[key] = value.value;
        });

      this.$emit('completed', this.connectivity?.is_complete);
    },
  },
};
</script>
