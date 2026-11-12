<script setup>
defineProps({
	helpers: {
		type: String,
		required: false,
	},
});
</script>

<template>
	<p :class="`${helpers}`">
		<slot />
	</p>
</template>
