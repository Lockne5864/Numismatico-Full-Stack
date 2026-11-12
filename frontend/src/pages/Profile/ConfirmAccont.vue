<template lang="pug">
q-card(color="white" class="q-pa-md container")
      q-card-section
        .flex.column
          h6 Esqueceu a senha?
      q-separator(class='q-mb-md')
      q-card-section(class="q-pt-md")
        q-input(outlined label="Email" v-model="email" type="email" class="q-mb-md" dense)
        //q-input(outlined label="Password" v-model="password" :type="isPwd ? 'password' : 'text'" class="q-my-md" dense)
          template(v-slot:append)
            q-icon(
              :name="isPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isPwd = !isPwd"
            )
        //router-link( to="/login")
          p.text-right.text-primary Voltar
      q-card-section
        q-card-action(class="row")
          router-link(to="/" class="col q-mx-md")
            q-btn(color="primary" label="Confirmar" @click="Login" dense class="" flat  :ripple="{  center: true }" )
          q-space
          router-link(to="/" class="col q-mx-md")
            q-btn(color="primary" label="Voltar" @click="NewAccont" dense class="" flat :ripple="{  center: true }")
</template>
<script setup>
import { ref } from "vue";
const email = ref("");
const password = ref("");
const isPwd = ref(true);
const lodingLogin = ref(false);
const lodingNewAccont = ref(false);
const Login = () => {
  lodingLogin.value = true;
};
const NewAccont = () => {
  lodingNewAccont.value = true;
};
</script>
<style scoped>
.container {
  min-width: 400px;
}
</style>
