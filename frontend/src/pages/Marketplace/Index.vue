<template lang="pug">
q-page(class="q-pa-md bd-black")
  q-card(class="q-pa-xl-sm")
    q-card-section
      q-card-title(class="flex items-center")
        h6 Mercado
        q-space
        //- router-link(to="/dashboard/portfolio/add")
          PrimaryButton Adicionar
    q-card-section

      Cedula(v-for="cedula in cedulas" :key="cedula.id" :cedula="cedula" ofPerson )
</template>
<script setup>
import Cedula from "../../components/Card/Cedula.vue";
import PrimaryButton from "src/components/Button/PrimaryButton.vue";
import { ref, onMounted } from "vue";
import cedulaService from "src/services/cedulaService";

const cedulas = ref([]);
onMounted(async () => {
  const cedula = new cedulaService();
  cedulas.value = await cedula.getMarcketplaceCedula();
  console.log(cedulas.value);
});
</script>
<style></style>
