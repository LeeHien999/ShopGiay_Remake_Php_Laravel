@extends('admin.share.master')
@section('noi_dung')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <h6 class="mb-0 text-uppercase">DANH SÁCH MÀU</h6>
        </div>
    </div>
    <hr />
    <div class="row" id="app">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="">Tên màu</label>
                            <input type="text" class="form-control" v-model="mau_sac.ten_mau_sac">
                        </div>
                        <div class="mb-3">
                            <label for="">Hình ảnh</label>
                            <input type="text" class="form-control" v-model="mau_sac.hinh_anh">
                        </div>
                        <div class="mb-3">
                            <label for="">Trạng thái</label>
                            <select name="" id="" class="form-control" v-model="mau_sac.trang_thai">
                                <option value="1">Hiển thị</option>
                                <option value="0">Khóa</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-primary" v-on:click="taoMau()">Thêm mới</button>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h6>Danh sách màu</h6>

                </div>

                <div class="card-body">
                    <table class="table table-responsive table-bordered text-center align-middle">
                        <thead>
                            <th>#</th>
                            <th>Tên Màu</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </thead>
                        <tbody v-for="(v, k) in List_Color">
                            <td>@{{ k }}</td>
                            <td>@{{ v.ten_mau_sac }}</td>
                            <td><img v-bind:src="v.hinh_anh" class="img-thumbail"
                                    style="max-height: 50px; border-radius: 10px; border: none"></td>
                            <td>
                                <button class="badge bg-gradient-quepal text-white shadow-sm w-100" v-if="v.trang_thai == 1"
                                    v-on:click="doiStatus(v)">Hiển thị</button>
                                <button class="badge bg-gradient-bloody text-white shadow-sm w-100" v-else
                                    v-on:click="doiStatus(v)">Ẩn</button>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                                        data-bs-target="#EditModal" v-on:click="mau_sac_edit = Object.assign({}, v);"><i
                                            class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-dark"
                                        v-on:click="mau_sac_del = Object.assign({}, v)" data-bs-toggle="modal"
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
        <!--Edit Modal -->
        <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit màu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="">Tên màu</label>
                            <input type="text" class="form-control" v-model="mau_sac_edit.ten_mau_sac">
                        </div>
                        <div class="mb-3">
                            <label for="">Hình ảnh</label>
                            <input type="text" class="form-control" v-model="mau_sac_edit.hinh_anh">
                        </div>
                        <div class="mb-3">
                            <label for="">Tình trạng</label>
                            <select name="" id="" class="form-control" v-model="mau_sac_edit.trang_thai">
                                <option value="1">Hiển thị</option>
                                <option value="0">Khóa</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" v-on:click="mauSacUpdate()">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>

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
                                Bạn có chắc muốn xóa <b>@{{ mau_sac_del.ten_mau_sac }}</b> này không ?
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" v-on:click="MauSacDel()">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                mau_sac_del: {},
                mau_sac_edit: {},
                mau_sac: {},
                List_Color: [],

            },
            created() {
                this.mau_sac.trang_thai = 1;
                this.loadData();
            },
            methods: {
                taoMau() {
                    if(!this.mau_sac.ten_mau_sac || !this.mau_sac.hinh_anh)
                    {
                        toastr.error("Vui lòng điền đầy đủ thông tin !!", 'Cảnh báo');
                        return;
                    }
                    axios
                        .post("{{ Route('MauSacCreate') }}", this.mau_sac)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                this.loadData();
                            } else {
                                toastr.error(res.data.message);
                            }

                        });
                },

                doiStatus(payload) {
                    axios
                        .post('{{ Route('MauSacStatus') }}', payload)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                this.loadData();
                            } else
                                toastr.error(res.data.message);
                        });
                },
                mauSacUpdate() {
                    if(!this.mau_sac_edit.ten_mau_sac || !this.mau_sac_edit.hinh_anh)
                    {
                        toastr.error("Vui lòng điền đầy đủ thông tin !!", 'Cảnh báo');
                        return;
                    }
                    axios
                        .post('{{ Route('MauSacUpdate') }}', this.mau_sac_edit)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                $('#EditModal').modal('hide');
                                this.loadData();
                            } else
                                toastr.error(res.data.message);
                        });
                },

                MauSacDel() {
                    axios
                        .post('{{ Route('MauSacDestroy') }}', this.mau_sac_del)
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
                        .post('{{ Route('MauSacData') }}')
                        .then((res) => {
                            this.List_Color = res.data.data;
                        });
                }
            },
        });
    </script>
@endsection
