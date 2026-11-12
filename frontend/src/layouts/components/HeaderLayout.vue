<template>
  <q-header reveal class="bg-primary text-white" height-hint="50">
    <q-toolbar>
      <q-img
        src="../../../public/logos/imagem-preta.svg"
        width="40px"
        class="q-mr-lg q-ml-sm"
      />

      <q-tabs align="left">
        <q-route-tab
          to="/dashboard/portfolio"
          label="Portifólio"
          style="color: black"
        />
        <q-route-tab
          to="/dashboard/marketplace"
          label="Mercado"
          style="color: black"
        />
        <q-route-tab
          to="/dashboard/collections"
          label="Coleções"
          style="color: black"
        />
        <!-- <q-route-tab to="/page3" label="Page Three" /> -->
      </q-tabs>
      <q-space />

      <q-btn color="black" flat fab-mini ripple square push>
        <!-- append="card_giftcard" -->
        <q-icon left size="" name="person" />
        <p class="q-mb-none">{{ user.name }}</p>
        <q-menu>
          <div class="row no-wrap q-pa-md">
            <div class="column items-center">
              <q-avatar size="72px">
                <img src="https://cdn.quasar.dev/img/avatar4.jpg" />
              </q-avatar>

              <div class="text-subtitle1 q-mt-md q-mb-xs">{{ user.name }}</div>

              <q-btn
                color="primary"
                label="Sair"
                push
                size="sm"
                @click="logout"
                v-close-popup
              />
            </div>
          </div>
        </q-menu>
      </q-btn>
    </q-toolbar>
  </q-header>
</template>

<script setup>
import { ref, watchEffect } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const user = ref(
  JSON.parse(localStorage.getItem("user")) || { name: "sem nome" }
);

const updateUser = () => {
  user.value = JSON.parse(localStorage.getItem("user"));
};

watchEffect(() => {
  window.addEventListener("storage", updateUser);
  return () => {
    window.removeEventListener("storage", updateUser);
  };
});

const logout = () => {
  localStorage.removeItem("user");
  user.value = { name: "sem nome" };
  router.replace("/");
};
</script>

<style scoped>
/* Adicione seus estilos aqui */
</style>
