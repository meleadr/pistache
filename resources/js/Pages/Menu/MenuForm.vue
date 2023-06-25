<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref, toRef, onMounted } from "vue";
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import MenuItem from "@/Components/MenuItem.vue";

const props = defineProps({
    id: {
        type: Number,
        default: null,
    },
});

const id = toRef(props, "id"); // Making id reactive

let form = ref({
    id: 0,
    title: "",
    content: "",
    url_img: "/img/menu/default.png",
    categories: [],
});

let categories = ref([]);
let displayCategories = ref([]);

const loadMenuItem = async (id) => {
    if (id == 0) return;
    const res = await axios.get(`/api/menusWithCategory/${id}`);
    const menuData = res.data;
    // Transform categories into an array of objects with id and name properties
    menuData.categories = menuData.categories.map((cat) => ({
        id: cat.id,
        name: cat.name,
    }));
    displayCategories.value = menuData.categories;
    form.value = menuData;
};

const loadCategories = async () => {
    const res = await axios.get("/api/categories");
    categories.value = res.data;
};

onMounted(async () => {
    if (id.value) {
        await loadCategories();
        await loadMenuItem(id.value);
    } else {
        await loadCategories();
    }
});

let title = ref(
    id.value != null ? "Modifier le menu " + id.value : "Ajouter un menu"
);

const handleCheckboxChange = (categoryId) => {
    const index = form.value.categories.findIndex(
        (category) => category.id === categoryId
    );

    if (index > -1) {
        // if the category is already in the array, remove it
        form.value.categories.splice(index, 1);
    } else {
        // if the category is not in the array, add it
        const categoryToAdd = categories.value.find(
            (category) => category.id === categoryId
        );
        if (categoryToAdd) {
            form.value.categories.push(categoryToAdd);
        }
    }
};

const onSubmit = async () => {
    if (id.value) {
        await axios.put(`/api/menus/${id.value}`, form.value).then(() => {
            // Redirect to the index page
            window.location = route("menu.index");
        });
    } else {
        await axios.post("/api/menus", form.value).then(() => {
            // Redirect to the index page
            window.location = route("menu.index");
        });
    }
};
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ props.id != null ? "Modifier un menu" : "Ajouter un menu" }}
            </h2>
        </template>

        <div class="flex flex-col py-12 lg:flex-row">
            <div class="px-4 sm:mb-10 lg:w-1/2">
                <form
                    @submit.prevent="onSubmit"
                    class="mx-auto max-w-xl space-y-4"
                >
                    <input
                        v-model="form.title"
                        type="text"
                        placeholder="Titre"
                        class="mb-4 mt-4 w-full rounded-lg border px-3 py-2 text-gray-700 focus:outline-none"
                    />
                    <textarea
                        v-model="form.content"
                        placeholder="Contenu"
                        class="mb-2 w-full rounded-lg border px-3 py-2 text-gray-700 focus:outline-none"
                    ></textarea>
                    <div
                        v-for="category in categories"
                        :key="category.id"
                        class="mb-2 flex items-center"
                    >
                        <input
                            type="checkbox"
                            :id="category.name"
                            :value="category.id"
                            :checked="
                                form.categories.some(
                                    (c) => c.id === category.id
                                )
                            "
                            @change="handleCheckboxChange(category.id)"
                            class="mr-2"
                        />
                        <label :for="category.name" class="text-gray-700">
                            {{ category.name }}
                        </label>
                    </div>

                    <div class="flex justify-center">
                        <PrimaryButton type="button" class="mx-auto">
                            <Link :href="route('menu.index')">Annuler</Link>
                        </PrimaryButton>
                        <PrimaryButton type="submit" class="mx-auto">
                            {{ props.id != null ? "Modifier" : "Ajouter" }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
            <div class="px-4 lg:w-1/2">
                <MenuItem
                    :id="form.id"
                    :title="form.title"
                    :content="form.content"
                    :url_img="form.url_img"
                    :categories="displayCategories"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
