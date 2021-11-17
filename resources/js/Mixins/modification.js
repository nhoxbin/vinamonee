import destroy from './destroy'

export default {
    mixins: [destroy],
    methods: {
        options() {
            return {
                preserveScroll: true,
                onSuccess: (page) => {
                    this.$toast.success('Lưu thành công.');
                    this.form.reset();
                },
            };
        },

        modify() {
            var method = route().current('*.create') ? 'post' : 'patch';
            this.form.transform((data) => ({
                ...data,
                _method: method
            })).post(this.endpoint, this.options());
        }
    }
}
