<template>
    <Layout>
        <!-- Slots -->
        <div class="overflow-x-auto">
            <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <div class="flex flex-row">
                        <h1 class="text-3xl text-gray-800 font-bold leading-tight">
                            Bookings
                        </h1>
                        <div class="ml-auto">
                            <button type="button" @click="isOpen = true"
                                class="rounded-md bg-blue-500 bg-opacity-20 px-4 py-2 text-sm font-medium text-blue-500 hover:bg-opacity-30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                                Add New
                            </button>
                        </div>
                    </div>
                    <div class=" shadow-md rounded my-6">
                        <div class="container mx-auto mt-10">
                            <div class="wrapper bg-white rounded shadow w-full ">
                                <div class="header flex justify-between border-b p-2">
                                    <span class="text-lg font-bold">
                                        {{ usePage().props.selected_data_month_year }}
                                    </span>
                                    <div class="buttons">
                                        <button class="p-1" @click="changeMonth(false)">
                                            <svg width="1em" fill="gray" height="1em" viewBox="0 0 16 16"
                                                class="bi bi-arrow-left-circle" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M8.354 11.354a.5.5 0 0 0 0-.708L5.707 8l2.647-2.646a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708 0z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M11.5 8a.5.5 0 0 0-.5-.5H6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button class="p-1" @click="changeMonth(true)">
                                            <svg width="1em" fill="gray" height="1em" viewBox="0 0 16 16"
                                                class="bi bi-arrow-right-circle" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M7.646 11.354a.5.5 0 0 1 0-.708L10.293 8 7.646 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M4.5 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <table class="w-full">
                                    <thead>
                                        <tr>
                                            <th
                                                class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                                                <span class="xl:block lg:block md:block sm:block hidden">Monday</span>
                                                <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Mon</span>
                                            </th>
                                            <th
                                                class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                                                <span class="xl:block lg:block md:block sm:block hidden">Tuesday</span>
                                                <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Tue</span>
                                            </th>
                                            <th
                                                class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                                                <span class="xl:block lg:block md:block sm:block hidden">Wednesday</span>
                                                <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Wed</span>
                                            </th>
                                            <th
                                                class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                                                <span class="xl:block lg:block md:block sm:block hidden">Thursday</span>
                                                <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Thu</span>
                                            </th>
                                            <th
                                                class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                                                <span class="xl:block lg:block md:block sm:block hidden">Friday</span>
                                                <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Fri</span>
                                            </th>
                                            <th
                                                class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                                                <span class="xl:block lg:block md:block sm:block hidden">Saturday</span>
                                                <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Sat</span>
                                            </th>
                                            <th
                                                class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                                                <span class="xl:block lg:block md:block sm:block hidden">Sunday</span>
                                                <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Sun</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center h-20" v-for="(item, index) in usePage().props.calendar"
                                            :key="index">
                                            <td class="border p-1 h-40 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 overflow-auto transition cursor-pointer duration-500 ease hover:bg-gray-300 "
                                                v-for="(ItemCalendar, calendarIndex) in item" :key="calendarIndex">
                                                <div v-if="!ItemCalendar.blocked"
                                                    class="flex flex-col h-40 mx-auto xl:w-40 lg:w-30 md:w-30 sm:w-full w-10 overflow-hidden">
                                                    <div class="top h-5 w-full">
                                                        <span class="text-gray-500">{{ calendarIndex }}</span>
                                                    </div>
                                                    <div class="bottom flex-grow h-30 py-1 w-full cursor-pointer"
                                                        v-for="(item, index) in ItemCalendar.bookings" :key="index"
                                                        @click="openDeleteModal(item)" :dusk="item.booking.name">
                                                        <div
                                                            class="event bg-purple-400 text-white rounded p-1 text-sm mb-1">
                                                            <span class="event-name pr-1">
                                                                {{ item.booking.name }}
                                                            </span>
                                                            <span class="time pl-1">
                                                                {{ item.time }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-else
                                                    class="flex flex-col h-40 mx-auto xl:w-40 lg:w-30 md:w-30 sm:w-full w-10 overflow-hidden bg-black">
                                                    <div class="top h-5 w-full">
                                                        <span class="text-gray-500">{{ calendarIndex }}</span>
                                                    </div>
                                                    <div class="bottom flex-grow h-30 py-1 w-full cursor-pointer"
                                                        @click="openDeleteModalBlockDay(ItemCalendar)"
                                                        v-if="!ItemCalendar.is_weekend">
                                                        <div class="event bg-red-400 text-white rounded p-1 text-sm mb-1">
                                                            <span class="event-name pr-1">
                                                                Blocked
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="bottom flex-grow h-30 py-1 w-full cursor-pointer" v-else>
                                                        <div
                                                            class="event bg-indigo-600 text-white rounded p-1 text-sm mb-1">
                                                            <span class="event-name pr-1">
                                                                Closed
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Add booking modal -->
        <Modal :is-open="isOpen" v-on:close-modal="closeModal" :showSubmit="false" title="Add Booking">
            <BookingForm :editMode="true" v-on:submit-data="closeModal" />
        </Modal>
        <!-- Delete modal booking -->
        <Modal :is-open="isOpenDeleteModal" v-on:close-modal="closeDeleteModal" v-on:submit-modal="deleteSubmit"
            title="Delete Booking">
            <p>Are you sure you want to delete this <strong>{{ bookingRef.booking.name }}</strong> booking?</p>
        </Modal>
        <!-- Delete modal blocked day -->
        <Modal :is-open="isOpenDeleteModalBlockDay" v-on:close-modal="closeDeleteModalBlock"
            v-on:submit-modal="deleteSubmitBlock" title="Delete Block Day">
            <p>Are you sure you want to delete this <strong>blocked</strong>?</p>
        </Modal>
    </Layout>
</template>

<script setup>
// import the layout file
import { ref, computed, watch, reactive } from 'vue'
import { usePage } from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3'
import Layout from "../../components/Layout/Main.vue";
import Modal from "../../components/Layout/Modal.vue";
import BookingForm from "../../components/Reusable/Booking.vue";

const isOpen = ref(false);

const closeModal = async () => {
    isOpen.value = false;
};

// Modal booking delete
const bookingRef = ref(null);
const isOpenDeleteModal = ref(false);

const closeDeleteModal = async () => {
    isOpenDeleteModal.value = false;
};
const openDeleteModal = async (booking) => {
    isOpenDeleteModal.value = true;
    bookingRef.value = booking;
};

const deleteSubmit = async () => {
    router.delete('/booking/' + bookingRef.value.booking.id);
    closeDeleteModal();
};

// Modal booking delete
const blockDayRef = ref(null);
const isOpenDeleteModalBlockDay = ref(false);

const openDeleteModalBlockDay = async (blockDay) => {
    blockDayRef.value = blockDay;
    isOpenDeleteModalBlockDay.value = true;
};

const closeDeleteModalBlock = async () => {
    isOpenDeleteModalBlockDay.value = false;
};

const deleteSubmitBlock = async () => {
    router.delete('/block/day/' + blockDayRef.value.blockedDay.id);
    closeDeleteModalBlock();
};

const form = reactive({
    current_date: usePage().props.selected_data,
    nextMonth: true
});

const changeMonth = async (forwardMonth) => {
    form.nextMonth = forwardMonth;
    await router.get('/manage', form);
};

</script>
