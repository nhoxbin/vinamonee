<template>
    <Head title="Hồ sơ" />

    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tạo hồ sơ
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-10 sm:mt-0">
                    <div class="mb-3 flex flex-col">
                        <div class="grid justify-items-end">
                            <Link :href="route('customers.index')" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Quay lại</Link>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Thông tin người vay</h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    Sử dụng thông tin ở đây để liên lạc với người vay
                                </p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form @submit.prevent="modify">
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="name" class="block text-sm font-medium text-gray-700">Họ Tên</label>
                                                <input type="text" v-model="form.info.name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.name')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.name'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="dob" class="block text-sm font-medium text-gray-700">Ngày sinh</label>
                                                <input type="text" v-model="form.info.dob" id="dob" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.dob')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.dob'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-2">
                                                <label for="cmnd" class="block text-sm font-medium text-gray-700">CMND</label>
                                                <input type="text" v-model="form.info.cmnd.number" id="cmnd" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.cmnd.number')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.cmnd.number'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-2">
                                                <label for="cmnd_date" class="block text-sm font-medium text-gray-700">Ngày cấp</label>
                                                <input type="text" v-model="form.info.cmnd.date" id="cmnd_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.cmnd.date')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.cmnd.date'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-2">
                                                <label for="cmnd_place" class="block text-sm font-medium text-gray-700">Nơi cấp</label>
                                                <input type="text" v-model="form.info.cmnd.place" id="cmnd_place" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.cmnd.place')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.cmnd.place'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="work" class="block text-sm font-medium text-gray-700">Nghề nghiệp</label>
                                                <input type="text" v-model="form.info.work" id="work" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.work')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.work'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="income" class="block text-sm font-medium text-gray-700">Mức lương</label>
                                                <input type="text" v-model="form.info.income" id="income" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.income')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.income'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="household" class="block text-sm font-medium text-gray-700">Hộ khẩu thường trú</label>
                                                <input type="text" v-model="form.info.household" id="household" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.household')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.household'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="place" class="block text-sm font-medium text-gray-700">Nơi ở hiện tại</label>
                                                <input type="text" v-model="form.info.place" id="place" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.place')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.place'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-4">
                                                <label for="phone" class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                                                <input type="text" v-model="form.info.phone" id="phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.phone')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.phone'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="loan_amt" class="block text-sm font-medium text-gray-700">Số tiền vay</label>
                                                <input type="text" v-model="form.info.loan.amt" id="loan_amt" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.loan.amt')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.loan.amt'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="loan_time" class="block text-sm font-medium text-gray-700">Thời gian</label>
                                                <select v-model="form.info.loan.time" id="loan_time" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    <option value="30" :selected="form.info.loan.time == 30">30 Ngày</option>
                                                    <option value="60" :selected="form.info.loan.time == 60">60 Ngày</option>
                                                    <option value="90" :selected="form.info.loan.time == 90">90 Ngày</option>
                                                </select>
                                                <span v-if="form.errors.hasOwnProperty('info.loan.time')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.loan.time'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="assets" class="block text-sm font-medium text-gray-700">Tài sản đảm bảo</label>
                                                <input type="text" v-model="form.info.assets" id="assets" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.assets')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.assets'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="phone0" class="block text-sm font-medium text-gray-700">Số điện thoại người thân 1</label>
                                                <input type="text" v-model="form.info.relative_contacts[0].phone" id="phone0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.relative_contacts.0.phone')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.relative_contacts.0.phone'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="relative0" class="block text-sm font-medium text-gray-700">Quan hệ 1</label>
                                                <input type="text" v-model="form.info.relative_contacts[0].relative" id="relative0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.relative_contacts.0.relative')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.relative_contacts.0.relative'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="phone1" class="block text-sm font-medium text-gray-700">Số điện thoại người thân 2</label>
                                                <input type="text" v-model="form.info.relative_contacts[1].phone" id="phone1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.relative_contacts.1.phone')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.relative_contacts.1.phone'] }}
                                                </span>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="relative1" class="block text-sm font-medium text-gray-700">Quan hệ 2</label>
                                                <input type="text" v-model="form.info.relative_contacts[1].relative" id="relative1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <span v-if="form.errors.hasOwnProperty('info.relative_contacts.1.relative')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.relative_contacts.1.relative'] }}
                                                </span>
                                            </div>

                                            <div v-if="user.roles.isSaler" class="col-span-6 sm:col-span-3">
                                                <label for="files_saler" class="block text-sm font-medium text-gray-700">Hình ảnh của sale</label>
                                                <input type="file" @change="handleFileUpload($event, 'saler')" multiple id="files_saler" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                                                <span v-if="form.errors.hasOwnProperty('info.files.saler')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.files.saler'] }}
                                                </span>
                                            </div>

                                            <div v-if="user.roles.isAppraiser" class="col-span-6 sm:col-span-3">
                                                <label for="files_appraiser" class="block text-sm font-medium text-gray-700">Hình ảnh của thẩm định</label>
                                                <input type="file" @change="handleFileUpload($event, 'appraiser')" multiple id="files_appraiser" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                                                <span v-if="form.errors.hasOwnProperty('info.files.appraiser')" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                    {{ form.errors['info.files.appraiser'] }}
                                                </span>
                                            </div>

                                            <div v-if="user.roles.isSaler" class="col-span-6 sm:col-span-6">
                                                <label for="notes_saler" class="block text-sm font-medium text-gray-700">
                                                    Ghi chú của sale
                                                </label>
                                                <div class="mt-1">
                                                    <textarea id="notes_saler" v-model="form.info.notes.saler" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                                                </div>
                                            </div>

                                            <div v-if="user.roles.isAppraiser" class="col-span-6 sm:col-span-6">
                                                <label for="notes_appraiser" class="block text-sm font-medium text-gray-700">
                                                    Ghi chú của thẩm định
                                                </label>
                                                <div class="mt-1">
                                                    <textarea id="notes_appraiser" v-model="form.info.notes.appraiser" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 bg-gray-50 sm:px-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-3 sm:col-span-3 text-left">
                                                <button @click.prevent="approved('is_appraised')" v-if="user.roles.isAppraiser" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2">
                                                    Thẩm định
                                                </button>
                                                <button @click.prevent="approved('is_disbursed')" v-if="user.roles.isDisburser" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Giải ngân
                                                </button>
                                            </div>
                                            <div class="col-span-3 sm:col-span-3 text-right">
                                                <button v-if="user.roles.isSaler || user.roles.isAppraiser" type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Lưu
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="customer.payments" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-10 sm:mt-0">
                    <div class="flex flex-col">
                        <div class="mb-3 flex flex-col">
                            <div class="grid justify-items-end">
                                <button @click="paid(route('customers.payments.store', customer.id), 'post')" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Thanh toán</button>
                            </div>
                        </div>
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <Table :headers="['Số tiền', 'Thời gian']" :model="customer.payments">
                                        <tr v-for="payment in customer.payments.data" :key="payment.id">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="font-medium text-gray-900">
                                                    {{ payment.amt }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ payment.created_date }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <button @click="paid(route('customers.payments.update', [customer.id, payment.id]), 'put')" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Cập nhật</button>
                                            </td>
                                        </tr>
                                    </Table>
                                    <Pagination :model="customer.payments" />
                                </div>
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
import { Head, Link } from '@inertiajs/inertia-vue3'
import modification from '@/Mixins/modification'
import Table from '@/Components/Table'
import Pagination from '@/Components/Pagination'

