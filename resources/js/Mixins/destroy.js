export default {
    methods: {
        destroy (id) {
            this.$swal.fire({
                title: 'Xác nhận!',
                text: "Bạn chắc chắn chứ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.delete(id);
                }
            })
        }
    }
}
