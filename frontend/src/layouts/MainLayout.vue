<template>
  <q-layout view="hHh lyoupR lFf">
    <HeaderLayout />

    <q-page-container>
      <router-view class="q-ma-md" />
    </q-page-container>

    <!-- <Footer /> -->
  </q-layout>
</template>

<script setup>
import { ref } from "vue";
import HeaderLayout from "src/layouts/components/HeaderLayout.vue";
import Footer from "layouts/components/Footer.vue";
//<q-page-container><router-view /></q-page-container>
defineOptions({
  name: "MainLayout",
});
</script>
