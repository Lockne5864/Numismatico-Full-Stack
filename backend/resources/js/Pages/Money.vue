<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import MoneyCard from "@/Components/Cards/MoneyCard.vue";
import TextParagraf from "@/Components/Texts/TextParagraf.vue";
import TextTitle from "@/Components/Texts/TextTitle.vue";
import PrimaryButton from "@/Components/Button/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/Inputs/InputLabel.vue";
import TextInput from "@/Components/Inputs/TextInput.vue";
import InputError from "@/Components/Inputs/InputError.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
defineProps({
	moneys: {
		type: Array,
	},
});
const addBankNote = ref(false);
const form = useForm({
	name: "",
	year: "",
	country: "",
	condition: "",
	price: "",
	observation: "",
	type: "",
	material: "",
	available_sell: "",
	concervation: "",
	price: "",
	url_img: "",
});
const addNotes = () => {
	addBankNote.value = true;
};
const closeModal = () => {
	addBankNote.value = false;
	console.clear();
	console.log(form);
	form.reset();
};
const submit = () => {
	form.post(route("addBanknotes"), {
		onFinish: () => form.reset(),
	});
	closeModal();
};
const handleFileSelection = async (event) => {
	const files = event.target.files;
	for (let i = 0; i < files.length; i++) {
		const base64Data = await readFileAsBase64(files[i]);
		form.url_img = base64Data;
	}
};
const readFileAsBase64 = (file) => {
	return new Promise((resolve, reject) => {
		const reader = new FileReader();
		reader.onload = (event) => {
			resolve(event.target.result);
		};
		reader.onerror = (error) => {
			reject(error);
		};
		reader.readAsDataURL(file);
	});
};
</script>
<template>
	<Head title="Cedulas" />

	<AuthenticatedLayout>
		<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div
				class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900"
			>
				<div class="flex flex-row justify-between">
					<TextTitle> Suas Cedulas</TextTitle>
					<PrimaryButton @click="addNotes" color="green"
						>Adicionar</PrimaryButton
					>
				</div>

				<div class="cards" v-for="money in moneys">
					<MoneyCard :money="money" />
				</div>
			</div>
		</div>
	</AuthenticatedLayout>

	<Modal :show="addBankNote" @close="closeModal">
		<div class="p-6">
			<TextTitle> Adicionar Cedula</TextTitle>
			<form @submit.prevent="submit">
				<div>
					<InputLabel for="name" value="Nome" />

					<TextInput
						id="name"
						type="text"
						class="mt-1 block w-full"
						v-model="form.name"
						required
						autofocus
						autocomplete="name"
					/>

					<InputError class="mt-2" :message="form.errors.name" />
				</div>
				<div class="mt-4">
					<InputLabel for="year" value="Ano" />

					<TextInput
						id="year"
						type="number"
						class="mt-1 block w-full"
						v-model="form.year"
						autofocus
						autocomplete="year"
					/>

					<InputError class="mt-2" :message="form.errors.year" />
				</div>
				<div class="mt-4">
					<InputLabel for="country" value="Pais" />

					<TextInput
						id="country"
						type="text"
						class="mt-1 block w-full"
						v-model="form.country"
						required
						autofocus
						autocomplete="country"
					/>

					<InputError class="mt-2" :message="form.errors.country" />
				</div>

				<div class="mt-4">
					<InputLabel for="condition" value="Condição" />

					<TextInput
						id="condition"
						type="text"
						class="mt-1 block w-full"
						v-model="form.condition"
						required
						autofocus
						autocomplete="condition"
					/>

					<InputError class="mt-2" :message="form.errors.condition" />
				</div>

				<div class="mt-4">
					<InputLabel for="observation" value="Observação" />

					<TextInput
						id="observation"
						type="text"
						class="mt-1 block w-full"
						v-model="form.observation"
						autofocus
						autocomplete="observation"
					/>

					<InputError class="mt-2" :message="form.errors.observation" />
				</div>

				<div class="mt-4">
					<InputLabel for="type" value="Tipo: (Papel, ...) " />

					<TextInput
						id="type"
						type="text"
						class="mt-1 block w-full"
						v-model="form.type"
						autofocus
						autocomplete="type"
					/>

					<InputError class="mt-2" :message="form.errors.type" />
				</div>

				<div class="mt-4">
					<InputLabel for="available_sell" value="Disponivel para venda? " />

					<TextInput
						id="available_sell"
						type="radio"
						class="mt-1 block w-full"
						v-model="form.available_sell"
						value="true"
						autocomplete="available_sell"
					/>

					<InputError class="mt-2" :message="form.errors.available_sell" />
				</div>

				<div class="mt-4">
					<InputLabel for="price" value="Preço " />

					<TextInput
						id="price"
						type="number"
						class="mt-1 block w-full"
						v-model="form.price"
						autofocus
						autocomplete="price"
					/>

					<InputError class="mt-2" :message="form.errors.price" />
				</div>

				<div class="mt-4">
					<InputLabel for="concervation" value="Concervacao " />

					<TextInput
						id="concervation"
						type="text"
						class="mt-1 block w-full"
						v-model="form.concervation"
						autofocus
						autocomplete="concervation"
					/>

					<InputError class="mt-2" :message="form.errors.concervation" />
				</div>

				<div class="mt-4">
					<InputLabel for="price" value="Coloque a imagem da cedula" />

					<label class="block">
						<span class="sr-only">Coloque a imagem da cedula</span>
						<input
							type="file"
							id="image"
							required
							autofocus
							@change="handleFileSelection"
							class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"
						/>
					</label>

					<InputError class="mt-2" :message="form.errors.price" />
				</div>
				<PrimaryButton
					class="mt-4"
					:class="{ 'opacity-25': form.processing }"
					:disabled="form.processing"
				>
					Cadastar
				</PrimaryButton>
			</form>
		</div>
	</Modal>
</template>
