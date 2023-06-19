<script setup>
import { defineProps } from "vue";

const props = defineProps({
    id: {
        type: Number,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    content: {
        type: String,
        required: true,
    },
    categories: {
        type: Array,
        required: false,
    },
    editable: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <div class="rounded border border-gray-200 p-6 shadow-sm" v-if="props.id">
        <h3 class="mb-2 text-xl">{{ props.title }}</h3>
        <p>{{ props.content }}</p>
        <div class="mt-2">
            <span
                v-for="(category, index) in props.categories"
                :key="index"
                class="mr-2 inline-block rounded-full bg-gray-200 px-3 py-1 text-sm font-semibold text-gray-700"
            >
                {{ category.name }}
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
