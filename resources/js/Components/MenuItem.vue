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
let modalAction = ref(null);
let published = ref(props.published);

const performAction = () => {
    if (modalAction.value === "archive") {
        axios.put(`/api/menus/${props.id}`, { published: 0 }).then(() => {
            published.value = false;
        });
    } else if (modalAction.value === "publish") {
        axios.put(`/api/menus/${props.id}`, { published: 1 }).then(() => {
            published.value = true;
        });
    } else if (modalAction.value === "delete") {
        axios.delete(`/api/menus/${props.id}`).then(() => {
            window.location.reload();
        });
    }
    showingModal.value = false;
};

const openModal = (action) => {
    modalAction.value = action;
    showingModal.value = true;
};
</script>

<template>
    <div class="overflow-hidden rounded-lg bg-white shadow-md" v-if="props.id">
        <img
            :src="props.url_img"
            alt="Menu Image"
            class="h-64 w-full object-cover"
        />
        <div class="p-6">
            <h3 class="mb-2 text-xl font-semibold">{{ props.title }}</h3>
            <p v-show="!props.editable" class="text-gray-600">
                {{ props.content }}
            </p>
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
            <div v-show="props.editable" class="mt-4 flex justify-between">
                <div>
                    <button
                        v-if="published"
                        class="mr-2 rounded bg-yellow-500 px-4 py-2 font-bold text-white hover:bg-yellow-700"
                        @click="openModal('archive')"
                    >
                        Archiver
                    </button>
                    <button
                        v-else
                        class="mr-2 rounded bg-green-500 px-4 py-2 font-bold text-white hover:bg-green-700"
                        @click="openModal('publish')"
                    >
                        Publier
                    </button>
                </div>
                <div>
                    <Link :href="route('menu.edit', props.id)">
                        <button
                            class="mr-2 rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                        >
                            Edit
                        </button>
                    </Link>
                    <button
                        class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700"
                        @click="openModal('delete')"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Component -->
    <Modal :show="showingModal" @close="showingModal = false">
        <div class="w-full rounded-lg bg-white p-8 shadow-lg">
            <h3 class="mb-4 text-lg font-semibold">Confirmation</h3>
            <div class="mb-6">
                <p class="text-gray-700">
                    Êtes-vous sûr de vouloir
                    {{
                        modalAction === "archive"
                            ? "archiver"
                            : modalAction === "publish"
                            ? "publier"
                            : "supprimer"
                    }}
                    ce menu ?
                </p>
            </div>
            <div class="text-right">
                <button
                    class="rounded bg-blue-500 px-4 py-2 font-bold text-white transition duration-200 ease-in-out hover:bg-blue-700"
                    @click="performAction"
                >
                    Confirmer
                </button>
            </div>
        </div>
    </Modal>
</template>
