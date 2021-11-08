<template>
    <div v-if="model.data.length > 0" class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div v-if="model.data.length > 0" class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing <span class="font-medium">{{ model.from }}</span> to <span class="font-medium">{{ model.to }}</span> of <span class="font-medium">{{ model.total }}</span> results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <Link v-for="(page, k) in model.links" :key="k" :href="page.url"
                        :class="classes(page, k)"
                    >
                        <span v-html="page.label"></span>
                    </Link>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'

    export default {
        components: {
            Link,
        },
        props: {
            model: Object
        },
        methods: {
            classes(page, k) {
                return [
                    'hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium',
                    k == 0 ? 'rounded-l-md' : (k == this.model.links.length-1 ? 'rounded-r-md' : ''),
                    page.active ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600 disabled:opacity-50 pointer-events-none' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                ];
            }
        }
    }
</script>
