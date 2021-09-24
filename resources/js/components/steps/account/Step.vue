<template>
    <form v-if="hasConfigurations" class="w-1/2 m-auto" method="post" @submit.prevent="submit">
        <component
            :is="'input-field'"
            id="account.email"
            v-model="form.email"
            :description="configurations.email.description"
            :disabled="disabled"
            :label="configurations.email.name"
            :required="!configurations.email.nullable"
            class="mb-3"
        />

        <component
            :is="'input-field'"
            id="account.username"
            v-model="form.username"
            :description="configurations.username.description"
            :disabled="disabled"
            :label="configurations.username.name"
            :required="!configurations.username.nullable"
            class="mb-3"
        />

        <component
            :is="'password-field'"
            id="account.host"
            v-model="form.password"
            :description="configurations.password.description"
            :disabled="disabled"
            :label="configurations.password.name"
            :required="!configurations.password.nullable"
            class="mb-3"
        />

        <div class="text-center">
            <component
                :is="'form-button'"
                ref="button"
                :class="{
                    'hover:bg-green-300': !disabled || !canSubmit
                }"
                :disabled="disabled || !canSubmit"
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
  name: 'account-requirements',
  data: () => ({
    validations: [],
    collapsed: {},
    configurations: {},
    form: {},
    resources: {},
  }),

  mixins: [InterpretResponse, HasState],

  computed: {
    canSubmit() {
      return Object.keys(this.configurations)
        .filter((key) => !this.configurations[key].nullable)
        .filter((key) => !this.form[key])
        .length === 0;
    },
    disabled() {
      return this.state !== 'idle';
    },
    hasConfigurations() {
      return Object.keys(this.configurations).length > 0;
    },
  },

  async created() {
    const { data } = (
      await axios.get('/api/v1/installation/requirements/account')
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
          await axios.post(
            '/api/v1/installation/requirements/account',
            this.form,
          )
        ).data;

        this.processResponse(data);
      } catch (error) {
        console.log(error);
      }

      this.setState('idle');
    },
  },

  watch: {
    'validations.configuration': function (configuration) {
      this.$emit('completed', configuration?.is_complete);
    },
  },
};
</script>
