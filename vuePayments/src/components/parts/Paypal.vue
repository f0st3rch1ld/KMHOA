<template>
  <section v-if="!duesPaid">
    <div class="columns">
      <div class="column is-half" id="payee-details">
        <ul>
          <li><h3>Your Information</h3></li>
          <li>
            Please Review your information here before continuing to paypal.
          </li>
          <li><hr /></li>
          <li>
            First Name: <strong>{{ formInputs.firstName }}</strong>
          </li>
          <li>
            Last Name: <strong>{{ formInputs.lastName }}</strong>
          </li>
          <li>
            Email: <strong>{{ formInputs.email }}</strong>
          </li>
          <li>
            Street Address: <strong>{{ formInputs.street }}</strong>
          </li>
          <li>
            City: <strong>{{ formInputs.city }}</strong>
          </li>
          <li>
            State: <strong>{{ formInputs.state }}</strong>
          </li>
          <li>
            Zip: <strong>{{ formInputs.zip }}</strong>
          </li>
          <li><hr /></li>
          <li><button @click="navigateToStep(1)">Make Changes</button></li>
        </ul>
      </div>
      <div class="column is-half" id="paypal-payment-container">
        <div id="paypal-payment-portal"></div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from "vue";
import { onMounted } from "vue";
import { loadScript } from "@paypal/paypal-js";

let paypal;

let duesPaid = ref(false);

const props = defineProps({
  formInputs: {
    type: Object,
    required: true,
  },
});

const emit = defineEmits(["switchStep"]);

const navigateToStep = (step) => {
  emit("switchStep", step);
};

const initializePaypal = async () => {
  try {
    paypal = await loadScript({
      clientId:
        "AdFGtAaiTTKkBNdywYhVqmqNpBeBMOmeCnMSTIvXcasWeru4RlaZtgTsauXkQArRWy_fw1RxuT2puT_S",
    });
  } catch (error) {
    console.error("failed to load the PayPal JS SDK script", error);
  }

  if (paypal) {
    try {
      await paypal
        .Buttons({
          createOrder: (data, actions) => {
            return actions.order.create({
              purchase_units: [
                {
                  description: "Kimberly Meadows Yearly HOA Dues",
                  amount: {
                    currency_code: "USD",
                    value: "77.00",
                  },
                },
              ],
            });
          },
          onApprove: async (data, actions) => {
            const order = await actions.order.capture();
            duesPaid.value = true;
            navigateToStep(3);
          },
          onError: (err) => {
            console.log(err);
          },
        })
        .render("#paypal-payment-portal");
    } catch (error) {
      console.error("failed to render the PayPal Buttons", error);
    }
  }
};

onMounted(() => {
  initializePaypal();
});
</script>

<style lang="scss" scoped>
section {
  top: 0;
  min-height: 450px;
  width: 100%;

  .columns {
    height: auto;
    min-height: 250px;

    ul {
      list-style-type: none;
      padding: 0;
    }

    #paypal-payment-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: auto;
    }
  }
}

#payee-details {
  ul {
    background-color: #325ce8;
    color: #fff;
    padding: 1rem 2rem;
    border-radius: 8px;
    box-shadow: 5px 5px 8px rgba(0, 0, 0, 0.2);

    li {
      h3 {
        margin: 0;
      }

      button {
        padding: 0.75rem 1.25rem;
        color: #fff;
        border-style: solid;
        border-color: #fff;
        border-width: 1px;
        border-radius: 7px;
        font-weight: 600;
        font-size: 1.1rem;
        background-color: transparent;
        cursor: pointer;
        transition-timing-function: ease-in-out;
        transition-duration: 0.2s;

        &:hover {
          background-color: #fff;
          color: #325ce8;
        }
      }
    }
  }
}

#buttons-container,
#paypal-payment-portal {
  width: 100%;
}

@media screen and (max-width: 768px) {
  section {
    .columns {
      height: auto;
    }
  }
}
</style>
