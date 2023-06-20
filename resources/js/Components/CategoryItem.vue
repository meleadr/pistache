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
    <div class="overflow-hidden rounded-lg bg-white shadow-md" v-if="props.id">
        <!-- Category name -->
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-semibold leading-tight text-gray-900">
                {{ props.name }}
            </h3>
        </div>
        <!-- Edit and Delete buttons -->
        <div class="mt-4 flex justify-around py-4">
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
