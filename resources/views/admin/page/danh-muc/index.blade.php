@extends('admin.share.master')
@section('noi_dung')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <h6 class="mb-0 text-uppercase">QUẢN LÝ DANH MỤC</h6>
        </div>
    </div>
    <hr />
    <div class="row" id="app">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="">Tên danh mục</label>
                        <input type="text" class="form-control" v-model="danh_muc.ten_danh_muc">
                    </div>
                    <div class="mb-3">
                        <label for="">Hình ảnh</label>
                        <input type="text" class="form-control" v-model="danh_muc.hinh_anh">
                    </div>
                    <div class="mb-3">
                        <label for="">Trạng thái</label>
                        <select name="" id="" class="form-control"
                            v-model="danh_muc.trang_thai">
                            <option value="1">Hiển thị</option>
                            <option value="0">Khóa</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-primary" v-on:click="taoDM()">Thêm mới</button>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h6>Danh sách danh mục</h6>
                </div>

                <div class="card-body">
                    <table class="table table-responsive table-bordered text-center align-middle">
                        <thead>
                            <th>#</th>
                            <th>Tên danh mục</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </thead>
                        <tbody v-for="(v, k) in List_DM">
                            <td>@{{ k }}</td>
                            <td>@{{ v.ten_danh_muc }}</td>
                            <td><img v-bind:src="v.hinh_anh" class="product-img-2" alt="product img"></td>
                            <td>
                                <button class="badge bg-gradient-quepal text-white shadow-sm w-100" v-if="v.trang_thai == 1"
                                    v-on:click="doiStatus(v)">Hiển thị</button>
                                <button class="badge bg-gradient-bloody text-white shadow-sm w-100" v-else
                                    v-on:click="doiStatus(v)">Ẩn</button>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                                        data-bs-target="#EditModal" v-on:click="DanhMucEdit(v)"><i
                                            class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-dark"
                                        v-on:click="danh_muc_del = Object.assign({}, v)" data-bs-toggle="modal"
                                        data-bs-target="#DelBackdrop"><i class="bx bx-trash-alt me-0"></i></i>
                                    </button>
                                </div>
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--Edit Modal -->
        <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa danh mục</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="">Tên danh mục</label>
                                    <input type="text" class="form-control" v-model="danh_muc_edit.ten_danh_muc">
                                </div>
                                <div class="mb-3">
                                    <label for="">Hình ảnh</label>
                                    <input type="text" class="form-control" v-model="danh_muc_edit.hinh_anh">
                                </div>
                                <div class="mb-3">
                                    <label for="">Trạng thái</label>
                                    <select name="" id="" class="form-control"
                                        v-model="danh_muc_edit.trang_thai">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Khóa</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" v-on:click="DanhMucUpdate()">Cập nhật</button>
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
                                Bạn có chắc muốn xóa <b>@{{ danh_muc_del.ten_danh_muc }}</b> này không ?
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" v-on:click="DanhMucDel()">Xóa</button>
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
                danh_muc_del: {},
                danh_muc_edit: {},
                danh_muc: {},
                List_DM: [],

            },
            created() {
                this.danh_muc.trang_thai = 1;
                this.loadData();
            },
            methods: {
                taoDM() {
                    axios
                        .post("{{ Route('DanhMucCreate') }}", this.danh_muc)
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
                        .post('{{ Route('DanhMucStatus') }}', payload)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                this.loadData();
                            } else
                                toastr.error(res.data.message);
                        });
                },

                DanhMucEdit(payload) {
                    this.danh_muc_edit = Object.assign({}, payload);
                },

                DanhMucUpdate() {
                    axios
                        .post('{{ Route('DanhMucUpdate') }}', this.danh_muc_edit)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                $('#EditModal').modal('hide');
                                this.loadData();
                            } else
                                toastr.error(res.data.message);
                        });
                },

                DanhMucDel() {
                    axios
                        .post('{{ Route('DanhMucDestroy') }}', this.danh_muc_del)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                $('#DelBackdrop').modal('hide');
                                this.loadData();
                            } else
                                toastr.error(res.data.message);
                        });
                },

                loadData() {
                    axios
                        .post('{{ Route('DanhMucData') }}')
                        .then((res) => {
                            this.List_DM = res.data.data;
                        });
                }
            },
        });
    </script>
@endsection
