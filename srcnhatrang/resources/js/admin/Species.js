class Species {
    constructor() {
        this.$this = $('#admin-specie')
    }

    init() {
        if (this.$this.length > 0) {
            this.initialize()
        }
        
    }

    initialize() {
        $(document).ready(() => {
            $(document).on('click', '.btnDelete', (event) => {
                this.handleDelete(event)
            })
        })
    }

    handleDelete(event) {
        var ID = $(event.target).data('target')
        if (confirm('Bạn có chắc chắn muốn xóa bản ghi này không?')) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content')
            $.ajax({
                url: '/admin/species/' + ID,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: (response) => {
                    $(event.target).closest('tr').remove()
                    alert(response.message)
                },
                error: (error) => {
                    console.error('Lỗi khi xóa bản ghi:', error)
                }
            })
        }
    }
}

new Species().init()