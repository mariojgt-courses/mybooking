<template>
    <form class="bg-white" @submit.prevent="submit">
        <h1 class="text-gray-800 font-bold text-2xl mb-1">Booking Information!</h1>

        <div class="form-control w-full max-w-xs" v-if="!form.blockDay">
            <label class="label">
                <span class="label-text">Name</span>
            </label>
            <input type="text" required placeholder="Type here" class="input input-bordered w-full max-w-xs"
                v-model="form.name" dusk="name" />
            <p class="text-xs text-red-500" v-if="usePage().props?.errors?.name">{{ usePage().props.errors.name }}</p>
        </div>

        <div class="form-control w-full max-w-xs" v-if="!form.blockDay">
            <label class="label">
                <span class="label-text">Email</span>
            </label>
            <input type="email" required placeholder="Type here" class="input input-bordered w-full max-w-xs"
                v-model="form.email" dusk="email" />
            <p class="text-xs text-red-500" v-if="usePage().props?.errors?.email">{{ usePage().props.errors.email }}</p>
        </div>

        <div class="form-control w-full max-w-xs" v-if="!form.blockDay">
            <label class="label">
                <span class="label-text">Phone</span>
            </label>
            <input type="text" required placeholder="Type here" class="input input-bordered w-full max-w-xs"
                v-model="form.phone" dusk="phone" />
            <p class="text-xs text-red-500" v-if="usePage().props?.errors?.phone">{{ usePage().props.errors.phone }}</p>
        </div>

        <div class="form-control w-full max-w-xs" v-if="!form.blockDay">
            <label class="label">
                <span class="label-text">Vehicle plate</span>
            </label>
            <input type="text" required placeholder="Type here" class="input input-bordered w-full max-w-xs"
                v-model="form.plate" dusk="plate" />
            <p class="text-xs text-red-500" v-if="usePage().props?.errors?.plate">{{ usePage().props.errors.plate }}</p>
        </div>

        <div class="form-control w-full max-w-xs flex justify-center" v-if="editMode">
            <label class="label">
                <span class="label-text">Block Day</span>
            </label>
            <Switch v-model="form.blockDay" :class="form.blockDay ? 'bg-blue-600' : 'bg-gray-200'"
                class="relative inline-flex h-6 w-11 items-center rounded-full">
                <span class="sr-only">Enable notifications</span>
                <span :class="form.blockDay ? 'translate-x-6' : 'translate-x-1'"
                    class="inline-block h-4 w-4 transform rounded-full bg-white transition" />
            </Switch>
        </div>

        <div class="form-control w-full max-w-xs" v-if="form.blockDay">
            <label class="label">
                <span class="label-text">Select a date</span>
            </label>

            <input type="date" required class="input input-bordered w-full max-w-xs" v-model="date" dusk="date-block" />
        </div>

        <div class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300" v-if="!form.blockDay">
            <div class="flex flex-row justify-between items-center">
                <div>
                    <h1 class="text-3xl font-medium">Slots</h1>
                    <p class="text-xs text-red-500" v-if="usePage().props?.errors?.time">{{ usePage().props.errors.time }}
                    </p>
                </div>
            </div>
            <div v-if="form.time" class="pt-10">
                <a href="#" @click="form.time = null"
                    class="mx-auto flex w-[300px] items-center justify-between gap-x-3 rounded-lg border border-gray-700 bg-gray-700 px-4 py-2">
                    <p class="text-sm text-white">{{ form.time }} - {{ date }}</p>
                    <button class="inline-flex items-center space-x-2 rounded-full bg-gray-700 font-semibold text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </a>
            </div>
            <div v-else>
                <div class="form-control w-full max-w-xs">
                    <label class="label">
                        <span class="label-text">Select a date</span>
                    </label>

                    <input type="date" required class="input input-bordered w-full max-w-xs" v-model="date" dusk="date" />
                </div>
                <div v-if="usePage().props?.bookings?.blocked" class="pt-5" >
                    <h1>Day not available</h1>
                </div>
                <div v-else>
                    <div id="tasks"
                        class="overflow-auto h-72 relative max-w-sm mx-auto bg-white dark:bg-slate-800 dark:highlight-white/5 shadow-lg ring-1 ring-black/5 rounded-xl flex flex-col divide-y dark:divide-slate-200/5"
                        v-if="!isWeekend">
                        <div class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4  border-l-transparent bg-gradient-to-r from-transparent to-transparent hover:from-slate-100 transition ease-linear duration-150 cursor-pointer"
                            v-for="(item, index) in usePage().props.bookings" :key="index" @click="selectTime(item)" dusk="time">
                            <div class="inline-flex items-center space-x-2">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="w-6 h-6 text-slate-500 hover:text-indigo-600 hover:cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>

                                </div>
                                <div>{{ item }}</div>
                            </div>
                        </div>
                    </div>
                    <div id="tasks" class="my-5" v-else>
                        <h1>Sorry, we are closed on weekends!</h1>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" v-if="!isWeekend"
            dusk="submit"
            class="block w-full bg-indigo-600 mt-4 py-2 rounded-2xl text-white font-semibold mb-2">Confirm</button>
    </form>
</template>

<script setup>
// import the layout file
import { usePage } from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3';
import { ref, computed, watch, reactive } from 'vue'
import { Switch } from '@headlessui/vue'

// Define the props
const props = defineProps({
    editMode: {
        type: Boolean,
        default: false,
    }
});

// Get the today date and format it to dd-mm-yyyy
const date = ref(usePage().props?.selected_data);

// Create a computed property to check if the date is a sat or sun
const isWeekend = computed(() => {
    const day = new Date(date.value).getDay();
    return day === 0 || day === 6;
});

// Watch date changes
watch(date, (newDate) => {
    if (props.editMode) {
        router.get('/manage', { date: newDate }, { preserveState: true });
    } else {
        router.get('/bookings', { date: newDate }, { preserveState: true });
    }
});

const selectTime = async (time) => {
    form.time = time;
};

const form = reactive({
    name: null,
    email: null,
    phone: null,
    plate: null,
    time: null,
    date: null,
    blockDay: false,
});

const emit = defineEmits(['submitData'])

const submit = async (e) => {
    form.date = date.value;
    await router.post('/bookings', form);

    // Reset the form
    form.name = null;
    form.email = null;
    form.phone = null;
    form.plate = null;
    form.time = null;
    form.blockDay = false;

    emit('submitData');
};

</script>
