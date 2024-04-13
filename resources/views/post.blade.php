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
    
    
    
    
    