class AddressDropdowns {
    constructor() {
        this.$province = $('#province')
        this.$district = $('#district')
        this.$ward = $('#ward')
        this.bindProvinceChange = this.bindProvinceChange.bind(this)
        this.bindDistrictChange = this.bindDistrictChange.bind(this)
    }

    init() {
        console.log('init')
        this.bindProvinceChange()
        this.bindDistrictChange()
    }

    bindProvinceChange() {
        this.$province.change(() => {
            const province_id = this.$province.val()
            if (province_id) {
                $.ajax({
                    type: "GET",
                    url: "/districts/" + province_id,
                    success: (res) => {
                        if (res) {
                            this.$district.empty()
                            this.$district.append('<option value="">Chọn Quận/Huyện</option>')
                            $.each(res, (key, value) => {
                                this.$district.append('<option value="' + value.id + '">' + value.name + '</option>')
                            })
                        } else {
                            this.$district.empty()
                        }
                    }
                })
            } else {
                this.$district.empty()
            }
        })
    }

    bindDistrictChange() {
        this.$district.change(() => {
            const district_id = this.$district.val()
            if (district_id) {
                $.ajax({
                    type: "GET",
                    url: "/wards/" + district_id,
                    success: (res) => {
                        if (res) {
                            this.$ward.empty()
                            this.$ward.append('<option value="">Chọn Phường/Xã</option>')
                            $.each(res, (key, value) => {
                                this.$ward.append('<option value="' + value.id + '">' + value.name + '</option>')
                            })
                        } else {
                            this.$ward.empty()
                        }
                    }
                })
            } else {
                this.$ward.empty()
            }
        })
    }
}

new AddressDropdowns().init()
