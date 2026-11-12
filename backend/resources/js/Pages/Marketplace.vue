<template>
	<Head title="Mercado" />
	<AuthenticatedLayout>
		<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div
				class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900"
			>
				<div class="flex flex-row justify-between">
					<TextTitle> Disponiveis para compra</TextTitle>
					<!-- <PrimaryButton @click="addNotes" color="green"
						>Adicionar</PrimaryButton
					> -->
				</div>
				<div class="cards" v-for="market in marketplace">
					<MoneyCard :money="market.money" />
				</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>
<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import MoneyCard from "@/Components/Cards/MoneyCard.vue";
// import TextParagraf from "@/Components/Texts/TextParagraf.vue";
import TextTitle from "@/Components/Texts/TextTitle.vue";
// import PrimaryButton from "@/Components/Button/PrimaryButton.vue";
// import Modal from "@/Components/Modal.vue";
// import InputLabel from "@/Components/Inputs/InputLabel.vue";
// import TextInput from "@/Components/Inputs/TextInput.vue";
// import InputError from "@/Components/Inputs/InputError.vue";
// import { useForm } from "@inertiajs/vue3";
// import { ref } from "vue";

defineProps({
	marketplace: {
		type: Array,
	},
});
</script>
