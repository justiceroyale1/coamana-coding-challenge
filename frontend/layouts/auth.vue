<script setup lang="ts">
useHead({
  titleTemplate: (titleChunk) => {
    return titleChunk ? `${titleChunk} - Coamana` : "Coamana";
  },
});
</script>
<template>
  <v-app>
    <v-container class="py-15">
      <slot />
    </v-container>
  </v-app>
</template>
