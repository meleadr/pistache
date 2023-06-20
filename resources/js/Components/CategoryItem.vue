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
    name: {
        type: String,
        required: true,
    },
    date: {
        type: String,
        required: true,
    },
});

let showingModal = ref(false);
let modalAction = ref(null);

const performAction = () => {
    if (modalAction.value === "delete") {
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
    <div
        class="overflow-hidden rounded-lg bg-white p-5 shadow-md"
        v-if="props.id"
    >
        <!-- Category name -->
        <div>
            <h3 class="text-xl font-semibold leading-tight text-gray-900">
                {{ props.name }}
            </h3>
        </div>
        <!-- Category date -->
        <div class="mt-2">
            <span class="font-base text-md leading-tight text-gray-500">
                {{ props.date }}
            </span>
        </div>
        <!-- Edit and Delete buttons -->
        <div class="mt-2 flex justify-around py-2">
            <Link :href="route('menu.edit', props.id)">
                <button
                    class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
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
    <!-- Modal Component -->
    <Modal :show="showingModal" @close="showingModal = false">
        <div class="w-full rounded-lg bg-white p-8 shadow-lg">
            <h3 class="mb-4 text-lg font-semibold">Confirmation</h3>
            <div class="mb-6">
                <p class="text-gray-700">
                    Êtes-vous sûr de vouloir supprimer cette categorie ?
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
