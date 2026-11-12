<template>
  <q-page class="flex flex-center">
    <q-card class="q-pa-xl-sm bg-green">
      <q-card-section>
        <q-card-title>
          <q-icon name="account_circle" />
          <span class="q-ml-sm">{{ name }}</span>
        </q-card-title>
        <q-card-subtitle>Desenvolvedor Full Stack</q-card-subtitle>
      </q-card-section>
      <q-card-section> cards de cedulas </q-card-section>
    </q-card>
  </q-page>
</template>

<script setup>
defineOptions({
  name: "IndexPage",
});
</script>
