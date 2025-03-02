<template>
  <section>
    <div class="columns">
      <div class="column is-half" id="paypal-payment-container">
        <button>Pay With PayPal</button>
      </div>
      <div class="column is-half">
        <ul>
          <li><strong>First Name: </strong>{{ formInputs.firstName }}</li>
          <li><strong>Last Name: </strong>{{ formInputs.lastName }}</li>
          <li><strong>Email: </strong>{{ formInputs.email }}</li>
          <li><strong>Street Address: </strong>{{ formInputs.street }}</li>
          <li><strong>City: </strong>{{ formInputs.city }}</li>
          <li><strong>State: </strong>{{ formInputs.state }}</li>
          <li><strong>Zip: </strong>{{ formInputs.zip }}</li>
        </ul>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from "vue";

const ppClientId = ref('AdFGtAaiTTKkBNdywYhVqmqNpBeBMOmeCnMSTIvXcasWeru4RlaZtgTsauXkQArRWy_fw1RxuT2puT_S')

const props = defineProps({
  formInputs: {
    type: Object,
    required: true,
  },
});
</script>

<style lang="scss" scoped>
section {
  top: 0;
  min-height: 450px;
  width: 100%;

  .columns {
    height: 250px;

    ul {
      list-style-type: none;
      padding: 0;
    }

    #paypal-payment-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
    }
  }
}

@media screen and (max-width: 768px) {
  section {
    .columns {
      height: auto;
    }
  }
}
</style>
