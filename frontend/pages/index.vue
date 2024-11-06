<script setup lang="ts">
definePageMeta({
  middleware: ["sanctum:auth"],
});
</script>

<template>
  <h1>Index page</h1>
</template>
