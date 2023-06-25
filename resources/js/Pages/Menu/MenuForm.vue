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
let displayCategories = ref(form.value.categories);
let imageFile = ref(null);

const loadMenuItem = async (id) => {
    if (id == 0) return;
    const res = await axios.get(`/api/menusWithCategory/${id}`);
    const menuData = res.data;
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
        form.value.categories.splice(index, 1);
    } else {
        const categoryToAdd = categories.value.find(
            (category) => category.id === categoryId
        );
        if (categoryToAdd) {
            form.value.categories.push(categoryToAdd);
        }
    }
};

const handleImageChange = (e) => {
    imageFile.value = e.target.files[0];
    const reader = new FileReader();
    reader.onload = function (e) {
        form.value.url_img = e.target.result;
    };
    reader.readAsDataURL(imageFile.value);
};

const onSubmit = async () => {
    const formData = new FormData();
    formData.append("title", form.value.title);
    formData.append("content", form.value.content);

    // Append each category separately
    form.value.categories.forEach((category, index) => {
        formData.append(`categories[${index}]`, category.id);
    });

    let response;
    formData.append("url_img", imageFile.value);
    if (id.value) {
        response = await axios.put(`/api/menus/${id.value}`, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
    } else {
        response = await axios.post("/api/menus", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
    }
    console.log(response.data);
    window.location = route("menu.index");
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

        <section class="flex flex-col py-12 lg:flex-row">
            <article class="px-4 sm:mb-10 lg:w-1/2">
                <form
                    @submit.prevent="onSubmit"
                    class="mx-auto max-w-xl space-y-6"
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
                    <input
                        type="file"
                        name="url_img"
                        id="url_img"
                        accept="image/png, image/jpeg"
                        @change="handleImageChange"
                    />
                    <div class="flex justify-center">
                        <PrimaryButton type="button" class="mx-auto">
                            <Link :href="route('menu.index')">Annuler</Link>
                        </PrimaryButton>
                        <PrimaryButton type="submit" class="mx-auto">
                            {{ props.id != null ? "Modifier" : "Ajouter" }}
                        </PrimaryButton>
                    </div>
                </form>
            </article>
            <section class="px-4 lg:w-1/2">
                <MenuItem
                    :id="form.id"
                    :title="form.title"
                    :content="form.content"
                    :url_img="form.url_img"
                    :categories="displayCategories"
                />
            </section>
        </section>
    </AuthenticatedLayout>
</template>
