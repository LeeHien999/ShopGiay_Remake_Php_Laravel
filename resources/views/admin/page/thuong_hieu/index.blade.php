@extends('admin.share.master')
@section('noi_dung')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <h6 class="mb-0 text-uppercase">DANH SÁCH THƯƠNG HIỆU</h6>
        </div>
    </div>
    <hr />
    <div class="row" id="app">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="">Tên thương hiệu</label>
                            <input type="text" class="form-control" v-model="thuong_hieu.ten_thuong_hieu">
                        </div>
                        <div class="mb-3">
                            <label for="">Hình ảnh</label>
                            <input type="text" class="form-control" v-model="thuong_hieu.hinh_anh">
                        </div>
                        <div class="mb-3">
                            <label for="">Trạng thái</label>
                            <select name="" id="" class="form-control" v-model="thuong_hieu.trang_thai">
                                <option value="1">Hiển thị</option>
                                <option value="0">Khóa</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Mô tả</label>
                        <textarea name="mota" rows="30" cols="10"></textarea>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-primary" v-on:click="taoTH()">Thêm mới</button>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h6>Danh sách thương hiệu</h6>
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ThemMoiModal">Thêm mới thương
                        hiệu</button>
                </div>

                <div class="card-body">
                    <table class="table table-responsive table-bordered text-center align-middle">
                        <thead>
                            <th>#</th>
                            <th>Tên thương hiệu</th>
                            <th>Hình ảnh</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </thead>
                        <tbody v-for="(v, k) in List_TH">
                            <td>@{{ k }}</td>
                            <td>@{{ v.ten_thuong_hieu }}</td>
                            <td><img v-bind:src="v.hinh_anh" class="product-img-2" alt="product img"></td>
                            <td><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#DesciptionModal"
                                    v-on:click="mo_ta_2 = v.mo_ta"><i class="fa-regular fa-message"></i></button></td>
                            <td>
                                <button class="badge bg-gradient-quepal text-white shadow-sm w-100" v-if="v.trang_thai == 1"
                                    v-on:click="doiStatus(v)">Hiển thị</button>
                                <button class="badge bg-gradient-bloody text-white shadow-sm w-100" v-else
                                    v-on:click="doiStatus(v)">Ẩn</button>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                                        data-bs-target="#EditModal" v-on:click="ThuongHieuEdit(v)"><i
                                            class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-dark"
                                        v-on:click="thuong_hieu_del = Object.assign({}, v)" data-bs-toggle="modal"
                                        data-bs-target="#DelBackdrop"><i class="bx bx-trash-alt me-0"></i></i>
                                    </button>
                                </div>
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- description modal -->
        <div class="modal fade" id="DesciptionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mô tả</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" v-html="mo_ta_2">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
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
                                    <div class="mb-3">
                                        <label for="">Tên thương hiệu</label>
                                        <input type="text" class="form-control"
                                            v-model="thuong_hieu_edit.ten_thuong_hieu">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Hình ảnh</label>
                                        <input type="text" class="form-control" v-model="thuong_hieu_edit.hinh_anh">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Trạng thái</label>
                                        <select name="" id="" class="form-control"
                                            v-model="thuong_hieu_edit.trang_thai">
                                            <option value="1">Hiển thị</option>
                                            <option value="0">Khóa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="">Mô tả</label>
                                    <textarea name="mota_edit" rows="30" cols="10"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" v-on:click="ThuongHieuUpdate()">Cập nhật</button>
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
                                Bạn có chắc muốn xóa <b>@{{ thuong_hieu_del.ten_thuong_hieu }}</b> này không ?
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" v-on:click="ThuongHieuDel()">Xóa</button>
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
                mo_ta_2: '',
                thuong_hieu_del: {},
                thuong_hieu_edit: {},
                thuong_hieu: {
                    mo_ta: '',
                },
                List_TH: [],

            },
            created() {
                this.loadData();
            },
            methods: {
                taoTH() {
                    this.thuong_hieu.mo_ta = CKEDITOR.instances['mota'].getData();
                    if(this.IsNull(this.thuong_hieu))
                    {
                        toastr.error('vui lòng nhập đầy đủ thông tin', 'Cảnh báo');
                        return;
                    }
                    axios
                        .post("{{ Route('ThuongHieuCreate') }}", this.thuong_hieu)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                $('#ThemMoiModal').modal('hide');
                                this.loadData();
                            } else {
                                toastr.error(res.data.message);
                            }

                        });
                },

                doiStatus(payload) {
                    axios
                        .post('{{ Route('ThuongHieuStatus') }}', payload)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                this.loadData();
                            } else
                                toastr.error(res.data.message);
                        });
                },

                IsNull(payload)
                {
                    if(!payload.mo_ta || !payload.hinh_anh || !payload.ten_thuong_hieu || !payload.hinh_anh)
                        return true;
                    return false;
                },

                ThuongHieuEdit(payload) {
                    this.thuong_hieu_edit = Object.assign({}, payload);
                    CKEDITOR.instances.mota_edit.setData(payload.mo_ta);
                },

                ThuongHieuUpdate() {
                    this.thuong_hieu_edit.mo_ta = CKEDITOR.instances['mota_edit'].getData();
                    axios
                        .post('{{ Route('ThuongHieuUpdate') }}', this.thuong_hieu_edit)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                $('#EditModal').modal('hide');
                                this.loadData();
                            } else
                                toastr.error(res.data.message);
                        });
                },

                ThuongHieuDel() {
                    axios
                        .post('{{ Route('ThuongHieuDestroy') }}', this.thuong_hieu_del)
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

                loadData() {
                    axios
                        .post('{{ Route('ThuongHieuData') }}')
                        .then((res) => {
                            this.List_TH = res.data.data;
                        });
                }
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
