export default class User {
    // constructor() {
    //     this.sortStates = {}
    //     this.pageSize = 8
    //     this.userType = ''
    //     this.page = 1
    //     this.search = ''
    //     this.sortBy = ''
    //     this.sortDirection = ''

    //     this.$this = $('#admin-user')
    //     this.componentTableClass = '#component-table'
    //     this.alertsContent = '#alerts-content'
    //     this.pageSizeDropdownId = '#page-size-dropdown'
    //     this.userTypeDropdownId = '#user-type-dropdown'
    //     this.searchFormId = '#search-form'
    //     this.searchInputId = '#search-input'
    //     this.paginationId = '#pagination'
    //     this.showPasswordCheckboxId = '#show_password'
    //     this.passwordFieldId = '#password'
    //     this.passwordConfirmationFieldId = '#password_confirmation'
    // }

    // init() {
    //     if (this.$this.length > 0) {
    //         this.restoreStateFromURL()
    //         this.loadUsers(this.page)
    
    //         this.attachEvents()
    //       }
        
    // }

    // attachEvents() {
    //     $(document).on('click', `${this.componentTableClass} th[data-sort-by]`, (event) => {
    //         this.handleSort(event)
    //     })

    //     $(`${this.pageSizeDropdownId} input[type="radio"]`).change((event) => {
    //         this.pageSize = $(event.currentTarget).val()
    //         this.loadUsers()
    //     })

    //     $(`${this.userTypeDropdownId} input[type="radio"]`).change((event) => {
    //         this.userType = $(event.currentTarget).val()
    //         this.loadUsers()
    //     })

    //     $(this.searchFormId).submit((event) => {
    //         event.preventDefault()
    //         this.search = $(this.searchInputId).val()
    //         this.loadUsers(1)
    //     })

    //     $(document).on('click', `${this.paginationId} .prev-link`, (event) => {
    //         event.preventDefault()
    //         const currentPage = parseInt($(`${this.paginationId} .pagination-link.active`).text())
    //         if (currentPage > 1) {
    //             this.loadUsers(currentPage - 1)
    //         }
    //     })

    //     $(document).on('click', `${this.paginationId} .next-link`, (event) => {
    //         event.preventDefault()
    //         const currentPage = parseInt($(`${this.paginationId} .pagination-link.active`).text())
    //         const totalPages = parseInt($(`${this.paginationId} .pagination-link`).last().text())
    //         if (currentPage < totalPages) {
    //             this.loadUsers(currentPage + 1)
    //         }
    //     })

    //     $(document).on('click', `${this.paginationId} .pagination-link`, (event) => {
    //         event.preventDefault()
    //         const page = parseInt($(event.currentTarget).text())
    //         this.loadUsers(page)
    //     })

    //     $(this.showPasswordCheckboxId).change(() => {
    //         const type = $(this.showPasswordCheckboxId).prop('checked') ? 'text' : 'password'
    //         $(this.passwordFieldId + ', ' + this.passwordConfirmationFieldId).attr('type', type)
    //     })
    // }

    // handleSort(event) {
    //     event.preventDefault()
    //     const column = $(event.currentTarget).data('sort-by')
    //     if (column !== '') {
    //         let direction = this.sortStates[column] || 'asc'
    //         direction = direction === 'asc' ? 'desc' : 'asc'
    //         this.sortStates[column] = direction
    //         $(event.currentTarget).siblings().removeClass('active')
    //         $(event.currentTarget).addClass('active')
    //         this.loadUsers()
    //     }
    // }

    // restoreStateFromURL() {
    //     const urlParams = new URLSearchParams(window.location.search)
    //     this.pageSize = parseInt(urlParams.get('pageSize')) || this.pageSize

    //     this.search = urlParams.get('search') || ''
    //     $(this.searchInputId).val(this.search)

    //     this.userType = urlParams.get('userType') || ''
    //     if (this.userType !== '') {
    //         $(`${this.userTypeDropdownId} input[type="radio"][value="${this.userType}"]`).prop('checked', true)
    //     }

    //     const pageSizeValue = parseInt(urlParams.get('pageSize')) || this.pageSize
    //     $(`${this.pageSizeDropdownId} input[type="radio"][value="${pageSizeValue}"]`).prop('checked', true)
    // }


    // loadUsers(page = 1) {
    //     const token = $('meta[name="csrf-token"]').attr('content')
    //     let column = $(`${this.componentTableClass} th[data-sort-by].active`).data('sort-by') || 'id'
    //     let direction = this.sortStates[column] || 'asc'

    //     const activeColumns = $(`${this.componentTableClass} th.active`).map(function() {
    //         return $(this).data('sort-by')
    //     }).get()

    //     const url = new URL('/user', window.location.origin)
    //     const params = new URLSearchParams()
    //     if (page !== null) params.append('page', page)
    //     if (this.pageSize !== null) params.append('pageSize', this.pageSize)
    //     if (this.userType !== '' && this.userType !== null) params.append('userType', this.userType)
    //     if (this.search !== '' && this.search !== null) params.append('search', this.search)
    //     if (this.sortBy !== null) params.append('sortBy', column)
    //     if (this.sortDirection !== null) params.append('sortDirection', direction)

    //     url.search = params.toString()

    //     $.ajax({
    //         url: url.toString(),
    //         type: 'GET',
    //         headers: { 'X-CSRF-TOKEN': token },
    //         success: (response) => {
    //             if (response.totalUsers > 0) {
    //                 if (response.headers) {
    //                     $('#header-table').html(response.headers)
    //                     $('#data-table').html(response.rowsHtml)
    //                     $(this.alertsContent).html('')
    //                     $(this.paginationId).html(response.paginationHtml)

    //                     activeColumns.forEach((col) => {
    //                         $(`${this.componentTableClass} th[data-sort-by="${col}"]`).addClass('active')
    //                     })

    //                     const currentPage = parseInt($(`${this.paginationId} .pagination-link.active`).text())
    //                     $(`${this.paginationId} .pagination-link`).removeClass('active')
    //                     $(`${this.paginationId} .pagination-link:contains('${page}')`).addClass('active')

    //                     $('html, body').animate({
    //                         scrollTop: $('#header-table').offset().top
    //                     }, 500)
    //                 } else {
    //                     console.error('Error: Invalid response format.')
    //                 }
    //             } else {
    //                 $('#header-table').html('')
    //                 $('#data-table').html('')
    //                 $(this.alertsContent).html('<p class="py-10">Không có kết quả tìm kiếm</p>')
    //                 $(this.paginationId).html('')
    //             }
    //         },
    //         error: (xhr) => {
    //             console.error('Error:', xhr.responseText)
    //         }
    //     })
    //     window.history.pushState({}, '', url.toString())
    // }
    constructor() {
        this.$this = $('#admin-user')
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
        var userId = $(event.target).data('target')
        if (confirm('Bạn có chắc chắn muốn xóa bản ghi này không?')) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content')
            $.ajax({
                url: '/user/' + userId,
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

new User().init()
