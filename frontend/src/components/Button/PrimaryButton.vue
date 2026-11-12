<template lang="pug">
q-btn(style="background: #FF0080; color: white")
  slot
</template>
<script setup>
const props = defineProps({
  label: String,
});
</script>
<style scoped></style>
