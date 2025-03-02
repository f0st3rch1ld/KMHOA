<template>
  <div id="vue-payments-form">
    <Steps :active-step="activeStep" @switchStep="switchStep" />
    <div class="feature">
      <transition>
        <Form
          v-if="activeStep === 1"
          :formInputs="formInputs"
          @formSubmission="submitForm"
        />
      </transition>
      <transition>
        <Paypal
          v-if="activeStep === 2"
          :formInputs="formInputs"
          @switchStep="switchStep"
        />
      </transition>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import Steps from "./parts/Steps.vue";
import Form from "./parts/Form.vue";
import Paypal from "./parts/Paypal.vue";

const activeStep = ref(1);
const formInputs = ref();

const submitForm = (fields) => {
  activeStep.value++;
  formInputs.value = fields;
  console.log(fields);
};
const switchStep = (step) => {
  activeStep.value = step;
};
</script>

<style lang="scss">
.feature {
  position: relative;
  min-height: 450px;
  overflow-x: hidden;
}

.v-leave-active {
  transition-timing-function: ease;
  transition-duration: 0.4s;
  opacity: 1;
  position: absolute;
}

.v-enter-active {
  transition-timing-function: ease;
  transition-duration: 0.4s;
  transition-delay: 0.4s;
  opacity: 1;
  position: absolute;
}

.v-leave-to {
  transform: translateX(-100px);
  opacity: 0;
}

.v-enter-from {
  transform: translateX(100px);
  opacity: 0;
}

.columns {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
  flex-wrap: wrap;

  .column {
    width: 100%;
    padding: 7px;

    &.is-half {
      width: 50%;
    }
    &.is-one-third {
      width: 33%;
    }
    &.is-two-thirds {
      width: 66%;
    }
    &.is-one-quarter {
      width: 25%;
    }
  }
}

.formkit-input {
  border-style: solid !important;
  border-width: 1px !important;
  border-color: #cecece !important;
}

[data-invalid] {
  .formkit-inner {
    input,
    select {
      border-color: red !important;
      border-width: 2px !important;
    }
  }
  .formkit-messages {
    color: red !important;
  }
}

ul {
  list-style-type: none;
  padding: 0;
  margin-top: 0;
}

@media screen and (max-width: 768px) {
  .columns {
    .column {
      &.is-half,
      &.is-one-third,
      &.is-one-quarter {
        width: 100%;
      }
    }
  }

  button {
    width: 100%;
  }
}
</style>
