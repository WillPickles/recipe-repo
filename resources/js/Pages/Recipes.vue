<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { data } from 'browserslist';
import { ref, watch, computed, defineProps } from "vue";
import { Inertia } from "@inertiajs/inertia";
import Pagination from "../Components/Pagination.vue";

let props = defineProps({
    recipes: Object,
    filters: Object
});

let search = ref(props.filters.search);

watch(search, value => {
    console.log(value);
    /*Inertia.get('/recipes', { search: value }, {
        preserveState: true
    });
    */
   router.get('/recipes', { search: value }, {
        preserveState: true,
        replace: true 
    });
});

</script>

<template>
    <Head title="Recipes" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col lg:flex-row md:flex-col sm:flex-col justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full lg:pt-2">Recipes</h2>
                <div class="w-full"></div>
                <div class="w-full">
                    <input v-model="search" autocomplete="off" type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
                </div>
            </div>
            
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div v-for="recipe in recipes.data" :key="recipe.id" class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2 p-4">
                    <h3 class="text-3xl">{{ recipe.recipe_name }}</h3>
                </div>

                <!-- Pagination -->
                <div class="mt-6">

                    <Pagination :links="recipes.links" />

                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
