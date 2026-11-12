<template lang="pug">
q-page(class="q-pa-md q-ma-md bd-black")
    q-card(class="q-pa-xl-sm")
      q-card-section
        q-card-title(class="flex items-center")
          q-icon(name="account_circle" class="q-mr-sm")
          h6 Adicione a Cédula
          q-space
          router-link(to="/dashboard/portfolio")
            q-btn(label="Voltar", color="primary")
      q-card-section
        q-form(@submit.prevent="onSubmit" @reset.prevent="onReset" class="q-gutter-sm collum" )
          div(class="q-gutter-sm row")
            q-input(
              class="col-5"
              outlined
              v-model="country"
              label="Pais de Origem:"
              hint="Brasil, EUA, Russia, etc"
              lazy-rules
              :rules="[ val => val && val.length > 0 || 'CAMPO OBRIGATÓRIO' ]"
            )
            q-input(
              class="col-5"
              outlined
              v-model="name"
              label="Nome"
              hint="Nome da Cedula"
              lazy-rules
              :rules="[ val => val && val.length > 0 || 'CAMPO OBRIGATÓRIO' ]"
            )
            q-input(
              class="col-5"
              @update:model-value="val => { url_img = val }"
              multiple
              outlined
              type="file"
              hint="Escolha foto da Cédula, OBRIGATÓRIO"

            )

          div(class="q-gutter-sm row")
            q-input(
              class="col-2  "
              outlined
              v-model="material"
              label="Material:"
              hint="polimero, papel, plastico,etc"
              lazy-rules
              :rules="[ val => val && val.length > 0 || 'CAMPO OBRIGATÓRIO' ]"
            )
            q-input(
              class="col-2"
              outlined
              v-model="condition"
              label="Concervação:"
              hint="FE, MDI, ...."
              lazy-rules
              :rules="[ val => val && val.length > 0 || 'CAMPO OBRIGATÓRIO' ]"
            )
            q-input(
              class="col-2"
              outlined
              type="number"
              v-model="year"
              label="Ano"
              lazy-rules
            )
          div(class="q-gutter-sm row")
            q-input(
              class="col-3"
              outlined
              type="number"
              v-model="price"
              label="Preço para a venda"
              lazy-rules
              :disable="available_sell"
            )
            q-input(
              class="col-3"
              outlined
              type="number"
              v-model="price"
              label="Preço de Compra"
              lazy-rules

            )
            q-input(
              class="col-4"
              v-model="observation"
              outlined
              label="Descrição da Cédula"
              autogrow
            )

          //- :rules="[ val => val !== null && val !== '' || 'Please type your year',
          //-     val => val > 0 && val < 100 || 'Please type a real year'
          //-   ]"
          q-toggle(v-model="available_sell" label="Disponivel para a venda?" class="col-3")
          div
            q-btn(label="Enviar" type="submit" color="primary" class="col-3")
            //- q-btn(label="Reset" type="reset" color="primary" flat class="q-ml-sm")
</template>

<script setup>
import { useQuasar } from "quasar";
import cedulaService from "src/services/cedulaService";
import { ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const $q = useQuasar();
const name = ref(null);
const year = ref(null);
const url_img = ref(null);
const country = ref("");
const material = ref("");
const condition = ref("");
const observation = ref("");
const price = ref("");

const available_sell = ref(false);

const convertToBase64 = (file) => {
  return new Promise((resolve, reject) => {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(file);
    fileReader.onload = () => {
      resolve(fileReader.result);
    };
    fileReader.onerror = (error) => {
      reject(error);
    };
  });
};

const onSubmit = async () => {
  console.clear();
  console.log("ENVIADO PARA LA BASE DE DADOS");
  const user = JSON.parse(localStorage.getItem("user"));
  const body = {
    name: name.value,
    year: year.value,
    country: country.value,
    condition: condition.value,
    price: price.value,
    observation: observation.value,
    material: material.value,
    available_sell: available_sell.value,
    url_img: await convertToBase64(url_img.value[0]),
    user_id: user.id + "",
    available_sell: available_sell.value,
  };
  console.log(JSON.stringify(body));
  const cedula = new cedulaService();
  const bernardo = await cedula.create(body);
  console.log(available_sell.value);
  router.replace("/dashboard/portfolio");
};

const onReset = () => {
  name.value = "";
  year.value = null;
};
</script>
