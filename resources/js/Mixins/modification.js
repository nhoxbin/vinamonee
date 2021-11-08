import destroy from './destroy'

export default {
    mixins: [destroy],
    methods: {
        options() {
            return {
                preserveScroll: true,
                onSuccess: (page) => {
                    this.form.reset();
                },
            };
        },

        modify() {
            var method = route().current('*.create') ? 'post' : 'put';
            this.form[method](this.endpoint, this.options());
        }
    }
}
