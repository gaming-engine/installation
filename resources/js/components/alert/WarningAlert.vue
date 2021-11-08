<template>
    <alert :body="body" :title="title" colour-class="
            bg-yellow-100
            border-yellow-500
            text-yellow-700"
    />
</template>

<script>
import Alert from '@components/alert/Alert.vue';

export default {
  name: 'WarningAlert',

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
