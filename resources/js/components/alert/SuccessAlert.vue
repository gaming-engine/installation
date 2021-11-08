<template>
    <alert :body="body" :title="title" colour-class="
            bg-green-100
            border-green-500
            text-green-700"
    />
</template>

<script>
import Alert from '@components/alert/Alert.vue';

export default {
  name: 'SuccessAlert',

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
