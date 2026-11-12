<template lang="pug">
q-card(color="white" class="q-pa-md container")
  q-card-section
    .flex.column
      h6 Criar Conta
  q-separator(class='q-mb-md')
  q-card-section(class="q-pt-md")
    q-form(@submit.prevent="onSubmit"  class="q-gutter-sm collum" )
      q-input(outlined label="Nome" v-model="name" type="text" class="q-mb-md" dense :rules="[ val => val && val.length > 0 || 'CAMPO OBRIGATÓRIO' ]")
      q-input(outlined label="Email" v-model="email" type="email" class="q-mb-md" dense :rules="[ val => val && val.length > 0 || 'CAMPO OBRIGATÓRIO', val => /.+@.+\..+/.test(val) || 'EMAIL INVÁLIDO', val => /.+@.+\.com$/.test(val) || 'EMAIL DEVE TERMINAR EM .COM' ]")
      q-input(outlined label="Password" v-model="password" :type="isPwd ? 'password' : 'text'" class="q-my-md" dense :rules="[ val => val && val.length > 0 || 'CAMPO OBRIGATÓRIO' ]")
        template(v-slot:append)
          q-icon(
            :name="isPwd ? 'visibility_off' : 'visibility'"
            class="cursor-pointer"
            @click="isPwd = !isPwd"
          )
      q-btn(label="Enviar" :loading="loading" type="submit" color="primary" class="col-3")
      router-link(to="/" class="col q-mx-md")
        q-btn(color="primary" label="Voltar" @click="NewAccont" dense class="" flat :ripple="{  center: true }")
    //router-link( to="/forgot-password")
      p.text-right.text-primary Esqueceu a senha?
  //- q-card-section
    q-card-action(class="row")
      router-link(to="/" class="col q-mx-md")
        q-btn(color="primary" label="Voltar" @click="Login" dense class="" flat  :ripple="{  center: true }" )
      q-space
      router-link(to="/register" class="col q-mx-md")
        q-btn(color="primary" label="Criar conta" @click="NewAccont" dense class="" flat :ripple="{  center: true }")
</template>
<script setup>
import userService from "src/services/userService";
import { ref } from "vue";
const name = ref("");
const email = ref("");
const password = ref("");
const isPwd = ref(true);
const lodingLogin = ref(false);
const lodingNewAccont = ref(false);
const loading = ref(false);
const Login = () => {
  lodingLogin.value = true;
};
const NewAccont = () => {
  lodingNewAccont.value = true;
};

const onSubmit = async () => {
  loading.value = true;
  console.clear();
  const body = {
    name: name.value,
    email: email.value,
    password: password.value,
  };
  const user = new userService();
  const res = await user.register(body);

  if (res.data.status) {
    // Registration redirects to login; tokens are issued only after authentication.
    window.location.replace("/");
  }
};
</script>

<style scoped>
.container {
  min-width: 400px;
}
</style>
