<script setup lang="ts">
definePageMeta({
  layout: "auth",
});

useHead({
  title: "Login",
});

const registrationLink = "/register";

const auth = useAuth();
const { email, password, remember, validationErrors, processing } =
  toRefs(auth);
</script>

<template>
  <v-container>
    <form @submit.prevent="auth.processLogin">
      <v-card class="mx-auto my-8" max-width="400">
        <v-card-title class="text-center"> Login </v-card-title>

        <v-card-subtitle class="text-center">
          Log into your account
        </v-card-subtitle>

        <v-card-text>
          <v-text-field
            v-model="email"
            class="py-3"
            label="Email"
            type="email"
            density="comfortable"
            :error-messages="validationErrors?.email"
          ></v-text-field>
          <v-text-field
            v-model="password"
            class="py-3"
            label="Password"
            type="password"
            density="comfortable"
            :error-messages="validationErrors?.password"
          ></v-text-field>
          <v-checkbox
            v-model="remember"
            class="py-3"
            label="Remember me"
          ></v-checkbox>
        </v-card-text>
        <v-card-actions class="justify-space-between">
          <v-btn :href="registrationLink" variant="plain">
            Create New Account
          </v-btn>
          <v-btn color="primary" type="submit" :loading="processing">
            Login
          </v-btn>
        </v-card-actions>
      </v-card>
    </form>
  </v-container>
</template>
