<template>
  <q-page class="q-pa-md bd-black">
    <q-card class="q-pa-xl-sm">
      <q-card-section>
        <q-card-title class="flex items-center">
          <!-- <q-icon name="money" class="q-mr-sm" /> -->
          <h6>Suas Coleções</h6>
          <q-space />
          <router-link to="/dashboard/collections/add">
            <PrimaryButton>Criar</PrimaryButton>
          </router-link>
        </q-card-title>
      </q-card-section>

      <q-card-section>
        <!-- <Cedula
          v-for="cedula in cedulas"
          :key="cedula.id"
          :cedula="cedula"
          changeble
        /> -->
        <q-list
          padding
          bordered
          class="rounded-borders"
          v-if="collections.length > 0"
        >
          <q-expansion-item
            v-for="collection in collections"
            :key="collection.id"
            switch-toggle-side
            expand-separator
            :label="collection.name"
          >
            <q-card :title="collection.observation">
              <q-card-section class="flex">
                <div class="text-h6">{{ collection.observation }}</div>
                <q-space />
                <!-- <div class="text-subtitle2">{{ collection.observation }}</div> -->
                <router-link :to="`collections/add/${collection.id}`">
                  <PrimaryButton>editar</PrimaryButton>
                </router-link>
              </q-card-section>

              <q-card-section>
                <Cedula
                  v-for="cedula in collection.moneys"
                  :key="cedula.id"
                  :cedula="cedula"
                />
              </q-card-section>
            </q-card>
          </q-expansion-item>
        </q-list>
        <div v-else class="text-h6">Por favor adicione uma Coleção</div>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Cedula from "../../components/Card/Cedula.vue";
import PrimaryButton from "src/components/Button/PrimaryButton.vue";
import cedulaService from "src/services/cedulaService";
import collectionService from "src/services/collectionService";

const collections = ref([]);
onMounted(async () => {
  const user = JSON.parse(localStorage.getItem("user"));
  const service = new collectionService();
  collections.value = await service.getAll();
  console.log(collections.value);
});
</script>
