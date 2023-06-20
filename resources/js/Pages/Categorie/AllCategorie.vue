<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import axios from "axios";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import CategoryItem from "@/Components/CategoryItem.vue";

// Category items
const categoryItem = ref([]);

// Fetch categories from API
const fetchCategory = async () => {
    const response = await axios.get("/api/categories");
    categoryItem.value = response.data;
    categoryItem.value.forEach((item) => {
        item.created_at = new Date(item.created_at).toLocaleDateString(
            "fr-FR",
            {
                year: "numeric",
                month: "long",
                day: "numeric",
            }
        );
    });
    categoryItem.value.forEach((item) => {
        item.published = item.published == 1 ? true : false;
    });
};

// Fetch category items
onMounted(() => {
    fetchCategory();
});
</script>

<template>
    <Head title="Menus" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Toutes les catégories
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div
                            class="flex flex-col justify-between space-y-4 sm:flex-row sm:space-y-0"
                        >
                            <div class="w-full sm:w-6/12">
                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    placeholder="Rechercher une catégorie"
                                    class="w-full rounded-md border border-gray-300 px-4 py-2 focus:border-purple-500 focus:ring-purple-500"
                                />
                            </div>
                            <SecondaryButton>
                                <Link :href="route('categorie.add')">
                                    Ajouter une catégorie
                                </Link>
                            </SecondaryButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 p-6">
                        <div
                            class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3"
                        >
                            <CategoryItem
                                v-for="item in categoryItem"
                                :key="item.id"
                                :id="item.id"
                                :name="item.name"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
