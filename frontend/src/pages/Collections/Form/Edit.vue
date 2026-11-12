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
            label="Descrição da Cédula"
            autogrow
          )
          q-select(v-model="model" multiple clearable :options="options" outlined label="Standard" class="col-4")
        q-btn(label="Enviar" type="submit" color="primary" class="col-3")
</template>

<script setup>
import { useQuasar } from "quasar";
import cedulaService from "src/services/cedulaService";
import collectionService from "src/services/collectionService";
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import { useRouter } from "vue-router";

const $q = useQuasar();
const route = useRoute(); // use useRoute to get the route object
const router = useRouter();
const name = ref(null);
const url_img = ref("");
const observation = ref("");
const model = ref([]);
const options = ref([]);

// Function to load options
const option = async () => {
  const user = JSON.parse(localStorage.getItem("user"));
  const cedula = new cedulaService();
  const bernardo = await cedula.getMyCedula(user.id);
  options.value = bernardo.map((item) => ({
    label: item.name,
    value: item.id,
  }));
};

// Function to convert file to base64
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

// Load options on component mount
onMounted(async () => {
  option();
  const collectionId = route.params.collectionId; // Get the parameter from the route
  console.log("Route parameter (id):", collectionId);

  // Fetch collection details using the collectionId if needed
  const service = new collectionService();
  const collectionDetails = await service.getByCollection(collectionId);
  console.log("Collection Details:", collectionDetails);

  name.value = collectionDetails.name;
  observation.value = collectionDetails.observation;
  // url_img.value = collectionDetails.url_img;

  model.value = collectionDetails.moneys.map((item) => {
    return {
      label: item.name,
      value: item.id,
    };
  });
});

// Function to handle form submission
const onSubmit = async () => {
  console.clear();
  console.log("ENVIADO PARA LA BASE DE DADOS", url_img);
  const collectionId = route.params.collectionId;
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
  console.log("Form data:", body);
  const collections = new collectionService();
  const bernardo = await collections.edit(collectionId, body);
  console.log(body, bernardo);
  router.replace("/dashboard/collections");
};

// Function to reset form fields
const onReset = () => {
  name.value = "";
  observation.value = "";
  url_img.value = [];
  model.value = [];
};
</script>
