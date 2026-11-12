<template>
	<div>
		<InputLabel :for="name" :value="value" />

		<TextInput
			:id="name"
			:type="type"
			class="mt-1 block w-full"
			v-model="model"
			:required="!required"
			autofocus
			autocomplete="name"
		/>

		<InputError class="mt-2" :message="errors" />
	</div>
</template>

<script setup>
import InputLabel from "./InputLabel.vue";
import TextInput from "./TextInput.vue";
import InputError from "./InputError.vue";

defineProps({
	teste: {
		type: String,
	},
});

defineProps({
	name: {
		type: String,
	},
});

defineProps({
	value: {
		type: String,
	},
});

defineProps({
	type: {
		type: String,
	},
});

defineProps({
	model: {
		type: String,
	},
});

defineProps({
	errors: {
		type: String,
	},
});

defineProps({
	required: {
		type: String,
	},
});
</script>
