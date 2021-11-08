<template>
    <div
        :class="colourClass"
        class="
            mt-2
            border-l-4
            p-4
            mb-4
        "
        role="alert"
    >
        <p v-if="title !== undefined" class="font-bold">{{ title }}</p>
        {{ body }}
    </div>
</template>

<script>
export default {
  name: 'Alert',

  props: {
    title: {
      type: String,
      required: false,
      default: undefined,
    },
    body: {
      type: String,
      required: true,
    },
    colourClass: {
      type: String,
      required: false,
      default: '',
    },
  },
};
</script>

<style scoped>

</style>
