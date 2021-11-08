<template>
    <Head title="Hồ sơ" />

    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Danh sách hồ sơ khách hàng
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-3 grid justify-items-end">
                    <Link :href="route('customers.create')"
                        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                        Thêm hồ sơ
                    </Link>
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Tên
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Địa chỉ
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Số tiền vay
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Trạng thái
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="customer in customers.data" :key="customer.id">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ customer.info.name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ customer.info.place }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ customer.info.loan.amt }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ customer.is_disbursed ? 'Đã giải ngân' : (customer.is_appraised ? 'Đã thẩm định' : 'Chưa duyệt') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <Link :href="route('customers.edit', customer.id)" class="text-indigo-600 hover:text-indigo-900">
                                                    Xem hồ sơ
                                                </Link>
                                                <button @click="destroy(customer.id)" class="text-indigo-600 hover:text-indigo-900">Xóa</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination :model="customers" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue';
import destroy from '@/Mixins/destroy'

export default {
    components: {
        AppLayout,
        Head, Link,
        Pagination
    },
    props: ['customers'],
    mixins: [destroy],
    methods: {
        delete(id) {
            axios.delete(route('customers.destroy', id)).then((response) => {
                this.customers.data.splice(this.customers.data.findIndex(u => u.id == id), 1);
                this.$toast.success('Đã xóa hồ sơ.');
            })
        }
    }
}
</script>
