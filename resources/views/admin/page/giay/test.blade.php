@extends('admin.share.master')
@section('noi_dung')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <h6 class="mb-0 text-uppercase">DANH SÁCH GIÀY</h6>
        </div>
    </div>
    <hr />
    <div class="row" id="app">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h6>Danh sách giày</h6>
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ThemMoiModal">Thêm mới giày</button>
                </div>

                <div class="card-body">
                    <table class="table table-responsive table-bordered text-center align-middle">
                        <thead>
                            <th>#</th>
                            <th>Tên giày</th>
                            <th>Hình ảnh</th>
                            <th>Thương hiệu</th>
                            <th>Giá</th>
                            <th>Tình trạng</th>
                            <th>Action</th>
                        </thead>
                        <tbody v-for="(v, k) in List_products">
                            <td>@{{ k }}</td>
                            <td>@{{ v.ten_san_pham }}</td>
                            <td><img v-bind:src="v.hinh_anh" class="product-img-2" alt="product img"></td>
                            <td>@{{ v.ten_thuong_hieu }}</td>
                            <td>@{{ convertToVND(v.gia) }}</td>
                            <td>
                                <button class="badge bg-gradient-quepal text-white shadow-sm w-100" v-if="v.tinh_trang == 1"
                                    v-on:click="doiStatus(v)">Hiển thị</button>
                                <button class="badge bg-gradient-bloody text-white shadow-sm w-100" v-else
                                    v-on:click="doiStatus(v)">Ẩn</button>
                            </td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                                        data-bs-target="#EditModal" v-on:click="giayEdit(v)"><i
                                            class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-dark"
                                        v-on:click="giay_del = Object.assign({}, v)" data-bs-toggle="modal"
                                        data-bs-target="#DelBackdrop"><i class="bx bx-trash-alt me-0"></i></i>
                                    </button>
                                </div>
                            </td>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li v-if="currentPage > 1" class="page-item">
                                <a class="page-link" href="#" v-on:click="changePage(currentPage-1)" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <template v-for="k in lastPage">
                                <li class="page-item" :class="{'active' : currentPage===k}">
                                    <a class="page-link" href="#" v-on:click="changePage(k)">@{{k}}</a>
                                </li>
                            </template>
                            <li class="page-item"  v-if="currentPage < lastPage">
                                <a class="page-link" href="#" v-on:click="changePage(currentPage+1)" aria-label="Next" >
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>

        </div>


        <!-- Modal -->
        <div class="modal fade" id="ThemMoiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm mới giày</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="">Tên giày</label>
                                            <input type="text" class="form-control" v-model="giay.ten_san_pham">
                                        </div>

                                        <div class="mb-3">
                                            <label for="">Gia</label>
                                            <input type="number" class="form-control" v-model="giay.gia">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Hãng giày</label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay.thuong_hieu_id">
                                                @foreach ($thuonghieus as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_thuong_hieu }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Giới tính</label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay.gioi_tinh_id">
                                                <option value="0">Nam</option>
                                                <option value="1">Nữ</option>
                                                <option value="3">Cả 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="">Hình ảnh</label>
                                            <input type="text" class="form-control" v-model="giay.hinh_anh">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Danh mục</label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay.danh_muc_id">
                                                @foreach ($danhmucs as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_danh_muc }}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="">Tình trạng</label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay.tinh_trang">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Khóa</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="">Mô tả</label>
                                    <textarea name="mota" rows="30" cols="10"></textarea>
                                </div>

                                <div class="mb-3">
                                    <div id="variants" class="row">
                                        <div class="variant col">
                                            <label for="size">Kích thước:</label>
                                            <select name="size" class="form-control" v-model="opt.kich_thuoc_id">
                                                @foreach ($kichthuocs as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_kich_thuoc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="variant col">
                                            <label for="color">Màu sắc:</label>
                                            <select name="color" class="form-control" v-model="opt.mau_sac_id">
                                                @foreach ($mausacs as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_mau_sac }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="variant col">
                                            <label for="">Hình ảnh</label>
                                            <input type="text" class="form-control" v-model="opt.hinh_anh">
                                        </div>

                                        <div class="variant col">
                                            <label for="stock">Số lượng tồn kho:</label>
                                            <input type="number" name="stock" class="form-control"
                                                v-model="opt.so_luong" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-info" id="addVariant"
                                        v-on:click="PushOpt(opt)">Add Option</button>
                                </div>

                                <div class="mb-3">


                                    <table class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kích thước</th>
                                                <th>Màu sắc</th>
                                                <th>Hình ảnh</th>
                                                <th>Số lượng</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template v-for="(v, k) in List_Opt">
                                                <tr>
                                                    <td>
                                                        <select name="size" class="form-control"
                                                            v-model="v.kich_thuoc_id">
                                                            @foreach ($kichthuocs as $k => $v)
                                                                <option value="{{ $v->id }}">
                                                                    {{ $v->ten_kich_thuoc }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="color" class="form-control"
                                                            v-model="v.mau_sac_id">
                                                            @foreach ($mausacs as $k => $v)
                                                                <option value="{{ $v->id }}">{{ $v->ten_mau_sac }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <img v-bind:src="v.hinh_anh" alt="" class="img-thumbail">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="stock" class="form-control"
                                                            v-model="v.so_luong" required>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger mt-1"
                                                            v-on:click="RemoveOpt(k)">X</button>
                                                    </td>
                                                </tr>
                                            </template>

                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" v-on:click="TaoProDuct()">Thêm mới</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Edit Modal -->
        <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa Giày</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="">Tên giày</label>
                                            <input type="text" class="form-control" v-model="giay_edit.ten_san_pham">
                                        </div>

                                        <div class="mb-3">
                                            <label for="">Gia</label>
                                            <input type="number" class="form-control" v-model="giay_edit.gia">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Hãng giày</label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay_edit.thuong_hieu_id">
                                                @foreach ($thuonghieus as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_thuong_hieu }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Giới tính</label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay_edit.gioi_tinh_id">
                                                <option value="0">Nam</option>
                                                <option value="1">Nữ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="">Hình ảnh</label>
                                            <input type="text" class="form-control" v-model="giay_edit.hinh_anh">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Danh mục</label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay_edit.danh_muc_id">
                                                @foreach ($danhmucs as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_danh_muc }}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="">Tình trạng</label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay_edit.tinh_trang">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Khóa</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="">Mô tả</label>
                                    <textarea name="mota_edit" rows="30" cols="10"></textarea>
                                </div>

                                <div class="mb-3">
                                    <div id="variants" class="row">
                                        <div class="variant col">
                                            <label for="size">Kích thước:</label>
                                            <select name="size" class="form-control" v-model="opt_edit.kich_thuoc_id">
                                                @foreach ($kichthuocs as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_kich_thuoc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="variant col">
                                            <label for="color">Màu sắc:</label>
                                            <select name="color" class="form-control" v-model="opt_edit.mau_sac_id">
                                                @foreach ($mausacs as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_mau_sac }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="variant col">
                                            <label for="">Hình ảnh</label>
                                            <input type="text" class="form-control" v-model="opt_edit.hinh_anh">
                                        </div>

                                        <div class="variant col">
                                            <label for="stock">Số lượng tồn kho:</label>
                                            <input type="number" name="stock" class="form-control"
                                                v-model="opt_edit.so_luong" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-info" id="addVariant"
                                        v-on:click="PushOpt_edit(opt_edit)">Add Option</button>

                                    <template v-for="(v, k) in List_Opt_Edit">
                                        <div id="variants" class="row text-center">
                                            <div class="variant col">
                                                <label for="size">Kích thước:</label>
                                                <select name="size" class="form-control" v-model="v.kich_thuoc_id">
                                                    @foreach ($kichthuocs as $k => $v)
                                                        <option value="{{ $v->id }}">{{ $v->ten_kich_thuoc }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="variant col">
                                                <label for="color">Màu sắc:</label>
                                                <select name="color" class="form-control" v-model="v.mau_sac_id">
                                                    @foreach ($mausacs as $k => $v)
                                                        <option value="{{ $v->id }}">{{ $v->ten_mau_sac }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="variant col">
                                                <label for="">Hình ảnh</label>
                                                <input type="text" class="form-control" v-model="v.hinh_anh">
                                            </div>

                                            <div class="variant col">
                                                <label for="stock">Số lượng tồn kho:</label>
                                                <input type="number" name="stock" class="form-control"
                                                    v-model="v.so_luong" required>
                                            </div>
                                            <div class="variant col">
                                                <button class="btn btn-danger mt-3" v-on:click="RemoveOpt(k)">X</button>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" v-on:click="ProUpdate()">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- DelModal -->
        <div class="modal fade" id="DelBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Cảnh báo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                aria-label="Warning:">
                                <use xlink:href="#exclamation-triangle-fill" />
                            </svg>
                            <div>
                                Bạn có chắc muốn xóa <b>@{{ giay_del.ten_san_pham }}</b> này không ?
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" v-on:click="ProDel()">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                giay_del: {},
                giay_edit: {},
                giay: {
                    mo_ta: '',
                },
                opt: {},
                opt_edit: {},
                List_products: [],
                List_Opt: [],
                List_Opt_Edit: [],
                currentPage: 1,
                lastPage: 1,
            },
            created() {
                this.loadData();
            },
            methods: {
                TaoProDuct() {
                    this.giay.mo_ta = CKEDITOR.instances['mota'].getData();
                    var payload = {
                        'giay': this.giay,
                        'options': this.List_Opt,
                    }
                    axios
                        .post("{{ Route('ProductCreate') }}", payload)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                $('#ThemMoiModal').modal('hide');
                                this.loadData();
                            } else {
                                toastr.error(res.data.message, 'lỗi');
                            }
                        });
                },

                RemoveOpt(index) {
                    this.List_Opt.splice(index, 1);
                },

                PushOpt(value) {
                    var opt2 = Object.assign({}, this.opt);
                    this.List_Opt.push(opt2);
                },

                PushOpt_edit(value) {
                    var opt2 = Object.assign({}, this.opt_edit);
                    this.List_Opt_Edit.push(opt2);
                },

                doiStatus(payload) {
                    axios
                        .post('{{ Route('ProductStatus') }}', payload)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                this.loadData();
                            } else
                                toastr.error(res.data.message);
                        });
                },

                giayEdit(payload) {
                    this.giay_edit = Object.assign({}, payload);
                    CKEDITOR.instances.mota_edit.setData(payload.mo_ta);
                    axios
                        .post('{{ Route('OptData') }}', payload)
                        .then((res) => {
                            this.List_Opt_Edit = res.data.data;
                        });
                },

                ProUpdate() {
                    this.giay_edit.mo_ta = CKEDITOR.instances['mota_edit'].getData();
                    var payload = {
                        'product': this.giay_edit,
                        'options': this.List_Opt_Edit,
                    };
                    axios
                        .post('{{ Route('ProductUpdate') }}', payload)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                $('#EditModal').modal('hide');
                                this.loadData();
                            } else
                                toastr.error(res.data.message);
                        });
                },

                ProDel() {
                    axios
                        .post('{{ Route('ProductDestroy') }}', this.giay_del)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                $('#DelBackdrop').modal('hide');
                                this.loadData();
                            } else
                                toastr.error(res.data.message);
                        });
                },

                convertToVND(value) {
                    const formatter = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND',
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0,
                    });

                    return formatter.format(value);
                },


                loadData(page = 1) {
                    axios
                        .post('{{ Route('ProductData') }}', {page: page})
                        .then((res) => {
                            this.List_products = res.data.data.data;
                            this.currentPage = res.data.data.current_page;
                            this.lastPage = res.data.data.last_page;
                        });
                },

                changePage(page) {
                    console.log(page);
                    this.loadData(page);
                },
            },
        });
    </script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('mota');
            CKEDITOR.replace('mota_edit');
        });
    </script>
@endsection
