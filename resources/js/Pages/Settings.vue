<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { data } from 'browserslist';
import { ref, watch } from "vue";
import {Inertia} from "@inertiajs/inertia";

</script>

<template>
    <Head title="Settings" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Settings</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 mt-2 p-4">
                  <p>This is your settings page</p>
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>