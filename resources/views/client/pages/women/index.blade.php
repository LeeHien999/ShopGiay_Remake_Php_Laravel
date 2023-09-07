@extends('client.share.master');
@section('noi_dung')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="/">Home</a></span> / <span>Women</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="breadcrumbs-two">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs-img" style="background-image: url(/assets_client/images/cover-img-1.jpg);">
                        <h2>women's</h2>
                    </div>
                    <div class="menu text-center">
                        <p><a href="#">New Arrivals</a> <a href="#">Best Sellers</a> <a href="#">Extended
                                Widths</a> <a href="#">Sale</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="colorlib-product" id="app2">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                    <h2>View All Products</h2>
                </div>
            </div>
            <div class="row row-pb-md">
                <div class="col-12">
                    <div class="toolbar-mode">
                        <div>
                            <div>
                                <label><h5>Sắp xếp theo:</h5></label>
                                <select class="form"  id="sortSelect" v-model="SortProd" v-on:change="SortProduct()">
                                    <option value="">Tùy chọn</option>
                                    <option value="PRICEASC">
                                        Sắp xếp theo giá: từ thấp
                                        đến cao
                                    </option>
                                    <option value="PRICEDESC">
                                        Sắp xếp theo giá: từ cao
                                        đến thấp
                                    </option>
                                    <option value="NAMEAZ">
                                        Sắp xếp theo alphabetically,
                                        A-Z
                                    </option>
                                    <option value="NAMEZA">
                                        Sắp xếp theo
                                        alphabetically: Z-A
                                    </option>
                                    <option value="DATENEW">
                                        Sắp xếp theo ngày: từ cũ
                                        đến mới
                                    </option>
                                    <option value="DATEOLD">
                                        Sắp xếp theo ngày: từ mới
                                        đến cũ
                                    </option>
                                    <option value="BESTSALE">
                                        Sắp xếp theo bán chạy nhất
                                    </option>
                                </select>
                                <i class="mwc-icon-angle-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <template v-for="(v, k) in List_products.data">
                    <div class="col-md-3 col-lg-3 mb-4 text-center">
                        <div class="product-entry border">
                            <a v-bind:href="'/home/product-detail/' + v.id" class="prod-img">
                                <img v-bind:src="v.hinh_anh" class="img-fluid" alt="Free html5 bootstrap 4 template">
                            </a>
                            <div class="desc">
                                <h2><a v-bind:href="'/home/product-detail/' + v.id">@{{ v.ten_san_pham }}</a></h2>
                                <span class="price">@{{formatNumber(v.gia)}} VND</span>
                            </div>
                        </div>
                    </div>
                </template>
                <div class="w-100"></div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="block-27">
                        <ul>
                            <!-- Nút "Trang trước" -->
                            <li v-if="currentPage > 1">
                                <a href="#" @click.prevent="changePage(currentPage - 1)">
                                    <<
                                </a>
                            </li>

                            <!-- Hiển thị các trang -->
                            <li v-for="page in lastPage" :key="page" :class="{ 'active': currentPage === page }">
                                <span v-if="currentPage === page">@{{ page }}</span>
                                <a v-else href="#" @click.prevent="changePage(page)">@{{ page }}</a>
                            </li>

                            <!-- Nút "Trang tiếp theo" -->
                            <li v-if="currentPage < lastPage">
                                <a href="#" @click.prevent="changePage(currentPage + 1)">
                                    >>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app2',
            data: {
                List_products: {},
                currentPage: 1,
                lastPage: 1,
                SortProd : '',
            },
            created() {
                this.loadData();
            },
            methods: {
                loadData(page = 1) { // Truyền thêm trang (mặc định là 1)
                    axios
                        .post('{{ Route('womenData') }}', {
                            page: page
                        })
                        .then((res) => {
                            this.List_products = res.data.data; // Lấy danh sách sản phẩm
                            this.currentPage = res.data.data.current_page; // Lấy trang hiện tại
                            this.lastPage = res.data.data.last_page; // Lấy tổng số trang
                        });
                },

                SortProduct()
                {
                    payload = {
                        'select' : this.SortProd,
                        'data'   : this.List_products,
                    };

                    axios
                        .post('{{Route('sortProducts')}}', payload)
                        .then((res) => {
                            this.List_products.data = res.data.data;
                        });

                },
                formatNumber(price)
                {
                    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                },
                changePage(page) {
                    this.loadData(page);
                },
            },
        });
    </script>
@endsection
