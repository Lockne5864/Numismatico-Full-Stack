<script setup>
import TextTitle from "@/Components/Texts/TextTitle.vue";
import TextParagraph from "@/Components/Texts/TextParagraf.vue";
import PrimaryButton from "@/Components//Button/PrimaryButton.vue";
import DangerButton from "@/Components//Button/DangerButton.vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
	name: null,
	avatar: null,
});
const showModal = ref(false);

defineProps({
	money: {
		type: Object,
	},
});

const priceFormat = (number) => {
	return new Intl.NumberFormat("pt-BR", {
		style: "currency",
		currency: "BRL",
	}).format(number);
};

function color(money) {
	if (money.available_sell === 1) {
		return "bg-green-100";
	}
	return "bg-red-100";
}

// function submit() {
// 	form.delete(route("delMoney", { id: moneyId }));
// }
</script>

<template>
	<div
		:class="`m-2 py-6 rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8 ${color(
			money,
		)} flex`"
	>
		<img
			:src="money.url_img"
			:alt="money.name"
			style="width: 136px; height: 142.66px"
		/>
		<!-- class="w-32 h-32" -->
		<div class="mx-6 w-screen justify-between">
			<div class="flex justify-between my-3">
				<TextTitle helpers="text-lg">{{ money.name }}</TextTitle>

				<TextParagraph>{{ money.country }}</TextParagraph>
			</div>
			<div class="flex justify-between my-3">
				<div class="flex flex-col">
					<TextParagraph>Material: {{ money.type }}</TextParagraph>
				</div>
				<div class="flex flex-col">
					<TextParagraph>Conservação: {{ money.condition }}</TextParagraph>
				</div>
			</div>

			<div class="flex justify-between my-3">
				<TextParagraph>{{
					money.available_sell === 1 ? priceFormat(money.price) : ""
				}}</TextParagraph>
				<PrimaryButton v-if="money.observation" @click="showModal = true">
					Observação
				</PrimaryButton>

				<!-- <DangerButton @click="deletar()">
					<Link :href="route('delMoney')"> Mercado </Link>
				</DangerButton> -->
			</div>
		</div>
	</div>

	<div
		v-if="showModal"
		class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
		@click.self="showModal = false"
	>
		<div
			class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white"
		>
			<div class="mt-3 text-center">
				<div class="mx-3">
					<TextTitle>Observação</TextTitle>
					<TextParagraph>{{ money.observation }}</TextParagraph>
				</div>
				<div class="items-center px-4 py-3">
					<form @submit.prevent="submit">
						<button
							class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300"
							@click="showModal = false"
						>
							Fechar
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>
