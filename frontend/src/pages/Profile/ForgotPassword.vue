<template lang="pug">
q-card(color="white" class="q-pa-md container")
  q-card-section
    h6 Recuperar senha
    p Enviaremos um link de recuperação para o endereço informado.
  q-separator(class="q-mb-md")
  q-card-section
    q-form(@submit.prevent="onSubmit" class="q-gutter-sm")
      q-input(outlined v-model="email" label="Email" type="email" :rules="[val => !!val || 'EMAIL OBRIGATÓRIO']")
      q-btn(label="Enviar link" type="submit" :loading="loading" color="primary")
      router-link(to="/" class="q-ml-md") Voltar ao login
    p.q-mt-md(v-if="message") {{ message }}
</template>

<script setup>
import { ref } from 'vue'
import userService from 'src/services/userService'
const email = ref('')
const loading = ref(false)
const message = ref('')
const onSubmit = async () => {
  loading.value = true
  try {
    const res = await new userService().forgotpassword({ email: email.value })
    message.value = res.data.message || 'Verifique seu email.'
  } catch (_) {
    message.value = 'Não foi possível enviar o link. Verifique a configuração de email do servidor.'
  } finally {
    loading.value = false
  }
}
</script>
<style scoped>
.container { min-width: 400px; }
</style>
