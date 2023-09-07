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
                            <th>Màu sắc</th>
                            <th>Size</th>
                            <th>Tình trạng</th>
                            <th>Số lượng</th>
                            <th>Action</th>
                        </thead>
                        <tbody v-for="(v, k) in List_Giay">
                            <td>@{{ k }}</td>
                            <td>@{{ v.Ten_San_Pham }}</td>
                            <td><img v-bind:src="v.Hinh_Anh" class="product-img-2" alt="product img"></td>
                            <td>@{{ v.ten_thuong_hieu }}</td>
                            <td>@{{ convertToVND(v.Gia) }}</td>
                            <td>
                                <img v-bind:src="v.hinh_anh" alt="" class="img img-thumbail rounded"
                                    style="max-height: 40px;">
                            </td>
                            <td>@{{ v.ten_kich_thuoc }}</td>
                            <td>
                                <button class="badge bg-gradient-quepal text-white shadow-sm w-100" v-if="v.Tinh_Trang == 1"
                                    v-on:click="doiStatus(v)">Hiển thị</button>
                                <button class="badge bg-gradient-bloody text-white shadow-sm w-100" v-else
                                    v-on:click="doiStatus(v)">Ẩn</button>
                            </td>
                            <td>@{{ v.So_Luong }}</td>
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
                                            <input type="text" class="form-control" v-model="giay.Ten_San_Pham">
                                        </div>

                                        <div class="mb-3">
                                            <label for="">Gia</label>
                                            <input type="number" class="form-control" v-model="giay.Gia">
                                        </div>

                                        <div class="mb-3">
                                            <label for="">Số lượng</label>
                                            <input type="number" class="form-control" v-model="giay.So_Luong">
                                        </div>

                                        <div class="mb-3">
                                            <label for="">Kích thước:

                                            </label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay.Size_Id">
                                                @foreach ($kichthuocs as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_kich_thuoc }}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="mb-3">
                                            <label for="">Màu sắc</label>
                                            <br />
                                            <select name="" id="" class="form-control"
                                                v-model="giay.Mau_Sac_Id">
                                                @foreach ($mausacs as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_mau_sac }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="">Hình ảnh</label>
                                            <input type="text" class="form-control" v-model="giay.Hinh_Anh">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Danh mục</label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay.Danh_Muc_Id">
                                                @foreach ($danhmucs as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_danh_muc }}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Hãng giày</label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay.Thuong_Hieu_Id">
                                                @foreach ($thuonghieus as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_thuong_hieu }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Giới tính</label>
                                            <select name="" id="" class="form-control" v-model="giay.Gioi_Tinh">
                                                <option value="0">Nam</option>
                                                <option value="1">Nữ</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Tình trạng</label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay.Tinh_Trang">
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


                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" v-on:click="taogiay()">Thêm mới</button>
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
                                            <input type="text" class="form-control" v-model="giay_edit.Ten_San_Pham">
                                        </div>

                                        <div class="mb-3">
                                            <label for="">Gia</label>
                                            <input type="number" class="form-control" v-model="giay_edit.Gia">
                                        </div>

                                        <div class="mb-3">
                                            <label for="">So Luong</label>
                                            <input type="number" class="form-control" v-model="giay_edit.So_Luong">
                                        </div>

                                        <div class="mb-3">
                                            <label for="">Kích thước:

                                            </label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay_edit.Size_Id">
                                                @foreach ($kichthuocs as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_kich_thuoc }}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="mb-3">
                                            <label for="">Màu sắc</label>
                                            <br />
                                            <select name="" id="" class="form-control"
                                                v-model="giay_edit.Mau_Sac_Id">
                                                @foreach ($mausacs as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_mau_sac }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="">Hình ảnh</label>
                                            <input type="text" class="form-control" v-model="giay_edit.Hinh_Anh">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Danh mục</label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay_edit.Danh_Muc_Id">
                                                @foreach ($danhmucs as $k => $v)
                                                    <option value="{{ $v->id }}">{{ $v->ten_danh_muc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Hãng giày</label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay_edit.Thuong_Hieu_Id">
                                            @foreach ($thuonghieus as $k => $v)
                                                <option value="{{ $v->id }}">{{ $v->ten_thuong_hieu }}</option>
                                            @endforeach                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Giới tính</label>
                                            <select name="" id="" class="form-control" v-model="giay_edit.Gioi_Tinh">
                                                <option value="0">Nam</option>
                                                <option value="1">Nữ</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Tình trạng</label>
                                            <select name="" id="" class="form-control"
                                                v-model="giay_edit.Tinh_Trang">
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


                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" v-on:click="giayUpdate()">Cập nhật</button>
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
                                Bạn có chắc muốn xóa <b>@{{ giay_del.Ten_San_Pham }}</b> này không ?
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" v-on:click="giayDel()">Xóa</button>
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
                    Mo_Ta: '',
                },
                List_Giay: [],

            },
            created() {
                this.loadData();
            },
            methods: {
                taogiay() {
                    this.giay.Mo_Ta = CKEDITOR.instances['mota'].getData();

                    axios
                        .post("{{ Route('GiayCreate') }}", this.giay)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                $('#ThemMoiModal').modal('hide');
                                this.loadData();
                            }

                        });
                },

                doiStatus(payload) {
                    axios
                        .post('{{ Route('GiayStatus') }}', payload)
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
                    CKEDITOR.instances.mota_edit.setData(payload.Mo_Ta);
                },

                giayUpdate() {
                    this.giay_edit.Mo_Ta = CKEDITOR.instances['mota_edit'].getData();
                    axios
                        .post('{{ Route('GiayUpdate') }}', this.giay_edit)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                $('#EditModal').modal('hide');
                                this.loadData();
                            } else
                                toastr.error(res.data.message);
                        });
                },

                giayDel() {
                    axios
                        .post('{{ Route('GiayDestroy') }}', this.giay_del)
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
                        .post('{{ Route('GiayData') }}')
                        .then((res) => {
                            this.List_Giay = res.data.data;
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
