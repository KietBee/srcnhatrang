@model MenClothingStore.Models.KHACHHANG

@{
    Layout = "~/Areas/Admin/Views/Shared/_LayoutAdmin.cshtml";
    int i = 1;
}
<title>Thông tin khách hàng @Model.hoKH @Model.tenKH | Khách hàng - Admin 20.April Store</title>
<style>
    .pagination-buttons {
        display: flex;
        justify-content: center;
        margin-top: -3px;
    }
        .pagination-buttons button {
            background-color: #f2f2f2;
            border: none;
            color: #666;
            cursor: pointer;
            padding: 0px 8px;
            margin-right: 5px;
            margin-bottom: 8px;
        }
            .pagination-buttons button.active {
                background-color: #ff0000; /* Đổi màu cho trang đang active */
                color: #ffffff; /* Màu chữ trên nền active */
            }
</style>

<div>
    <ul class="list-group mt-10">
        <li class="list-group-item" style="margin-top:15px">
            <h4>Thông tin khách hàng có mã "@Html.DisplayFor(model => model.maKH)"</h4>
        </li>
    </ul>
    <hr />
    <dl class="dl-horizontal">
        <div class="row">
            <div class="col-md-4">
                <aside class="profile-nav alt">
                    <section class="card">
                        <div class="card-header user-header alt bg-dark">
                            <div class="media">
                                @if (true)
                                {
                                    string imagePath = Server.MapPath("~/Content/img/Users/" + Model.anhKH);
                                    if (System.IO.File.Exists(imagePath))
                                    {<img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="~/Content/img/Users/@Model.anhKH">}
                                    else
                                    {<img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="~/Content/img/Users/employee.png">}
                                }
                                <div class="media-body">
                                    <h4 class="text-light display-6"> @Html.DisplayFor(model => model.hoKH) @Html.DisplayFor(model => model.tenKH)</h4>
                                    <span class="text-light" href="#"> <i class="fa fa-phone"></i> @Html.DisplayFor(model => model.soDTKH)</span>
                                </div>
                            </div>
                        </div>


                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <span href="#"> <i class="fa fa-envelope"></i> @Html.DisplayFor(model => model.emailKH)</span>
                            </li>
                            <li class="list-group-item">
                                <span href="#"> <i class="fa fa-map-marker"></i> @Html.DisplayFor(model => model.diaChiKH)</span>
                            </li>
                        </ul>

                    </section>
                </aside>
                <div style="padding-bottom: 15px; padding-left: 1.2%;">
                    @Html.ActionLink("Quay về", "Index", "KHACHHANGs", htmlAttributes: new { @class = "btn btn-primary" })
                </div>
            </div>
            <div class="col-md-8">
                <dl class="dl-horizontal">
                    <div class="orders">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title text-center" style="font-size:25px">Lịch sử mua hàng</h4>
                            </div>
                            <div class="card-body--">
                                <div class="table-stats order-table ov-h">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Mã hóa đơn</th>
                                                <th>Người lập</th>
                                                <th>Ngày lập hóa đơn</th>
                                                <th>Số lượng</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody id="paginationContainer">
                                            @foreach (var hoaDons in ViewBag.HoaDons)
                                            {
                                                <tr>
                                                    <td>@i</td>
                                                    <td>@hoaDons.maHD</td>
                                                    <td>@hoaDons.NHANVIEN.tenNV</td>
                                                    <td>@hoaDons.ngayLapHD.ToString("dd/MM/yyyy")</td>
                                                    <td>@hoaDons.tongSoLuong</td>
                                                    <td>@hoaDons.tongTienHD</td>
                                                </tr>
                                                i++;
                                            }
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pagination-container">
                                    <div class="pagination-buttons"></div>
                                </div>
                            </div>

                            <script>
                                var rowsPerPage = 8; // Số dòng trên mỗi trang
                                var tableRows = document.querySelectorAll("#paginationContainer tr");
                                var pageCount = Math.ceil(tableRows.length / rowsPerPage);

                                function showPage(page) {
                                    var startIndex = (page - 1) * rowsPerPage;
                                    var endIndex = startIndex + rowsPerPage;

                                    for (var i = 0; i < tableRows.length; i++) {
                                        if (i >= startIndex && i < endIndex) {
                                            tableRows[i].style.display = "table-row";
                                        } else {
                                            tableRows[i].style.display = "none";
                                        }
                                    }

                                    // Đổi màu số trang đang được chọn
                                    var paginationButtons = document.querySelectorAll(".pagination-buttons button");
                                    for (var j = 0; j < paginationButtons.length; j++) {
                                        if (paginationButtons[j].classList.contains("active")) {
                                            paginationButtons[j].classList.remove("active");
                                        }
                                        if (j === page - 1) {
                                            paginationButtons[j].classList.add("active");
                                        }
                                    }
                                }


                                // Hiển thị trang đầu tiên khi trang web tải xong
                                showPage(1);

                                // Tạo các nút chuyển trang
                                var paginationContainer = document.querySelector(".pagination-container");
                                var paginationButtons = document.createElement("div");
                                paginationButtons.classList.add("pagination-buttons");

                                for (var i = 1; i <= pageCount; i++) {
                                    var button = document.createElement("button");
                                    button.innerText = i;
                                    button.addEventListener("click", function () {
                                        showPage(parseInt(this.innerText));
                                    });
                                    paginationButtons.appendChild(button);
                                }

                                paginationContainer.appendChild(paginationButtons);
                            </script>

                        </div>
                    </div>
                </dl>
            </div>
        </div>
    </dl>
    <hr />
