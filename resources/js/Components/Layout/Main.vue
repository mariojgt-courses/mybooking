<template>
    <Header v-if="showHeader" />
    <FlashMessage />
    <slot />
    <div id="modals">
    </div>
</template>

<script setup>
import { ref } from 'vue'
import Header from "./Header.vue";
import FlashMessage from "./FlashMessage.vue";

defineProps({
    showHeader: {
        type: Boolean,
        default: true
    },
})

</script>
