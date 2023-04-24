<template></template>

<script setup>
import { watch, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import { startWindToast } from "@mariojgt/wind-notify/packages/index.js";

watch(
  () => usePage().props.errors,
  (v) => {
    // Loop any possible page errors and display the message
    if (usePage().props.errors) {
      for (const [key, value] of Object.entries(usePage().props.errors)) {
        // Display a message using the helper
        handleMessage("error", value);
      }
    }
  }
);
// Check if there is a flash message and display it
onMounted(() => {
  if (usePage().props.flash) {
    handleMessage(
      usePage().props.flash.type,
      usePage().props.flash.message
    );
  }
});
watch(
  () => usePage().props.flash,
  (v) => {
    // If there is any message we can display it
    if (usePage().props.flash) {
      handleMessage(
        usePage().props.flash.type,
        usePage().props.flash.message
      );
    }
  }
);
// This function will display a message based on the message type
const handleMessage = async (type, messageData) => {
  switch (type) {
    case "success":
        startWindToast('Success 😎', messageData, 'success', 30, 'top');
      break;
    case "error":
        startWindToast('Error 😢', messageData, 'error', 20, 'top');
      break;
    case "warning":
        startWindToast('Waring 😱', messageData, 'warning', 20, 'top');
      break;
    case "info":
        startWindToast('Info 😱', messageData, 'info', 20, 'top');
      break;
    default:
        startWindToast('😢', messageData, 'info', 20, 'top');
      break;
  }
};
</script>