export default {
    components: {
        AppLayout,
        Head, Link,
        Table, Pagination
    },
    props: ['user', 'customer'],
    mixins: [modification],
    data: function() {
        return {
            form: this.$inertia.form(this.customer)
        }
    },
    computed: {
        endpoint() {
            if (route().current('customers.create')) {
                return route('customers.store');
            } else {
                return route('customers.update', this.customer.id);
            }
        },
    },
    watch: {
        'form.info.loan.amt': function(val) {
            this.form.info.loan.amt = val.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        },
        'form.info.income': function(val) {
            this.form.info.income = val.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        },
    },
    methods: {
        handleFileUpload(e, role) {
            for (var i = 0; i < e.target.files.length; i++) {
                this.form.info.files[role][i] = e.target.files[i];
            }
        },
        async paid(route, method) {
            let amt = await this.$swal({
                title: this.customer.info.name + ' đã thanh toán với số tiền?',
                input: 'text',
                inputPlaceholder: 'Nhập số tiền',
                showCloseButton: true,
            });
            if (amt.isConfirmed) {
                axios[method](route, {amt: amt.value}).then(resp => {
                    this.$toast.success('Thao tác thành công.')
                }).catch(err => {
                    this.$toast.error(err.response.data.errors.amt[0]);
                })
            }
        },
        approved(type) {
            var msg = type == 'is_appraised' ? 'thẩm định!' : 'giải ngân!';
            this.$swal.fire({
                title: 'Hồ sơ này sẽ được ' + msg,
                showDenyButton: true,
                confirmButtonText: 'OK',
                denyButtonText: 'Không',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.put(route('approved', this.customer.id), {
                        type: type
                    }).then(resp => {
                        this.$toast.success('Hồ sơ này đã được ' + msg);
                    })
                } else if (result.isDenied) {

                }
            })
        }
    }
}
</script>
