<template>
    <div>
        <label
            :for="id"
            class="block text-sm font-medium leading-5 text-gray-700"
        >
            {{ label }}:
            <small
                v-if="description"
                class="text-xs font-small"
            >{{ description }}</small>
            <template v-if="required">*</template>
        </label>
        <input
            :id="id"
            ref="field"
            v-model="value"
            :class="{
                'bg-gray-100': disabled,
                'cursor-not-allowed': disabled
            }"
            :disabled="disabled"
            :placeholder="label"
            class="
            mt-1
            form-input
            block
            w-full
            py-2
            px-3
            border
            border-gray-300
            rounded-md
            shadow-sm
            focus:outline-none
            focus:shadow-outline-blue
            focus:border-blue-300
            transition
            duration-150
            ease-in-out
            sm:text-sm
            sm:leading-5
        "
            type="text">
    </div>
</template>

<script>
export default {
  name: 'input-field',

  props: {
    id: {
      required: true,
      type: String,
    },
    disabled: {
      required: false,
      type: Boolean,
      default: false,
    },
    description: {
      required: false,
      type: String,
      default: undefined,
    },
    label: {
      required: true,
      type: String,
    },
    modelValue: {
      required: false,
      type: String,
      default: undefined,
    },
    required: {
      required: false,
      type: Boolean,
      default: false,
    },
  },

  data: () => ({
    value: '',
  }),

  created() {
    this.value = this.modelValue;
  },

  watch: {
    modelValue(newValue) {
      this.value = newValue;
    },

    value(newValue) {
      if (newValue === this.modelValue) {
        return;
      }

      this.$emit('update:modelValue', newValue);
    },
  },
};
</script>
