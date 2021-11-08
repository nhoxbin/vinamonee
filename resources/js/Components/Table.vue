<template>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th v-for="(header, k) in headers" :key="k" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ header }}
                </th>
                <th v-if="hasActions" scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <slot></slot>
            <tr v-if="model.data.length === 0">
                <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center">No data</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        model: {
            type: Object,
            required: true
        },
        headers: {
            type: Array,
            required: true
        },
        hasActions: {
            type: Boolean,
            default: true
        },
    },
}
</script>
