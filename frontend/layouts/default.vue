<script setup lang="ts">
useHead({
  titleTemplate: (titleChunk) => {
    return titleChunk ? `${titleChunk} - Coamana` : "Coamana";
  },
});

const user = useSanctumUser<User>();
const { logout } = useAuth();

const handleLogout = async () => {
  await logout();
};

const drawer = ref(false);

const route = useRoute();
const currentRoute = computed(() => {
  return route.name;
});
</script>
<template>
  <v-responsive class="border rounded">
    <v-app>
      <v-app-bar title="Coamana Coding Challenge">
        <template v-slot:prepend>
          <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
        </template>

        <v-menu>
          <template v-slot:activator="{ props, isActive }">
            <v-btn color="primary" dark v-bind="props">
              {{ user?.fullname }}
              <v-icon v-if="isActive"> mdi-menu-up </v-icon>
              <v-icon v-else> mdi-menu-down </v-icon>
            </v-btn>
          </template>

          <v-list>
            <v-list-item @click="handleLogout">
              <v-list-item-title> Logout </v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
      </v-app-bar>

      <v-navigation-drawer v-model:model-value="drawer">
        <v-list>
          <v-list-item
            title="Orders"
            href="/orders"
            :active="currentRoute == 'orders'"
          ></v-list-item>
        </v-list>
      </v-navigation-drawer>

      <v-main>
        <v-container>
          <slot />
        </v-container>
      </v-main>
    </v-app>
  </v-responsive>
</template>
