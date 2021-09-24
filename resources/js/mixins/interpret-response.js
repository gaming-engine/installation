export default {
  methods: {
    processResponse(data) {
      const { configurations, validations, resources } = data || {};

      if (!configurations || !validations) {
        throw Error('Invalid response');
      }

      this.configurations = configurations;
      this.validations = validations;
      this.resources = resources;

      Object.entries(configurations)
        .forEach(([key, value]) => {
          this.form[key] = value.value;
        });
    },
  },
};
