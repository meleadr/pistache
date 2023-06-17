<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, watchEffect, toRef } from "vue";
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
    categories: [],
});

let categories = ref([
    "Salades",
    "Plats principaux",
    "Végétarien",
    "Fruits de mer",
]);

const loadMenuItem = async (id) => {
    const res = await axios.get(`/api/menus/${id}`);
    form.value = res.data;
};

watchEffect(() => {
    if (id.value) {
        loadMenuItem(id.value);
    }
});

let title = ref(
    id.value != null ? "Modifier le menu" + id.value : "Ajouter un menu"
);

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
                    :key="category"
                    class="mb-2 flex items-center"
                >
                    <input
                        type="checkbox"
                        :id="category"
                        :value="category"
                        v-model="form.categories"
                        class="mr-2"
                    />
                    <label :for="category" class="text-gray-700">{{
                        category
                    }}</label>
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
