<template lang="pug">
q-card(
  class="q-pa-md q-my-sm row items-center "
  :class="cedula.available_sell===0 || cedula.available_sell==undefined ?'bg-red-3' : 'bg-green-2'"
  flat
)
  q-img(
    style="height: 140px; max-width: 150px"
    class="col"
    :src="cedula.url_img"
  )
  div(class="col q-mx-md")
    div(class="flex  items-center")
      div(class="collumn w-100 ")
        h5 {{ cedula.name }}
        small {{ cedula.year }}
      q-space
      p {{ cedula.country }}
    div(class="flex items-center q-my-md")
      p Material: {{ cedula.material }}
      q-space
      p Conservação: {{ cedula.condition }}
    div(class="flex items-center q-my-md")
      q-btn(outline color="primary" label="Observações" @click="basic = true" )
      q-space
      q-btn(outline v-if="changeble" color="primary" :label="cedula.available_sell===0 ? 'Vender Ela!': 'Tirar da venda!'" @click="toSell()" )
      q-space( v-if="changeble")
      div( class="column")
        p( v-if="ofPerson" class="self-end") de: <b>{{ cedula.user.name }}</b>

        p Valor de Compra: <b>R${{ formatNumber(cedula.price) }}</b>
    q-dialog( v-model="basic" transition-show="rotate" transition-hide="rotate")
      q-card
        q-card-section
          div( class="text-h6") Descrição

        q-card-section( class="q-pt-none")
          p(  ) {{ cedula.observation }}
        q-card-actions(align="right")
          q-btn( flat label="Fechar" color="primary" v-close-popup )

  div(class="col-1")

</template>
<script setup>
import { ref, defineProps } from "vue";
import cedulaService from "src/services/cedulaService";

const props = defineProps({
  cedula: Object,
  changeble: Boolean,
  ofPerson: Boolean,
});
const toSell = async () => {
  const cedula = new cedulaService();
  await cedula.changeToMarketplace(props.cedula.id);
  location.reload();
};

const formatNumber = (numberString) => {
  // Remove qualquer caractere não numérico, exceto o ponto (.) e a vírgula (,)
  const cleanNumberString = numberString.replace(/[^0-9.,]/g, "");

  // Se a string contém vírgula, presumimos que é separador decimal no formato brasileiro
  let number;
  if (cleanNumberString.includes(",")) {
    // Troca vírgula por ponto para converter para número corretamente
    const normalizedNumberString = cleanNumberString
      .replace(/\./g, "")
      .replace(",", ".");
    number = parseFloat(normalizedNumberString);
  } else {
    // Se não há vírgula, presumimos que já está no formato correto
    number = parseFloat(cleanNumberString);
  }

  // Formata o número para o padrão desejado
  const formattedNumber = number.toLocaleString("pt-BR", {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  });

  return formattedNumber;
};

const basic = ref(false);
</script>
<style></style>
