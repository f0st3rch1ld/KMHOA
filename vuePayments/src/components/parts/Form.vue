<template>
  <section>
    <FormKit
      type="form"
      :actions="false"
      #default="{ disabled }"
      @submit="submitForm"
    >
      <div class="columns">
        <div class="column is-half">
          <FormKit
            type="text"
            name="firstName"
            id="first-name"
            label="First Name"
            placeholder="Jerry"
            validation="required"
            :value="formInputs.firstName"
          />
        </div>
        <div class="column is-half">
          <FormKit
            type="text"
            name="lastName"
            id="last-name"
            label="Last Name"
            placeholder="Seinfeld"
            validation="required"
            :value="formInputs.lastName"
          />
        </div>
        <div class="column">
          <FormKit
            type="text"
            name="email"
            id="email"
            label="Email Address"
            placeholder="js@emailaddy.com"
            validation="required|email"
            :value="formInputs.email"
          />
        </div>
        <div class="column">
          <FormKit
            type="text"
            name="street"
            id="street"
            label="Street Address"
            placeholder="1234 Your Street"
            validation="required"
            :value="formInputs.street"
          />
        </div>
        <div class="column is-half">
          <FormKit
            type="text"
            name="city"
            id="city"
            label="City"
            placeholder="Your City"
            validation="required"
            :value="formInputs.city"
          />
        </div>
        <div class="column is-one-quarter">
          <FormKit
            type="select"
            name="state"
            id="state"
            label="State"
            placeholder="Select a State"
            :options="states"
            validation="required"
            :value="formInputs.state"
          />
        </div>
        <div class="column is-one-quarter">
          <FormKit
            type="text"
            name="zip"
            id="zip"
            label="Zip Code"
            placeholder="12345"
            validation="required"
            :value="formInputs.zip"
          />
        </div>
        <div class="column is-full">
          <FormKit
            type="submit"
            label="Continue to Payment"
            :disabled="disabled"
          />
        </div>
      </div>
    </FormKit>
  </section>
</template>

<script setup>
import { ref } from "vue";
const props = defineProps({
  formInputs: {
    type: Object,
    default() {
      return {
        firstName: null,
        lastName: null,
        email: null,
        street: null,
        city: null,
        state: null,
        zip: null,
      };
    },
  },
});
const states = ref([
  "AL",
  "AK",
  "AZ",
  "AR",
  "CA",
  "CO",
  "CT",
  "DE",
  "DC",
  "FL",
  "GA",
  "HI",
  "ID",
  "IL",
  "IN",
  "IA",
  "KS",
  "KY",
  "LA",
  "ME",
  "MD",
  "MA",
  "MI",
  "MN",
  "MS",
  "MO",
  "MT",
  "NE",
  "NV",
  "NH",
  "NJ",
  "NM",
  "NY",
  "NC",
  "ND",
  "OH",
  "OK",
  "OR",
  "PA",
  "RI",
  "SC",
  "SD",
  "TN",
  "TX",
  "UT",
  "VT",
  "VA",
  "WA",
  "WV",
  "WI",
  "WY",
]);
const emit = defineEmits(["formSubmission"]);
const submitForm = (fields) => {
  emit("formSubmission", fields);
};
</script>

<style lang="scss" scoped>
section {
  top: 0;
  min-height: 450px;
  width: 100%;
}
</style>
