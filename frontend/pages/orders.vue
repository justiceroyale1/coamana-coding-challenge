<script setup lang="ts">
import { OrderDialog } from "#components";

useHead({
  title: "Orders",
});

const headers = [
  {
    title: "ORDER ID",
    align: "start",
    key: "id",
  },
  { title: "ORDER #", key: "order_number", align: "end" },
  { title: "USERNAME", key: "username", align: "end" },
  { title: "PRODUCT", key: "product", align: "end" },
  { title: "QTY", key: "quantity", align: "end" },
  { title: "AMOUNT", key: "amount", align: "end" },
  { title: "DATE", key: "created_at", align: "end" },
];

const order = useOrder();

const { orders, loading } = toRefs(order);

onMounted(() => {
  order.getOrders();
});

const dialog = useDialog();
const { dialogToggle } = toRefs(dialog);

const showAlert = ref(false);
const setShowAlert = (value: boolean) => {
  showAlert.value = value;
};
const handleOrderCreation = async () => {
  await order.getOrders();
  setShowAlert(true);
};
</script>

<template>
  <v-row>
    <v-col cols="12">
      <v-row>
        <v-col>
          <div class="text-h3">Orders</div>
        </v-col>
        <v-col class="d-flex align-center justify-end">
          <v-btn variant="tonal" color="primary" @click="dialog.open">
            Add Order
          </v-btn>
          <OrderDialog
            :dialog="dialogToggle"
            @close="dialog.close"
            @order-created="handleOrderCreation"
          ></OrderDialog>
        </v-col>
      </v-row>
    </v-col>
    <v-col cols="12">
      <v-row>
        <v-col cols="12" lg="6" class="mx-auto">
          <v-alert
            v-model="showAlert"
            title="Order Added!"
            type="success"
            closable
          ></v-alert>
        </v-col>
      </v-row>
    </v-col>
    <v-col cols="12">
      <v-data-table :headers="headers" :items="orders" :loading="loading">
      </v-data-table>
    </v-col>
  </v-row>
</template>
