<script setup>
import { ref, onMounted, computed } from "vue";
import { Head } from "@inertiajs/vue3";
import WebsiteLayout from "@/Layouts/WebsiteLayout.vue";
import MenuItem from "@/Components/MenuItem.vue";

// Menu items
const menuItems = ref([]);

// Categories (used for filtering)
const categories = ref([]);

// MenuHasCategories (used for filtering)
const menuHasCategories = ref([]);

// Currently selected category for filtering
const selectedCategory = ref(0);

// Function to handle category selection for filtering
const selectCategory = (category) => {
    selectedCategory.value = category;
};

// Function to check if a menu item is in the selected category
const isInSelectedCategory = (menuItem) => {
    if (selectedCategory.value === 0) {
        // If no category is selected, return true for all menu items
        return true;
    }
    return menuHasCategories.value.some(
        (menuHasCategory) =>
            menuHasCategory.menu_id === menuItem.id &&
            menuHasCategory.category_id === selectedCategory.value
    );
};

// Function to get categories of a menu item
const getCategoriesOfMenuItem = (menuItem) => {
    return menuHasCategories.value
        .filter((menuHasCategory) => menuHasCategory.menu_id === menuItem.id)
        .map((menuHasCategory) => {
            return categories.value.find(
                (category) => category.id === menuHasCategory.category_id
            );
        });
};

// Computed property for filtered menu items
const filteredMenuItems = computed(() => {
    return menuItems.value
        .map((menuItem) => ({
            ...menuItem,
            categories: getCategoriesOfMenuItem(menuItem),
        }))
        .filter(isInSelectedCategory);
});

// Fetch menu items from API
const fetchMenu = async () => {
    const response = await axios.get("/api/menusPublished");
    menuItems.value = response.data;
};

// Fetch categories from API
const fetchCategories = async () => {
    const response = await axios.get("/api/categories");
    categories.value = [...response.data];
};

// Fetch menuHascategories from API
const fetchMenuHasCategory = async () => {
    const response = await axios.get("/api/menuHasCategory");
    menuHasCategories.value = [...response.data];
};

// Fetch menu items and categories on component mount
onMounted(() => {
    fetchMenu();
    fetchCategories();
    fetchMenuHasCategory();
});
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
                <!-- All Categories Button -->
                <button
                    @click="selectCategory(0)"
                    class="rounded bg-amber-500 px-4 py-2 font-bold text-white hover:bg-amber-700"
                    :class="{
                        'bg-amber-700': selectedCategory === 0,
                    }"
                >
                    Tous
                </button>
                <!-- Individual Category Buttons -->
                <button
                    v-for="category in categories"
                    :key="category.id"
                    @click="selectCategory(category.id)"
                    class="rounded bg-amber-500 px-4 py-2 font-bold text-white hover:bg-amber-700"
                    :class="{
                        'bg-amber-700': selectedCategory === category.id,
                    }"
                >
                    {{ category.name }}
                </button>
            </div>

            <!-- Menu Items -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div v-for="item in filteredMenuItems" :key="item.id">
                    <MenuItem
                        :id="item.id"
                        :title="item.title"
                        :content="item.content"
                        :categories="item.categories"
                        :url_img="item.url_img"
                        :published="item.published"
                        :date="item.created_at"
                        :editable="true"
                    />
                </div>
            </div>
        </section>
    </WebsiteLayout>
</template>
