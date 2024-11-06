<script setup lang="ts">
const props = defineProps<{
  dialog: boolean;
}>();

const emit = defineEmits<{
  (e: "close"): void;
  (e: "order-created"): void;
}>();

const emitClose = () => {
  emit("close");
};

const emitOrderCreated = () => {
  emit("order-created");
};

const open = ref(false);
const setOpen = (value: boolean) => {
  open.value = value;
};

watchEffect(() => {
  setOpen(props.dialog);
});

const product = useProduct();
const { products } = toRefs(product);

const order = useOrder();
const { quantity, productId, errors: validationErrors } = toRefs(order);

onMounted(async () => {
  await product.getProducts();
});

const handleSubmission = async () => {
  await order.createOrder();
  emitOrderCreated();
  emitClose();
};
</script>
<template>
  <v-dialog v-model="open" width="auto">
    <form @submit.prevent="handleSubmission">
      <v-card width="500">
        <v-card-title>Add Order</v-card-title>
        <v-card-text>
          <v-autocomplete
            v-model="productId"
            :items="products"
            label="Product"
            item-value="id"
            item-title="name"
            density="comfortable"
            placeholder="Select a product"
            :error-messages="validationErrors?.product_id"
          ></v-autocomplete>
          <v-text-field
            v-model="quantity"
            type="number"
            label="Quantity"
            density="comfortable"
            :error-messages="validationErrors?.quantity"
          ></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="emitClose" color="red" variant="tonal">Close</v-btn>
          <v-spacer></v-spacer>
          <v-btn type="submit" color="primary" variant="tonal">
            Add Order
          </v-btn>
        </v-card-actions>
      </v-card>
    </form>
  </v-dialog>
</template>
