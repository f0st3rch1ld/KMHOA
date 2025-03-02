<template>
  <section>
    <div class="columns">
      <div :class="stepClasses(1)" @click="navigateToStep(1)">
        <h5>Step 1</h5>
        <h4>Your Information</h4>
      </div>
      <div :class="stepClasses(2)" @click="navigateToStep(2)">
        <h5>Step 2</h5>
        <h4>Payment</h4>
      </div>
      <div :class="stepClasses(3)" @click="navigateToStep(3)">
        <h5>Step 3</h5>
        <h4>Summary</h4>
      </div>
    </div>
    <hr />
  </section>
</template>

<script setup>
const emit = defineEmits(["switchStep"]);
const props = defineProps({
  activeStep: {
    type: Number,
    default: 1,
  },
});
const stepClasses = (step) => {
  return {
    column: true,
    "is-one-third": true,
    "form-steps": true,
    "active-step": step <= props.activeStep,
  };
};
const navigateToStep = (step) => {
  if (step <= props.activeStep) {
    emit("switchStep", step);
  }
};
</script>

<style lang="scss" scoped>
.form-steps {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  transition-timing-function: ease-in-out;
  transition-duration: 0.3s;
  cursor: pointer;

  h5 {
    margin-bottom: 0;
    padding-bottom: 0;
    color: #bcbcbc;
  }
  h4 {
    margin-top: 0;
    padding-top: 0;
    color: #bcbcbc;
  }
  &.active-step {
    h5 {
      color: black;
      transition-timing-function: ease-in-out;
      transition-duration: 0.3s;
    }
    h4 {
      color: #325ce8;
      transition-timing-function: ease-in-out;
      transition-duration: 0.3s;
    }
  }
}
</style>
