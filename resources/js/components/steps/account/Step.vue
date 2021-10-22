<template>
    <form v-if="hasConfigurations" class="md:w-1/2 m-auto" method="post" @submit.prevent="submit">
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
            id="account.name"
            v-model="form.name"
            :description="configurations.name.description"
            :disabled="disabled"
            :label="configurations.name.name"
            :required="!configurations.name.nullable"
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
      return 0 === Object.keys(this.configurations)
        .filter((key) => !this.configurations[key].nullable)
        .filter((key) => !this.form[key])
        .length;
    },
    disabled() {
      return 'idle' !== this.state;
    },
    hasConfigurations() {
      return 0 < Object.keys(this.configurations).length;
    },
    url: () => '/api/v1/installation/account/requirements',
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
    'validations.configuration': function (configuration) {
      this.$emit('completed', configuration?.is_complete);
    },
  },
};
</script>
