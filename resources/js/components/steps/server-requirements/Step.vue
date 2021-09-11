<template>
    <div>
        <ul class="ml-5">
            <li v-for="(check, index) in checks" :key="`${check.identifier}-check`">
                <div @click="collapsed[index] = !collapsed[index]">
                    <component :is="collapsed[index] ? 'up-arrow' : 'down-arrow'"></component>
                    <component :is="check.is_complete ? 'complete' : 'incomplete'"></component>
                    <strong>{{ check.name }}</strong>

                    <span
                        class="
                        text-xs
                        px-2
                        ml-2
                        font-medium
                        bg-gray-500
                        bg-opacity-10
                        text-gray-800
                        rounded-full
                        py-0.5
                    "
                    >
                {{ check.tests.length }}
            </span>

                </div>

                <ul v-if="!collapsed[index]" class="ml-10" @click.prevent="">
                    <li v-for="(test, testIndex) in check.tests" :key="`test-${testIndex}`">
                        <component :is="test.is_complete ? 'complete' : 'incomplete'"></component>
                        {{ test.description }}
                    </li>
                </ul>
            </li>
        </ul>

        <div class="text-center">
            <button
                class="
                    inline-flex
                    items-center
                    px-6
                    py-3
                    rounded-md
                    hover:bg-green-200
                    hover:text-gray-600
                    bg-green-400 text-black
                "
                @click="refresh">
                Refresh
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'server-requirements',
  data: () => ({
    checks: [],
    collapsed: {},
  }),

  async created() {
    await this.refresh();
  },

  methods: {
    async refresh() {
      const { data } = (
        await axios.get('/api/v1/installation/requirements/server')
      ).data;

      this.checks = data;
      let allComplete = true;

      Object.entries(this.checks).forEach(
        (arrayValue) => {
          const [index, check] = arrayValue;
          this.collapsed[index] = check.is_complete;

          if (!check.is_complete) {
            allComplete = false;
          }
        },
      );

      this.$emit('completed', allComplete);
    },
  },
};
</script>

<style scoped>
svg {
    display: inline-block;
}
</style>
