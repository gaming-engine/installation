<template>
    <div class="md:w-1/2 m-auto">
        <ul class="ml-5">
            <li v-for="(check, index) in checks" :key="`${check.identifier}-check`">
                <div @click="collapsed[index] = !collapsed[index]">
                    <component :is="collapsed[index] ? 'up-arrow' : 'down-arrow'"></component>
                    <component :is="check.is_complete ? 'complete' : 'incomplete'"></component>
                    <strong>{{ check.title }}</strong>

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

        <div class="text-center mt-4">
            <button
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
                @click="refresh">
                {{ resources.button ?? 'Refresh' }}
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
    resources: {},
    collapsed: {},
  }),

  computed: {
    url: () => '/api/v1/installation/server/requirements',
  },

  async created() {
    await this.refresh();
  },

  methods: {
    async refresh() {
      const { data } = (
        await axios.get(this.url)
      ).data;

      const {
        validations,
        resources,
      } = data;

      this.checks = validations;
      this.resources = resources;
      let allComplete = true;

      Object.entries(this.checks)
        .forEach(
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
