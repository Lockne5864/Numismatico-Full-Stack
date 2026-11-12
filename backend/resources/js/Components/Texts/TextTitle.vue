<script setup>
defineProps({
	helpers: {
		type: String,
		required: false,
	},
});
</script>

<template>
	<h1 :class="'font-bold ' + `${helpers ? helpers : 'text-xl'}`">
		<slot />
	</h1>
</template>
