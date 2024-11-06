<script setup lang="ts">
definePageMeta({
  layout: "auth",
});

useHead({
  title: "Register",
});

const loginLink = "/login";

const auth = useAuth();
const {
  fullname,
  password,
  email,
  passwordConfirmation,
  processing,
  errors: validationErrors,
} = toRefs(auth);

const register = async () => {
  await auth.register();
};
</script>

<template>
  <v-container>
    <form @submit.prevent="register">
      <v-card class="mx-auto my-8" max-width="400">
        <v-card-title class="text-center"> Register </v-card-title>

        <v-card-subtitle class="text-center">
          Create a new account
        </v-card-subtitle>

        <v-card-text>
          <v-text-field
            v-model="fullname"
            class="py-3"
            label="Full Name"
            density="comfortable"
            :error-messages="validationErrors?.fullname"
          ></v-text-field>
          <v-text-field
            v-model="email"
            class="py-3"
            label="Email"
            type="email"
            density="comfortable"
            autocomplete="email"
            :error-messages="validationErrors?.email"
          ></v-text-field>
          <v-text-field
            v-model="password"
            class="py-3"
            label="Password"
            type="password"
            density="comfortable"
            autocomplete="current-password"
            :error-messages="validationErrors?.password"
          ></v-text-field>
          <v-text-field
            v-model="passwordConfirmation"
            class="pt-4"
            label="Confirm Password"
            type="password"
            density="comfortable"
            autocomplete="current-password"
          ></v-text-field>
        </v-card-text>
        <v-card-actions class="justify-space-between">
          <v-btn :href="loginLink" variant="plain"> Already Registered </v-btn>
          <v-btn color="primary" type="submit" :loading="processing">
            Register
          </v-btn>
        </v-card-actions>
      </v-card>
    </form>
  </v-container>
</template>
