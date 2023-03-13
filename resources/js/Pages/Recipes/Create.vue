<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { data } from 'browserslist';
import { ref, watch, reactive } from "vue";
import {Inertia} from "@inertiajs/inertia";

var toolbarOptions = [
  ['bold', 'italic', 'underline'],        // toggled buttons

  [{ 'header': 1 }, { 'header': 2 }],               // custom button values
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],                         // text direction

  [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  [{ 'align': [] }],

  ['clean']                                         // remove formatting button
];

const options = {
    debug: 'warn',
    modules: {
    toolbar: toolbarOptions
  },
  theme: 'snow'
};

let props = defineProps({
    auth: Object
});

let form = reactive({
  recipe_name: '',
  recipe_servings: 0,
  prep_time: 0, 
  cook_time: 0,
  recipe_type: 'breakfast',
  other_information: '',
  description: '',
  method: '', 
  user: props.auth.user.id
});

let submit = () => {
  Inertia.post('/api/recipes', form);
}

</script>

<template>
    <Head title="Create Recipe" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Recipe</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 mt-2 p-4">
                  <form @submit.prevent="submit">

                    <div class="mb-6">
                      <label for="recipe_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Recipe Name</label>
                      <input v-model="form.recipe_name" type="text" id="recipe_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Recipe Name..." required>
                    </div>

                    <div class="flex flex-col lg:flex-row md:flex-col sm:flex-col justify-between w-full mb-6">

                      <div class="servings w-full p-2">
                        <label for="recipe_servings" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Servings</label>
                        <div class="flex">
                          <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            <i class="fa-solid fa-hashtag"></i>
                          </span>
                          <input v-model="form.recipe_servings" type="number" id="recipe_servings" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Servings...">
                        </div>
                      </div>
                      
                      <div class="prep-time w-full p-2">
                        <label for="prep_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prep Time (min)</label>
                        <div class="flex">
                          <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            <i class="fa-solid fa-carrot"></i>
                          </span>
                          <input v-model="form.prep_time" type="number" id="prep_time" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Prep Time...">
                        </div>
                      </div>

                      <div class="cook-time w-full p-2">
                        <label for="cook_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cook Time (min)</label>
                        <div class="flex">
                          <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            <i class="fa-solid fa-fire-burner"></i>
                          </span>
                          <input v-model="form.cook_time" type="number" id="cook_time" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cook Time...">
                        </div>
                      </div>


                    </div>

                    <div class="recipe_type mb-6">
                      <p class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Meal Type</p>
                      <fieldset class="flex">
                        <legend class="sr-only">Meal Type</legend>

                        <div class="flex items-center mb-4 mr-4">
                          <input v-model="form.recipe_type" id="breakfast" type="radio" name="meal-type" value="breakfast" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                          <label for="breakfast" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Breakfast
                          </label>
                        </div>

                        <div class="flex items-center mb-4 mr-4">
                          <input v-model="form.recipe_type" id="lunch" type="radio" name="meal-type" value="lunch" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                          <label for="lunch" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Lunch
                          </label>
                        </div>

                        <div class="flex items-center mb-4 mr-4">
                          <input v-model="form.recipe_type" id="dinner" type="radio" name="meal-type" value="dinner" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                          <label for="dinner" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Dinner
                          </label>
                        </div>

                        <div class="flex items-center mb-4 mr-4">
                          <input v-model="form.recipe_type" id="snack" type="radio" name="meal-type" value="snack" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring:blue-300 dark:focus-ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                          <label for="snack" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Snack
                          </label>
                        </div>

                        <div class="flex items-center mb-4 mr-4">
                          <input v-model="form.recipe_type" id="sweet" type="radio" name="meal-type" value="sweet" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring:blue-300 dark:focus-ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                          <label for="sweet" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Sweet
                          </label>
                        </div>
                      </fieldset>
                    </div>

                    <div class="mb-6">
                      <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                      <textarea v-model="form.description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write a Description..."></textarea>
                    </div>

                    <div class="mb-6">
                      <label for="method" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Method</label>
                      <quill-editor v-model:content="form.method" contentType="html" id="method" theme="snow" :options="options" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-b-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></quill-editor>
                    </div>



                    <div class="mb-6">
                      <label for="other_information" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Other Information</label>
                      <textarea v-model="form.other_information" id="other_information" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Any Notes..."></textarea>
                    </div>

                    <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Submit</button>
                  
                </form>
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>