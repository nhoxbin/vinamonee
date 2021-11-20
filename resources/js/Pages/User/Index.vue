<template>
    <Head title="Thành viên" />

    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Thành viên
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <Table :headers="['Tên', 'Biệt danh', 'Trạng thái', 'Chức vụ', 'Số hồ sơ']" :model="users">
                                    <tr v-for="user in users.data" :key="user.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ user.name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ user.username }}</div>
                                            <div class="text-sm text-gray-500">{{ user.email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ user.roles[0].name == 'member' ? 'Chưa kích hoạt' : 'Đã kích hoạt' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ user.roles[0].name.toUpperCase() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ user.customers || user.customers_appraised_count || 0 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button @click.prevent="modifyRole(user, 'saler')" class="text-indigo-600 hover:text-indigo-900 mr-2">Saler</button>
                                            <button @click.prevent="modifyRole(user, 'appraiser')" class="text-indigo-600 hover:text-indigo-900 mr-2">Thẩm định</button>
                                            <button @click.prevent="modifyRole(user, 'disburser')" class="text-indigo-600 hover:text-indigo-900 mr-2">Giải ngân</button>
                                            <button @click.prevent="modifyRole(user, 'member')" class="text-indigo-600 hover:text-indigo-900 mr-2">Hạ quyền</button>
                                            <button @click.prevent="destroy(user.id)" class="text-indigo-600 hover:text-indigo-900">Xóa</button>
                                        </td>
                                    </tr>
                                </Table>
                                <Pagination :model="users"></Pagination>
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
import { Head } from '@inertiajs/inertia-vue3';
import destroy from '@/Mixins/destroy'
import Table from '@/Components/Table.vue';
import Pagination from '@/Components/Pagination.vue';

export default {
    components: {
    AppLayout,
    Head,
    Table, Pagination
},
    props: ['users'],
    mixins: [destroy],
    methods: {
        modifyRole(user, role) {
            axios.put(route('users.update', user.id), {
                role: role
            }).then((response) => {
                user.roles[0].name = role;
                this.$toast.success('Cập nhật quyền thành công!');
            }).catch(err => {
                this.$toast.error(err.response.data);
            })
        },
        delete(id) {
            axios.delete(route('users.destroy', id)).then((response) => {
                this.users.data.splice(this.users.data.findIndex(u => u.id == id), 1);
                this.$toast.success('Đã xóa thành viên.');
            })
        }
    }
}
</script>
