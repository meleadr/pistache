<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref, toRef, onMounted } from "vue";
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CategoryItem from "@/Components/CategoryItem.vue";

const props = defineProps({
    id: {
        type: Number,
        default: null,
    },
});

const id = toRef(props, "id"); // Making id reactive

let form = ref({
    id: 0,
    name: "Nouvelle catégorie",
    date: new Date().toLocaleDateString("fr-FR", {
        year: "numeric",
        month: "long",
        day: "numeric",
    }),
});

const loadCategoryItem = async (id) => {
    if (id == 0) return;
    const res = await axios.get(`/api/categories/${id}`);
    const categoryData = res.data;
    // transform created_at date to french format and save it in form.date
    categoryData.date = new Date(categoryData.created_at).toLocaleDateString(
        "fr-FR",
        {
            year: "numeric",
            month: "long",
            day: "numeric",
        }
    );
    form.value = categoryData;
};

onMounted(async () => {
    if (id.value) {
        await loadCategoryItem(id.value);
    }
});

let title = ref(
    id.value != null ? "Modifier le menu " + id.value : "Ajouter un menu"
);

const onSubmit = async () => {
    if (id.value) {
        await axios.put(`/api/categories/${id.value}`, form.value);
    } else {
        await axios.post("/api/categories", form.value);
    }
};
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{
                    props.id != null
                        ? "Modifier une catégorie "
                        : "Ajouter une catégorie"
                }}
            </h2>
        </template>

        <div class="flex flex-col py-12 lg:flex-row">
            <div class="px-4 sm:mb-10 lg:w-1/2">
                <form
                    @submit.prevent="onSubmit"
                    class="mx-auto max-w-xl space-y-4"
                >
                    <input
                        v-model="form.name"
                        type="text"
                        placeholder="Nom de la catégorie"
                        class="mb-4 mt-4 w-full rounded-lg border px-3 py-2 text-gray-700 focus:outline-none"
                    />

                    <div class="flex justify-center">
                        <PrimaryButton type="button" class="mx-auto">
                            <Link :href="route('categorie.index')"
                                >Annuler</Link
                            >
                        </PrimaryButton>
                        <PrimaryButton type="submit" class="mx-auto">
                            {{ props.id != null ? "Modifier" : "Ajouter" }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
            <div class="px-4 lg:w-1/2">
                <CategoryItem
                    :id="form.id"
                    :name="form.name"
                    :date="form.date"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
