<template>
    <div>
        <div class="w-full py-6">
            <div class="flex">
                <div
                    v-for="(step, index) in steps"
                    :key="`step-${step.identifier}-${index}-top`"
                    :class="`w-1/${stepWidth}`"
                    @click="changeToStep(step)"
                >
                    <div class="relative mb-2">
                        <div
                            v-if="index > 0"
                            class="
                                absolute
                                flex
                                align-center
                                items-center
                                align-middle
                                content-center
                            "
                            style="
                                width:calc(100% - 2.5rem - 1rem);
                                top:50%;transform:translate(-50%, -50%);
                                "
                        >
                            <div class="
                                    w-full
                                    bg-gray-200
                                    rounded
                                    items-center
                                    align-middle align-center
                                    flex-1
                                ">
                                <div
                                    :style="{
                                        width: `${isStepComplete(step) ? 100 : 0}%`
                                    }"
                                    class="
                                    w-0
                                    bg-green-300
                                    py-1
                                    rounded
                                    "></div>
                            </div>
                        </div>
                        <div
                            :class="{
                                'bg-green-500': isStepComplete(step),
                                'border-2 border-gray-200': !isStepComplete(step),
                            }"
                            class="
                                w-10
                                h-10
                                mx-auto
                                rounded-full
                                text-lg
                                flex
                                items-center
                            "
                        >
                            <span :class="{
                                'text-white': isStepComplete(step),
                                'text-gray-600': !isStepComplete(step),
                            }" class="text-center w-full">
                                <component :is="`${step.identifier}-icon`">{{
                                        step.identifier[0].toUpperCase()
                                    }}</component>
                            </span>
                        </div>

                    </div>

                    <div class="text-xs text-center md:text-base">
                        {{ step.name }}
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div v-for="step in steps"
                 v-show="step.identifier === current.identifier"
                 :key="`step-${step.identifier}-step`">
                <h2 class="text-center d-block pb-5 font-bold text-lg">
                    {{ step.name }}
                </h2>

                <component
                    :is="`${step.identifier}-step`"
                    :steps="steps"
                    @completed="updateStatus(step, $event)"
                ></component>
            </div>

            <div class="m-5 grid grid-cols-2 text-center">

                <div>
                    <button
                        v-if="hasPreviousStep"
                        class="
                        inline-flex
                        items-center
                        px-6
                        py-3
                        bg-gray-100
                        text-gray-500
                        rounded-md
                        hover:bg-gray-200
                        hover:text-gray-600"
                        @click="changeToPreviousStep">
                        Previous
                    </button>
                </div>

                <div>
                    <button
                        v-if="hasNextStep"
                        :class="{
                            'bg-blue-600': canGoToNextStep,
                            'text-white': canGoToNextStep,
                            'hover:bg-blue-300': canGoToNextStep,
                            'hover:text-gray': canGoToNextStep,
                            'bg-gray-100': !canGoToNextStep,
                            'text-gray-500': !canGoToNextStep
                        }"
                        class="
                            inline-flex
                            items-center
                            px-6
                            py-3
                            rounded-md
                            hover:bg-gray-200
                            hover:text-gray-600
                        "
                        @click="changeToNextStep">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'Wizard',
  props: {
    steps: {
      type: Array,
      required: true,
    },
  },

  data: () => ({
    current: {},
    statuses: {},
    state: 'idle',
  }),

  created() {
    [this.current] = this.steps;
    this.setState('configuring');

    this.steps.forEach((step) => {
      this.statuses[step.identifier] = step.is_complete;
    });
  },

  computed: {
    stepWidth() {
      if (4 > this.steps.length) {
        return 3;
      }
      return Math.floor(12 / this.steps.length);
    },

    hasPreviousStep() {
      return 0 !== this.currentIndex;
    },

    hasNextStep() {
      return this.currentIndex + 1 < this.steps.length;
    },

    canGoToNextStep() {
      return (this.hasNextStep && this.isStepComplete(this.current));
    },

    currentIndex() {
      return this.findStepIndex(this.current);
    },

    nextStep() {
      return this.steps.findIndex((step) => !this.isStepComplete(step));
    },
  },

  methods: {
    setState(state) {
      if ('installing' === state && -1 !== this.nextStep) {
        return;
      }

      this.state = state;
    },

    changeToNextStep() {
      if (!this.canGoToNextStep) {
        return;
      }

      this.current = this.steps[this.currentIndex + 1];
    },

    changeToPreviousStep() {
      if (!this.hasPreviousStep) {
        return;
      }

      this.current = this.steps[this.currentIndex - 1];
    },

    isStepComplete(step) {
      return !!this.statuses[step.identifier];
    },

    updateStatus(step, value) {
      if ('boolean' !== typeof value) {
        return;
      }

      this.statuses[step.identifier] = value;
    },

    findStepIndex(step) {
      return this.steps.findIndex(
        (s) => step.identifier === s.identifier,
      );
    },

    canNavigateTo(step) {
      return this.findStepIndex(step) <= this.nextStep;
    },

    changeToStep(step) {
      this.setState('configuring');
      if (this.isStepComplete(step)) {
        this.current = step;
        return;
      }

      const { nextStep } = this;

      if (this.findStepIndex(step) <= nextStep) {
        this.current = step;
      }
    },

    install() {
      this.setState('installing');
    },
  },
};
</script>
