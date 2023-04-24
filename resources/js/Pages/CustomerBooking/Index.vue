<template>
    <Layout :show-header="false">
        <!-- Slots -->
        <!-- component -->
        <div class="h-screen md:flex">
            <div
                class="relative overflow-hidden md:flex w-1/2 bg-gradient-to-tr from-blue-800 to-purple-700 i justify-around items-center hidden">
                <div>
                    <h1 class="text-white font-bold text-4xl font-sans">{{ usePage().props.appName }}</h1>
                    <p class="text-white mt-1">The Best Services in Town :)</p>
                </div>
                <div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8">
                </div>
                <div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8">
                </div>
                <div class="absolute -top-40 -right-0 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
                <div class="absolute -top-20 -right-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            </div>
            <div class="flex md:w-1/2 justify-center py-10 items-center bg-white">
                <BookingForm/>
            </div>
        </div>
    </Layout>
</template>

<script setup>
// import the layout file
import BookingForm from "../../components/Reusable/Booking.vue";
import Layout from "../../components/Layout/Main.vue";
import { usePage } from "@inertiajs/vue3";

</script>
