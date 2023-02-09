<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { data } from 'browserslist';
import { ref, watch } from "vue";
import {Inertia} from "@inertiajs/inertia";


defineProps({recipes: Array});

let search = ref('');

watch(search, value => {
    Inertia.get('/api/recipes', { search: value }, {
        preserveState: true
    });
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 mt-2 p-4">
                    <div class="">
                        <input v-model="search" autocomplete="off" type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2 p-4">
                    <h3 class="text-3xl">Total Recipes: {{ recipes.length }}</h3>
                </div>
                <div v-for="recipe in recipes" :key="recipe.id" class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2 p-4">
                    <h3 class="text-3xl">{{ recipe.recipe_name }}</h3>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
