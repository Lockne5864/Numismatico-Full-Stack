<template lang="pug">
q-page(class="q-pa-md q-ma-md bd-black")
  q-card(class="q-pa-xl-sm")
    q-card-section
      q-card-title(class="flex items-center")
        q-icon(name="account_circle" class="q-mr-sm")
        h6 Criar Coleção
        q-space
        router-link(to="/dashboard/collections")
          q-btn(label="Voltar", color="primary")
    q-card-section
      q-form(@submit.prevent="onSubmit" @reset.prevent="onReset" class="q-gutter-sm collum" )
        div(class="q-gutter-sm row")
          q-input(
            class="col-5"
            outlined
            v-model="name"
            label="Nome da Coleção:"
            hint=""
            lazy-rules
            :rules="[ val => val && val.length > 0 || 'Please type something' ]"
          )
          //- q-input(
          //-   class="col-5"
          //-   @update:model-value="val => { url_img = val }"
          //-   multiple
          //-   outlined
          //-   type="file"
          //-   hint="Escolha foto da Coleção"
          //- )
          q-input(
            class="col-4"
            v-model="observation"
            outlined
            label="Descrição da Coleção:"
            autogrow
          )
          q-select(v-model="model" multiple clearable :options="options" outlined label="Standard" class="col-4" v-if="options.length > 0" :rules="[val => (val && val.length > 0) || 'Este campo é obrigatório']")
          div( v-else class="text-p")
            router-link(to="/dashboard/portfolio/add")
              p Por favor adicione uma cedula
        q-btn(label="Enviar" type="submit" color="primary" class="col-3")
</template>

<script setup>
import { useQuasar } from "quasar";
import cedulaService from "src/services/cedulaService";
import collectionService from "src/services/collectionService";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const $q = useQuasar();
const name = ref(null);
const url_img = ref("");
const observation = ref("");
const model = ref(null);
const options = ref([]);

const option = async () => {
  const user = JSON.parse(localStorage.getItem("user"));
  const cedula = new cedulaService();
  const bernardo = await cedula.getMyCedula(user.id);
  options.value = bernardo.map((item) => ({
    label: item.name,
    value: item.id,
  }));
};

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
option();
// onMounted(async () => {
//   await option();
// });
const onSubmit = async () => {
  console.clear();
  console.log("ENVIADO PARA LA BASE DE DADOS", url_img);
  const user = JSON.parse(localStorage.getItem("user"));
  const userId = [];
  model.value.forEach((item) => {
    userId.push(item.value);
  });
  console.clear();
  console.log(userId);

  const body = {
    name: name.value,
    observation: observation.value,
    url_img: "",
    money_id: userId,
  };
  // console.log(JSON.stringify(body));
  const collections = new collectionService();
  const bernardo = await collections.add(body);
  console.log(body, bernardo);
  router.replace("/dashboard/collections");
};

const onReset = () => {
  name.value = "";
  observation.value = "";
  url_img.value = [];
  model.value = null;
};
</script>
