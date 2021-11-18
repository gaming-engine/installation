<template>
    <alert :body="body" :title="title" colour-class="
            bg-blue-100
            border-blue-500
            text-blue-700"
    />
</template>

<script>
import Alert from '@components/alert/Alert.vue';

export default {
  name: 'InformationAlert',

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
