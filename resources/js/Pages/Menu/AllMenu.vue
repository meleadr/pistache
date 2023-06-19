<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import MenuItem from "@/Components/MenuItem.vue";

// Menu items
const menuItems = ref([]);

// Fetch menu items from API
const fetchMenu = async () => {
    const response = await axios.get("/api/menus");
    menuItems.value = response.data;
    menuItems.value.forEach((item) => {
        item.created_at = new Date(item.created_at).toLocaleDateString(
            "fr-FR",
            {
                year: "numeric",
                month: "long",
                day: "numeric",
            }
        );
    });
    menuItems.value.forEach((item) => {
        item.published = item.published == 1 ? true : false;
    });
};

// Fetch menu items and categories on component mount
onMounted(() => {
    fetchMenu();
});
</script>

<template>
    <Head title="Menus" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Tous les menus
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900"></div>
                </div>
            </div>
        </div>

        <!-- Menu Items -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div v-for="item in menuItems" :key="item.id">
                <MenuItem
                    :id="item.id"
                    :title="item.title"
                    :published="item.published"
                    :date="item.created_at"
                    :editable="true"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
