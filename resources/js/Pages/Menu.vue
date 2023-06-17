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
    <Head title="Menus" />

    <WebsiteLayout class="mb-10 ml-10 mr-10">
        <template #header>
            <h2 class="mb-10 text-center text-4xl">Menus</h2>
        </template>
        <!-- Menu Section -->
        <section class="menu py-20">
            <!-- Category Filter -->
            <div class="mb-10 flex flex-wrap justify-center space-x-2">
                <button
                    v-for="category in categories"
                    :key="category"
                    @click="selectCategory(category)"
                    class="rounded bg-amber-500 px-4 py-2 font-bold text-white hover:bg-amber-700"
                    :class="{ 'bg-amber-700': selectedCategory === category }"
                >
                    {{ category }}
                </button>
            </div>

            <!-- Menu Items -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="item in menuItems"
                    :key="item.id"
                    v-show="
                        selectedCategory === 'Tous' ||
                        item.categories.includes(selectedCategory)
                    "
                >
                    <MenuItems :id="item.id" :editable="true" />
                </div>
            </div>
        </section>
    </WebsiteLayout>
</template>

<style scoped></style>
