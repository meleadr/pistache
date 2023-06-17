<template>
    <div class="rounded border border-gray-200 p-6 shadow-sm" v-if="item">
        <h3 class="mb-2 text-xl">{{ item.title }}</h3>
        <p>{{ item.content }}</p>
        <div class="mt-2">
            <span
                v-for="(category, index) in item.categories"
                :key="index"
                class="mr-2 inline-block rounded-full bg-gray-200 px-3 py-1 text-sm font-semibold text-gray-700"
            >
                {{ category }}
            </span>
        </div>
        <!-- Edit and Delete buttons -->
        <div v-if="props.editable" class="mt-4">
            <button
                class="mr-2 rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
            >
                Edit
            </button>
            <button
                class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700"
            >
                Delete
            </button>
        </div>
    </div>
</template>

<script setup>
import { defineProps, ref, onMounted } from "vue";
import axios from "axios";

const props = defineProps({
    id: {
        type: Number,
        required: true,
    },
    editable: {
        type: Boolean,
        default: false,
    },
});

let item = ref(null);

onMounted(async () => {
    // const response = await axios.get(`/api/menus/${props.id}`);
    // item.value = response.data;
});
</script>
