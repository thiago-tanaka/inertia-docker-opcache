<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    products: {
        type: Array,
    },
});

const form = useForm({
    name: '',
});

const deleteForm = useForm({});

const deleteProduct = (productId) => {
    deleteForm.delete(route('products.destroy', productId));
};

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 pt-0">
                    <form @submit.prevent="form.post(route('products.store'), {preserveState: false})"
                          class="border-b border-gray-600 mb-6 mt-6 space-y-6 pb-6 md:w-1/3 ">
                        <p class="text-gray-500 dark:text-gray-400">Add new product</p>
                        <div>
                            <InputLabel for="name" value="Product Name"/>

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.name"/>
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">
                                    Saved.</p>
                            </Transition>
                        </div>
                    </form>

                    <div class="rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">Product Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in products" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="py-4 px-6">{{ product.name }}</td>
                                <td>
                                    <button @click="deleteProduct(product.id)"
                                            class="px-4 py-2 bg-red-500 text-white text-xs font-semibold rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
