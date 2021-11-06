<template>
    <form v-if="hasConfigurations" class="md:w-1/2 m-auto" method="post" @submit.prevent="submit">
        <component
            :is="'drop-down'"
            id="language"
            v-model="form.locale"
            :disabled="disabled"
            :label="resources.locale.title"
            :options="languageSelections"
        />

        <div
            ref="warning"
            class="
            bg-yellow-100
            border-l-4
            border-yellow-500
            text-yellow-700
            p-4
            mb-4
            mt-4
            "
            role="alert"
        >
            {{ resources.locale.description }}
        </div>

        <div class="text-center">
            <component
                :is="'form-button'"
                :class="{
                    'hover:bg-green-300': !disabled,
                }"
                :disabled="disabled"
                :text="resources.button ?? 'Select Language'"
                class="bg-green-500 m-2"
                style="color: white"
            />
        </div>
    </form>
</template>

<script>
import axios from 'axios';
import HasState from '@mixins/state';
import InterpretResponse from '@mixins/interpret-response';

export default {
  name: 'language',

  data: () => ({
    validations: [],
    configurations: {},
    form: {},
    resources: {},
  }),

  mixins: [InterpretResponse, HasState],

  computed: {
    hasConfigurations() {
      return 0 < Object.keys(this.configurations).length;
    },

    disabled() {
      return 'idle' !== this.state;
    },

    language() {
      return this.configurations.locale ?? {};
    },

    url: () => '/api/v1/installation/language/requirements',

    languageSelections() {
      return this.language.available?.map((key) => ({
        value: key,
        text: this.resources[key].name,
      })) || [];
    },
  },

  methods: {
    async submit() {
      if (this.disabled) {
        return;
      }

      this.setState('attempting');

      try {
        const currentLanguage = this.language.value;

        const { data } = (
          await axios.post(this.url, this.form)
        ).data;

        this.processResponse(data);

        // Check if the language has changed
        if (currentLanguage !== this.language.value) {
          window.location.reload(true);
        }
      } catch (error) {
        console.log(error);
      }

      this.setState('idle');
    },
  },

  async created() {
    const { data } = (
      await axios.get(this.url)
    ).data;

    this.processResponse(data);
  },
};
</script>
