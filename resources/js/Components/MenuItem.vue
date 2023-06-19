<script setup>
import { ref } from "vue";
import axios from "axios";
import { Link } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    id: {
        type: Number,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    content: {
        type: String,
        required: false,
    },
    url_img: {
        type: String,
        required: false,
    },
    published: {
        type: Boolean,
        required: false,
    },
    categories: {
        type: Array,
        required: false,
    },
    date: {
        type: String,
        required: false,
    },
    editable: {
        type: Boolean,
        default: false,
    },
});

let showingModal = ref(false);

let published = ref(props.published);

// on click on archive button
const archive = () => {
    axios.put(`/api/menus/${props.id}`, {
        published: 0,
    });
    published.value = false;
};

// on click on publish button
const publish = () => {
    axios.put(`/api/menus/${props.id}`, {
        published: 1,
    });
    published.value = true;
};

// on click on delete button
const supp = () => {
    axios.delete(`/api/menus/${props.id}`).then(() => {
        location.reload();
    });
};
</script>

<template>
    <div class="rounded border border-gray-200 p-6 shadow-sm" v-if="props.id">
        <h3 class="mb-2 text-xl">{{ props.title }}</h3>
        <p v-show="!props.editable">{{ props.content }}</p>
        <div v-show="!props.editable" class="mt-2">
            <span
                v-for="(category, index) in props.categories"
                :key="index"
                class="mr-2 inline-block rounded-full bg-gray-200 px-3 py-1 text-sm font-semibold text-gray-700"
            >
                {{ category.name }}
            </span>
        </div>
        <!-- Date de création-->
        <p v-show="props.editable" class="text-md mt-2 text-gray-500">
            {{ props.date }}
        </p>
        <!-- Edit and Delete buttons -->
        <div v-show="props.editable" class="mt-4">
            <button
                v-if="published"
                class="mr-2 rounded bg-yellow-500 px-4 py-2 font-bold text-white hover:bg-yellow-700"
                @click="archive"
            >
                Archiver
            </button>
            <button
                v-else
                class="mr-2 rounded bg-green-500 px-4 py-2 font-bold text-white hover:bg-green-700"
                @click="publish"
            >
                Publier
            </button>
            <Link :href="route('menu.edit', props.id)">
                <button
                    class="mr-2 rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                >
                    Edit
                </button>
            </Link>
            <button
                class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700"
                @click="showingModal = true"
            >
                Delete
            </button>
        </div>
    </div>
    <Modal :show="showingModal" @close="showingModal = false">
        <div class="w-full rounded-lg bg-white p-8 shadow-lg">
            <h3 class="mb-4 text-lg font-semibold">Supprimer le menu</h3>
            <div class="mb-6">
                <p class="text-gray-700">
                    Êtes-vous sûr de vouloir supprimer ce menu ?
                </p>
            </div>
            <div class="text-right">
                <button
                    class="rounded bg-red-500 px-4 py-2 font-bold text-white transition duration-200 ease-in-out hover:bg-red-700"
                    @click="supp"
                >
                    Supprimer
                </button>
            </div>
        </div>
    </Modal>
</template>
