export default {
  data: () => ({
    state: 'idle',
  }),

  methods: {
    setState(state) {
      this.state = state;
    },
  },
};
