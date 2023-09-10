@extends('client.share.master');
@section('noi_dung')
    <div class="colorlib-product" id="app6">
        <div class="container">
            <div class="row row-pb-lg">
                <div class="col-sm-10 offset-md-1">
                    <div class="process-wrap">
                        <div class="process text-center active">
                            <p><span>01</span></p>
                            <h3>Shopping Cart</h3>
                        </div>
                        <div class="process text-center active">
                            <p><span>02</span></p>
                            <h3>Checkout</h3>
                        </div>
                        <div class="process text-center">
                            <p><span>03</span></p>
                            <h3>Order Complete</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <form method="post" class="colorlib-form">
                        <h2>Billing Details</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="companyname">Name</label>
                                    <input type="text" id="companyname" class="form-control" placeholder="ten"
                                        v-model="ten_nguoi_nhan">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Phone">Phone Number</label>
                                    <input type="text" id="zippostalcode" class="form-control" placeholder=""
                                        v-model="so_dien_thoai">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fname">Address</label>
                                    <input type="text" id="address" class="form-control"
                                        placeholder="Enter Your Address" v-model="dia_chi">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="cart-detail">
                                <h2>Cart Total</h2>
                                <ul>
                                    <li>
                                        <span>Subtotal</span> <span>@{{ formatNumber(tong) }} VND</span>
                                        <ul v-for="(v, k) in List_prod">
                                            <li><span>@{{ v.so_luong }} x @{{ v.ten_san_pham }} :
                                                    <b>@{{ v.ten_mau_sac }} - @{{ v.ten_kich_thuoc }}</b></span>
                                                <span>@{{ formatNumber(sumOne(v.gia, v.so_luong)) }} VND</span></li>
                                        </ul>
                                    </li>
                                    <li><span>Shipping</span> <span>@{{ formatNumber(phiship) }} VND</span></li>
                                    <li><span>Order Total</span> <span>@{{ formatNumber(TongVShip) }} VND</span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="w-100"></div>

                        <div class="col-md-12">
                            <div class="cart-detail">
                                <h2>Payment Method</h2>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" v-model="hinh_thuc_thanh_toan"
                                                    value="1"> Thanh Toán khi nhận hàng</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" v-model="hinh_thuc_thanh_toan"
                                                    value="2"> Chuyển khoản</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" v-model="chap_nhan_dieu_khoan" value="true"> I
                                                have read and accept the terms
                                                and conditions</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p><a v-on:click="MakeOrder()" class="btn btn-primary">Place an order</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app6',
            data: {
                List_prod: [],
                tong: 0,
                phiship: 25000,
                TongVShip: 0,
                ten_nguoi_nhan: '',
                so_dien_thoai: '',
                dia_chi: '',
                hinh_thuc_thanh_toan: '',
                chap_nhan_dieu_khoan: false,
            },
            created() {
                this.data();
                setTimeout(() => {
                    this.sumAll();
                }, 2000);
            },
            methods: {
                data() {
                    axios
                        .post('{{ Route('CartData') }}')
                        .then((res) => {
                            this.List_prod = res.data.data;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                sumAll() {
                    this.List_prod.forEach(item => {
                        this.tong += this.sumOne(item.gia, item.so_luong);
                    });

                    this.TongVShip = this.tong + this.phiship
                },

                sumOne(gia, so_luong) {
                    return gia * so_luong;
                },
                formatNumber(price) {
                    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                },

                MakeOrder() {
                    var payload = {
                        'products' : this.List_prod,
                        'info' : {
                            'ten_nguoi_nhan': this.ten_nguoi_nhan,
                            'tong_tien': this.TongVShip,
                            'dia_chi': this.dia_chi,
                            'so_dien_thoai': this.so_dien_thoai,
                            'hinh_thuc_thanh_toan': this.hinh_thuc_thanh_toan,
                        }
                    };

                    axios
                    .post('{{Route('OrderComplete')}}', payload)
                    .then((res) => {
                        if(res.data.status == 1) {
                            toastr.success(res.data.message, 'Success');
                            setTimeout(() => {
                                window.location.href="/home/cart/order-complete"
                            }, 1000);
                        } else {
                            toastr.error(res.data.message, 'Error');
                        }
                    });
                }
            },
        });
    </script>
@endsection
