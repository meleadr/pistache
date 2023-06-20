<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, toRef, onMounted } from "vue";
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    id: {
        type: Number,
        default: null,
    },
});

const id = toRef(props, "id"); // Making id reactive

let form = ref({
    title: "",
    content: "",
    url_img: "",
    categories: [],
});

let categories = ref([]);

const loadMenuItem = async (id) => {
    const res = await axios.get(`/api/menusWithCategory/${id}`);
    form.value = res.data;
    form.value.categories = res.data.categories.map((category) => category.id); // extract the ids
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
    id.value != null ? "Modifier le menu" + id.value : "Ajouter un menu"
);

const handleCheckboxChange = (categoryId) => {
    const index = form.value.categories.indexOf(categoryId);

    if (index > -1) {
        // if the category is already in the array, remove it
        form.value.categories.splice(index, 1);
    } else {
        // if the category is not in the array, add it
        form.value.categories.push(categoryId);
    }
};

const onSubmit = async () => {
    if (id.value) {
        await axios.put(`/api/menus/${id.value}`, form.value);
    } else {
        await axios.post("/api/menus", form.value);
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

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900"></div>
                </div>
            </div>
            <form @submit.prevent="onSubmit" class="mx-auto max-w-xl space-y-3">
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
                        v-model="form.categories"
                        :checked="form.categories.includes(category.id)"
                        @change="handleCheckboxChange(category.id)"
                        class="mr-2"
                    />
                    <label :for="category.name" class="text-gray-700">
                        {{ category.name }}
                    </label>
                </div>

                <div class="flex justify-center">
                    <PrimaryButton type="submit" class="mx-auto">
                        {{ props.id != null ? "Modifier" : "Ajouter" }}
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
