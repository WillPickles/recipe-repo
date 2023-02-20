<template>
    <ul class="inline-flex -space-x-px">
                    <li>
                        <Component 
                        :is="link.url ? 'Link' : 'span'"
                        v-for="link in links" 
                        :href="link.url" 
                        v-html="link.label"
                        class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        :class="[
                            link.url ? '' : 'disabled',
                            link.label.includes('Previous') ? 'rounded-l-lg' : '',
                            link.label.includes('Next') ? 'rounded-r-lg' : '',
                            link.active ? 'text-blue-700' : ''
                        ]"
                        
                        />

                    </li>
                    
                </ul>
</template>

<script>
export default {
  props: {
    links: Array
  }
}

</script>