<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import WebsiteLayout from "@/Layouts/WebsiteLayout.vue";

// Menu data (replace with API call when ready)
const menuItems = ref([
    {
        id: 1,
        title: "Salade Niçoise",
        content: "Salade, tomates, olives, œuf...",
        categories: ["Salades", "Végétarien"],
    },
    {
        id: 2,
        title: "Coq au Vin",
        content: "Poulet, vin rouge, champignons...",
        categories: ["Plats principaux"],
    },
    {
        id: 3,
        title: "Moules Marinières",
        content: "Moules, ail, vin blanc...",
        categories: ["Fruits de mer"],
    },
    // Add more items as needed
]);

// Categories (used for filtering)
const categories = ref([
    "Tous",
    "Salades",
    "Plats principaux",
    "Végétarien",
    "Fruits de mer",
]);

// Currently selected category for filtering
const selectedCategory = ref("Tous");

// Function to handle category selection for filtering
const selectCategory = (category) => {
    selectedCategory.value = category;
};
</script>

<template>
    <Head title="Menu" />

    <WebsiteLayout class="mr-10 ml-10 mb-10">
        <template #header>
            <h2 class="text-4xl text-center mb-10">Menu</h2>
        </template>
        <!-- Menu Section -->
        <section class="menu py-20">
            <!-- Category Filter -->
            <div class="flex flex-wrap justify-center space-x-2 mb-10">
                <button
                    v-for="category in categories"
                    :key="category"
                    @click="selectCategory(category)"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    :class="{ 'bg-blue-700': selectedCategory === category }"
                >
                    {{ category }}
                </button>
            </div>

            <!-- Menu Items -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="item in menuItems"
                    :key="item.id"
                    v-show="
                        selectedCategory === 'Tous' ||
                        item.categories.includes(selectedCategory)
                    "
                >
                    <div class="p-6 border border-gray-200 rounded shadow-sm">
                        <h3 class="text-xl mb-2">{{ item.title }}</h3>
                        <p>{{ item.content }}</p>
                        <div class="mt-2">
                            <span
                                v-for="(category, index) in item.categories"
                                :key="index"
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2"
                            >
                                {{ category }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </WebsiteLayout>
</template>

<style scoped></style>
