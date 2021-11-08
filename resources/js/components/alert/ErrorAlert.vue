<template>
    <alert :body="body" :title="title" colour-class="
            bg-red-100
            border-red-500
            text-red-700"
       />
</template>

<script>
import Alert from '@components/alert/Alert.vue';

export default {
  name: 'ErrorAlert',

  components: {
    Alert,
  },

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
  },
};
</script>
