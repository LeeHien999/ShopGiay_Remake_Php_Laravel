@extends('client.share.master');
@section('noi_dung')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="index.html">Home</a></span> / <span>Shopping Cart</span></p>
                </div>
            </div>
        </div>
    </div>


    <div class="colorlib-product" id="app6">
        <div class="container">
            <div class="row row-pb-lg">
                <div class="col-md-10 offset-md-1">
                    <div class="process-wrap">
                        <div class="process text-center active">
                            <p><span>01</span></p>
                            <h3>Shopping Cart</h3>
                        </div>
                        <div class="process text-center">
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
            <div class="row row-pb-lg">
                <div class="col-md-12">
                    <div class="product-name d-flex">
                        <div class="one-forth text-left px-4">
                            <span>Product Details</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>Price</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>Quantity</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>Total</span>
                        </div>
                        <div class="one-eight text-center px-4">
                            <span>Remove</span>
                        </div>
                    </div>
                    <template v-for="(v, k) in List_prod">
                        <div class="product-cart d-flex">
                            <div class="one-forth">
                                <div class="product-img">
                                    <img v-bind:src="v.hinh_anh" class="rounded" style="max-height: 100px">
                                </div>
                                <div class="display-tc">
                                    <h3>@{{ v.ten_san_pham }}</h3>
                                    <h3>@{{ v.ten_mau_sac }} - @{{ v.ten_kich_thuoc }}</h3>
                                </div>
                            </div>

                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <span class="price">@{{ formatNumber(v.gia) }} VND</span>
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <input type="text" id="quantity" name="quantity"
                                        class="form-control input-number text-center" v-bind:value="v.so_luong"
                                        min="1" max="100">
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <span class="number">@{{ formatNumber(sumOne(v.gia, v.so_luong)) }} VND</span>
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <a href="#" class="closed"></a>
                                </div>
                            </div>
                        </div>
                    </template>

                </div>
            </div>
            <div class="row row-pb-lg">
                <div class="col-md-12">
                    <div class="total-wrap">
                        <div class="row">
                            <div class="col-sm-8">
                                <form action="#">
                                    <div class="row form-group">
                                        <div class="col-sm-9">
                                            <input type="text" name="quantity" class="form-control input-number"
                                                placeholder="Your Coupon Number...">
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" class="btn btn-primary text-white" v-on:click="checkOut()">Thanh toán</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-4 text-center">
                                <div class="total">
                                    <div class="sub">
                                        <p><span>Subtotal:</span> <span>@{{formatNumber(tong)}} VND</span></p>
                                        <p><span>Delivery:</span> <span>$0.00</span></p>
                                        <p><span>Discount:</span> <span>@{{formatNumber(phiship)}} VND</span></p>
                                    </div>
                                    <div class="grand-total">
                                        <p><span><strong>Total:</strong></span> <span>@{{formatNumber(tong+phiship)}} VND</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                    <h2>Related Products</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-lg-3 mb-4 text-center">
                    <div class="product-entry border">
                        <a href="#" class="prod-img">
                            <img src="images/item-1.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
                        </a>
                        <div class="desc">
                            <h2><a href="#">Women's Boots Shoes Maca</a></h2>
                            <span class="price">$139.00</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 mb-4 text-center">
                    <div class="product-entry border">
                        <a href="#" class="prod-img">
                            <img src="images/item-2.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
                        </a>
                        <div class="desc">
                            <h2><a href="#">Women's Minam Meaghan</a></h2>
                            <span class="price">$139.00</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 mb-4 text-center">
                    <div class="product-entry border">
                        <a href="#" class="prod-img">
                            <img src="images/item-3.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
                        </a>
                        <div class="desc">
                            <h2><a href="#">Men's Taja Commissioner</a></h2>
                            <span class="price">$139.00</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 mb-4 text-center">
                    <div class="product-entry border">
                        <a href="#" class="prod-img">
                            <img src="images/item-4.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
                        </a>
                        <div class="desc">
                            <h2><a href="#">Russ Men's Sneakers</a></h2>
                            <span class="price">$139.00</span>
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

                },

                checkOut()
                {
                    axios
                        .post('{{Route('CreateCheckOutCode')}}')
                        .then((res) => {
                            if(res.data.status == 1) {
                                window.location.href="/home/cart/check-out/" + res.data.id + "";
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }

                        });
                },

                sumOne(gia, so_luong) {
                    return gia * so_luong;
                },
                formatNumber(price) {
                    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                },


            },
        });
    </script>
@endsection
