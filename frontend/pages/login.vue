<script setup lang="ts">
definePageMeta({
  layout: "auth",
});

useHead({
  title: "Login",
});

const registrationLink = "/register";
</script>

<template>
  <v-container>
    <form>
      <v-card class="mx-auto my-8" max-width="400">
        <v-card-title class="text-center"> Login </v-card-title>

        <v-card-subtitle class="text-center">
          Log into your account
        </v-card-subtitle>

        <v-card-text>
          <v-text-field label="Email" density="comfortable"></v-text-field>
          <v-text-field label="Password" density="comfortable"></v-text-field>
        </v-card-text>
        <v-card-actions class="justify-space-between">
          <v-btn :href="registrationLink" variant="plain">
            Create New Account
          </v-btn>
          <v-btn color="primary"> Login </v-btn>
        </v-card-actions>
      </v-card>
    </form>
  </v-container>
</template>