</div>
{{--  --}}
@model IEnumerable<MenClothingStore.Models.KHACHHANG>

    @{
        Layout = "~/Areas/Admin/Views/Shared/_LayoutAdmin.cshtml";
        var grid = new WebGrid(Model, canPage: true, defaultSort: "MaKH", rowsPerPage: 7);
        @Scripts.Render("~/Scripts/jquery-1.6.2.min.js")
    }
    <title>Khách hàng - Admin 20.April Store</title>
    <style>
        .table-stats table th img, .table-stats table td img {
            margin-right: 10px;
            max-width: 50px;
        }
    
        abbr[data-original-title], abbr[title] {
            text-decoration: none;
        }
    
        th {
            white-space: nowrap;
        }
    
        td {
            text-align: center;
            white-space: nowrap;
        }
    
        tr {
            border: none !important;
        }
    
        .order-table tr td:last-child, .order-table tr th:last-child {
            text-align: center;
        }
    
        .table {
            width: 100%;
            margin-bottom: 0px;
            background-color: transparent;
        }
    
        .column-style {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            max-width: 150px;
        }
    
        .box-year {
            width: 100%;
            background: none;
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border: none;
        }
        .headerStyle {
            text-align: center;
        }
        .navbar {
            display: block;
            margin: 5px 0;
        }
    </style>
    
    
    <h2 style="padding-top:15px;">DANH SÁCH KHÁCH HÀNG</h2>
    <hr />
    
    <nav class="navbar navbar-expand-sm navbar-default">
        <ul class="nav navbar-nav">
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa  fa-search"></i> Tìm kiếm</a>
                <ul class="sub-menu children dropdown-menu">
                    <li>
                        @using (Html.BeginForm("Index", "KHACHHANGs", FormMethod.Get))
                        {
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="control-label">Mã khách hàng</label>
                                        <div>
                                            @Html.DropDownList("maKH", ViewBag.maKH as SelectList, "Tất cả", new { @class = "form-control" })
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label">Tên khách hàng</label>
                                        <div>
                                            @Html.TextBox("tenKH", ViewBag.tenKH as string, new { @class = "form-control", placeholder = "Nhập tên khách hàng" })
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label">Số điện thoại</label>
                                        <div>
                                            @Html.TextBox("soDTKH", ViewBag.soDTKH as string, new { @class = "form-control", placeholder = "Nhập số điện thoại" })
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Email khách hàng</label>
                                        <div>
                                            @Html.TextBox("emailKH", ViewBag.emailKH as string, new { @class = "form-control", placeholder = "Nhập email" })
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Địa chỉ khách hàng</label>
                                        <div>
                                            @Html.TextBox("diaChiKH", ViewBag.diaChiKH as string, new { @class = "form-control", placeholder = "Nhập địa chỉ khách hàng" })
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div style="float: right; margin-top: 5px">
                                    <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-success" style="margin-bottom: 1em" />
                                    <input type="button" name="Nhapmoi" value="Nhập mới" class="btn btn-primary" style="margin-bottom: 1em"
                                           onclick="location.href='@Url.Action("Index", "KHACHHANGs")'" />
                                </div>
                            </div>
                        }
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <hr />
    
    @if (!string.IsNullOrEmpty(ViewBag.ErrorMessage))
    {
        <div id="gridContent">
            <div style="margin-left: 20px; color: black; width: 351px" class="alert alert-danger">@ViewBag.ErrorMessage</div>
            <hr />
        </div>
    }
    else
    {
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
    
                        </div>
                        <div class="card-body--">
                            <div class="table-stats order-table ov-h">
                                <div id="gridContent">
                                    @grid.GetHtml(
                                        tableStyle: "table table-bordered table-hover",
                                        headerStyle: "headerStyle",
                                        footerStyle: "grid-footer",
                                        fillEmptyRows: true,
                                        mode: WebGridPagerModes.Numeric,
                                        alternatingRowStyle: "alternatingRowStyle",
                                        columns: new[]  // colums in grid
                                        {
                                            grid.Column("STT",format: item => item.WebGrid.Rows.IndexOf(item) + 1 + Math.Round(Convert.ToDouble(grid.TotalRowCount / grid.PageCount) / grid.RowsPerPage) * grid.RowsPerPage * grid.PageIndex),
                                            grid.Column(
                                            columnName: "anhKH",
                                            header: "Ảnh",
                                            format:@<text>
                        @if(true){string imagePath = Server.MapPath("~/Content/img/Users/" + item.anhKH);
                                                    if(System.IO.File.Exists(imagePath))
                                                    {<img src="~/Content/img/Users/@item.anhKH" width="50" height="50"  style="border-radius: 50%; object-fit:cover" />}
                                                    else
                                                    {<img src="~/Content/img/Users/employee.png" width="50" height="50" style="border-radius: 50%; object-fit: cover " />}
                                                 } </text>),
                          grid.Column("maKH","Mã"),
                          grid.Column("hoKH","Họ"),
                          grid.Column("tenKH","Tên"),
                          grid.Column("soDTKH","SĐT"),
                          grid.Column("diaChiKH", "Địa chỉ", style: "column-style"),
                          grid.Column("emailKH","Email",style: "text-lowercase"),
                          grid.Column("Chi tiết", format: @<text>
                                                <a href="@Url.Action("Details", new { id = item.maKH})" class="edit-btn">
                                                    <abbr title="Xem chi tiết">
                                                        <i class="fas fa-info-circle text-success" style="font-size: 20px"></i>
                                                    </abbr>
                                                </a></text>),
                    }
                )
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    }
    
    {{--  --}}
    @{
        Layout = "~/Areas/Admin/Views/Shared/_LayoutAdmin.cshtml";
    }
    <title>@ViewBag.hoNV @ViewBag.tenNV: Hồ sơ cá nhân - Admin 20.April Store</title>
    <style>
        .list-group-item {
            position: relative;
            display: block;
            padding: .75rem 1.25rem;
            margin-bottom: -1px;
            background-color: #fff;
            border: 1px solid rgba(0,0,0,.125);
            height: 4em;
            font-size: 20px;
            display: flex;
            flex-direction: row;
            align-items: center;
        }
    </style>
    <div class="container-fluid" style="padding-top: 6vh; height: 91.5vh;">
        <h2 style="padding-top:15px;">THÔNG TIN TÀI KHOẢN</h2>
        <hr />
        <div class="card">
            <div class="row px-xl-5">
                <div class="col-md-7 mb-5 ">
                    <aside class="profile-nav alt" style="margin-top: 25px">
                        <section class="card" style="border: 1px solid;">
                            <div class="card-header user-header alt bg-dark" style="max-height:9em">
                                <div class="media" style="max-height:8em">
                                    @if (true)
                                    {
                                        string imagePath = Server.MapPath("~/Content/img/Users/" + @ViewBag.anhNV);
                                        if (System.IO.File.Exists(imagePath))
                                        {<img class="align-self-center rounded-circle mr-3" style="width:110px; height:110px; object-fit: cover"  alt="" src="~/Content/img/Users/@ViewBag.anhNV">}
                                        else
                                        {<img class="align-self-center rounded-circle mr-3" style="width:110px; height:110px; object-fit: cover" alt="" src="~/Content/img/Users/employee.png">}
                                    }
                                    <div class="media-body" style=" height: 6em; display: flex; flex-direction: column; justify-content: center; font-size: 20px;">
                                        <h4 class="text-light display-6" style="font-size: 20px;"> @ViewBag.hoNV @ViewBag.tenNV</h4>
                                        <span class="text-light" href="#"> <i class="fa fa-phone"></i> @ViewBag.soDTNV</span>
                                    </div>
                                </div>
                            </div>
    
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <span href="#"> <i class="fa fa-envelope"></i> @ViewBag.emailNV</span>
                                </li>
                                <li class="list-group-item">
                                    <span href="#"> <i class="fa fa-barcode"></i> @ViewBag.maNV</span>
                                </li>
                            </ul>
    
                        </section>
                    </aside>
                </div>
                <div class="col-md-5 mb-5">
                    <div class="contact-form  p-30">
                        <div id="success"></div>
                        <form enctype="multipart/form-data" method="post" action="@Url.Action("Edit","NHANVIENs",new {maNV = ViewBag.maNV,hoNV = ViewBag.hoNV, tenNV = ViewBag.tenNV, soDTNV = ViewBag.soDTNV, emailNV = ViewBag.emailNV} )">
                            <div class="control-group">
                                <p class="text-success">@TempData["Mess"]</p>
                                <input value="@ViewBag.maNV" type="text" name="maNV" class="form-control" id="code" readonly hidden />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class=" row">
                                <div class="col-md-6">
                                    <p>Họ</p>
                                    <input value="@ViewBag.hoNV" type="text" name="hoNV" class="form-control" id="name" placeholder="Your Name"
                                           required="required" data-validation-required-message="Please enter your name" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="col-md-6">
                                    <p>Tên</p>
                                    <input value="@ViewBag.tenNV" type="text" name="tenNV" class="form-control" id="email" placeholder="Your Email"
                                           required="required" data-validation-required-message="Please enter your email" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <p>Số điện thoại</p>
                                <input value="@ViewBag.soDTNV" type="text" name="soDTNV" class="form-control" id="subject" placeholder="Subject"
                                       required="required" data-validation-required-message="Please enter a subject" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input value="@ViewBag.emailNV" type="email" name="emailNV" class="form-control" id="subject" placeholder="Subject"
                                       required="required" data-validation-required-message="Please enter a subject" readonly hidden />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <p>Ảnh</p>
                                <input class="" type="file" style="height:30px;" name="Avatar" accept="image/*" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary py-2 px-4">Cập nhật thông tin</button>
                            </div>
                        </form>
    
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    
    
    
    
    {{-- <body class="font-sans antialiased text-gray-900 leading-normal tracking-wider bg-cover"
    style="background-image:url('https://source.unsplash.com/1L71sPT5XKc');">



    <div class="max-w-4xl flex items-center h-auto lg:h-screen flex-wrap mx-auto my-32 lg:my-0">

        <!--Main Col-->
        <div id="profile"
            class="w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-white opacity-75 mx-6 lg:mx-0 dark:bg-gray-900 dark:text-white duration-500">


            <div class="p-4 xl:p-12 text-center lg:text-left">
                <!-- Image for mobile view-->
                <div class="block lg:hidden rounded-full shadow-xl mx-auto -mt-16 h-48 w-48 bg-cover bg-center"
                    style="background-image: url('https://source.unsplash.com/MP0IUfwrn0A')"></div>

                <h1 class="text-3xl font-bold pt-8 lg:pt-0">Your Name</h1>
                <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-green-500 opacity-25"></div>
                <p class="pt-4 text-base font-bold flex items-center justify-center lg:justify-start">
                    <svg class="h-4 fill-current text-green-700 pr-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M9 12H1v6a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-6h-8v2H9v-2zm0-1H0V5c0-1.1.9-2 2-2h4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v1h4a2 2 0 0 1 2 2v6h-9V9H9v2zm3-8V2H8v1h4z" />
                    </svg> What you do
                </p>
                <p class="pt-2 text-gray-600 text-xs lg:text-xl flex items-center justify-center lg:justify-start">
                    <svg class="h-4 fill-current text-green-700 pr-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm7.75-8a8.01 8.01 0 0 0 0-4h-3.82a28.81 28.81 0 0 1 0 4h3.82zm-.82 2h-3.22a14.44 14.44 0 0 1-.95 3.51A8.03 8.03 0 0 0 16.93 14zm-8.85-2h3.84a24.61 24.61 0 0 0 0-4H8.08a24.61 24.61 0 0 0 0 4zm.25 2c.41 2.4 1.13 4 1.67 4s1.26-1.6 1.67-4H8.33zm-6.08-2h3.82a28.81 28.81 0 0 1 0-4H2.25a8.01 8.01 0 0 0 0 4zm.82 2a8.03 8.03 0 0 0 4.17 3.51c-.42-.96-.74-2.16-.95-3.51H3.07zm13.86-8a8.03 8.03 0 0 0-4.17-3.51c.42.96.74 2.16.95 3.51h3.22zm-8.6 0h3.34c-.41-2.4-1.13-4-1.67-4S8.74 3.6 8.33 6zM3.07 6h3.22c.2-1.35.53-2.55.95-3.51A8.03 8.03 0 0 0 3.07 6z" />
                    </svg> Your Location - 25.0000° N, 71.0000° W
                </p>
                <p class="pt-8 text-xl">Totally optional short description about yourself, what you do and so on.</p>

                <div class="pt-12 pb-8">
                    <button class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded-full">
				         Get In Touch
				     </button>
                </div>

                <div class="mt-6 pb-16 lg:pb-0 w-4/5 lg:w-full mx-auto flex flex-wrap items-center justify-between">
                    <a class="link" href="#" data-tippy-content="@facebook_handle">
                        <svg class="h-6 fill-current text-gray-600 hover:text-green-700" role="img" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>Facebook</title>
                            <path
                                d="M22.676 0H1.324C.593 0 0 .593 0 1.324v21.352C0 23.408.593 24 1.324 24h11.494v-9.294H9.689v-3.621h3.129V8.41c0-3.099 1.894-4.785 4.659-4.785 1.325 0 2.464.097 2.796.141v3.24h-1.921c-1.5 0-1.792.721-1.792 1.771v2.311h3.584l-.465 3.63H16.56V24h6.115c.733 0 1.325-.592 1.325-1.324V1.324C24 .593 23.408 0 22.676 0" />
                        </svg>
                    </a>
                    <a class="link" href="#" data-tippy-content="@twitter_handle">
                        <svg class="h-6 fill-current text-gray-600 hover:text-green-700" role="img" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>Twitter</title>
                            <path
                                d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z" />
                        </svg>
                    </a>
                    <a class="link" href="#" data-tippy-content="@github_handle">
                        <svg class="h-6 fill-current text-gray-600 hover:text-green-700" role="img" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>GitHub</title>
                            <path
                                d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
                        </svg>
                    </a>
                    <a class="link" href="#" data-tippy-content="@unsplash_handle">
                        <svg class="h-6 fill-current text-gray-600 hover:text-green-700" role="img" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>Unsplash</title>
                            <path d="M7.5 6.75V0h9v6.75h-9zm9 3.75H24V24H0V10.5h7.5v6.75h9V10.5z" />
                        </svg>
                    </a>
                    <a class="link" href="#" data-tippy-content="@dribble_handle">
                        <svg class="h-6 fill-current text-gray-600 hover:text-green-700" role="img" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>Dribbble</title>
                            <path
                                d="M12 24C5.385 24 0 18.615 0 12S5.385 0 12 0s12 5.385 12 12-5.385 12-12 12zm10.12-10.358c-.35-.11-3.17-.953-6.384-.438 1.34 3.684 1.887 6.684 1.992 7.308 2.3-1.555 3.936-4.02 4.395-6.87zm-6.115 7.808c-.153-.9-.75-4.032-2.19-7.77l-.066.02c-5.79 2.015-7.86 6.025-8.04 6.4 1.73 1.358 3.92 2.166 6.29 2.166 1.42 0 2.77-.29 4-.814zm-11.62-2.58c.232-.4 3.045-5.055 8.332-6.765.135-.045.27-.084.405-.12-.26-.585-.54-1.167-.832-1.74C7.17 11.775 2.206 11.71 1.756 11.7l-.004.312c0 2.633.998 5.037 2.634 6.855zm-2.42-8.955c.46.008 4.683.026 9.477-1.248-1.698-3.018-3.53-5.558-3.8-5.928-2.868 1.35-5.01 3.99-5.676 7.17zM9.6 2.052c.282.38 2.145 2.914 3.822 6 3.645-1.365 5.19-3.44 5.373-3.702-1.81-1.61-4.19-2.586-6.795-2.586-.825 0-1.63.1-2.4.285zm10.335 3.483c-.218.29-1.935 2.493-5.724 4.04.24.49.47.985.68 1.486.08.18.15.36.22.53 3.41-.43 6.8.26 7.14.33-.02-2.42-.88-4.64-2.31-6.38z" />
                        </svg>
                    </a>
                    <a class="link" href="#" data-tippy-content="@instagram_handle">
                        <svg class="h-6 fill-current text-gray-600 hover:text-green-700" role="img" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>Instagram</title>
                            <path
                                d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                        </svg>
                    </a>
                    <a class="link" href="#" data-tippy-content="@youtube_handle">
                        <svg class="h-6 fill-current text-gray-600 hover:text-green-700" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <title>YouTube</title>
                            <path
                                d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z" />
                        </svg>
                    </a>
                </div>

                <!-- Use https://simpleicons.org/ to find the svg for your preferred product -->

            </div>

        </div>

        <!--Img Col-->
        <div class="w-full lg:w-2/5">
            <!-- Big profile image for side bar (desktop) -->
            <img src="https://source.unsplash.com/MP0IUfwrn0A" class="rounded-none lg:rounded-lg shadow-2xl hidden lg:block">
            <!-- Image from: http://unsplash.com/photos/MP0IUfwrn0A -->

        </div>

    </div>

</body> --}}