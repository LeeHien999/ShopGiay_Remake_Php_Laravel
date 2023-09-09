<nav class="colorlib-nav" role="navigation" id="app">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-md-9">
                    <div id="colorlib-logo"><a href="index.html">Footwear</a></div>
                </div>
                <div class="col-sm-5 col-md-3">
                    <form action="#" class="search-wrap">
                        <div class="form-group">
                            <input type="search" class="form-control search" placeholder="Search">
                            <button class="btn btn-primary submit-search text-center" type="submit"><i
                                    class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-left menu-1">
                    <ul>
                        <li class=""><a href="/">Home</a></li>
                        <li class="">
                            <a href="/home/men-products/">Men</a>
                        </li>
                        <li><a href="/home/women-products/">Women</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li class="has-dropdown"><a
                                href="contact.html">{{ Session::get('auth') ? Session::get('auth')->ho_va_ten : 'User' }}</a>
                            <ul class="dropdown">
                                <li><a href="product-detail.html">Product Detail</a></li>
                                <li><a href="cart.html">Shopping Cart</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="order-complete.html">Order Complete</a></li>
                                <li><a href="add-to-wishlist.html">Wishlist</a></li>
                                @if (Session::get('auth') == null)
                                    <li><a href="/home/login/">Login</a></li>
                                    <li><a href="/home/register/">Register</a></li>
                                @else
                                    <li><a href="#" v-on:click="logout()">Logout</a></li>
                                @endif

                            </ul>
                        </li>
                        <li class="cart"><a href="/home/cart/"><i class="icon-shopping-cart"></i> Cart [<span id="countofprod"></span>]</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="sale">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 offset-sm-2 text-center">
                    <div class="row">
                        <div class="owl-carousel2">
                            <div class="item">
                                <div class="col">
                                    <h3><a href="#">25% off (Almost) Everything! Use Code: Summer Sale</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col">
                                    <h3><a href="#">Our biggest sale yet 50% off all summer shoes</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<script>
    var currentUrl = window.location.pathname;
    var menuItems = document.querySelectorAll('.menu-1 ul li');
    menuItems.forEach(function(item) {
        var menuItemUrl = item.querySelector('a').getAttribute('href');
        if (currentUrl == menuItemUrl) {
            item.classList.add('active');
        }
    });

    new Vue({
        el: '#app',
        data: {
            count : 0,
        },
        created(){
            this.CountProduct();
        },
        methods: {
            logout() {
                axios
                    .post('{{ Route('clientLogout') }}')
                    .then((res) => {
                        if (res.data.status == 1) {
                            setTimeout(() => {
                                window.location.href = '/';
                            }, 500);

                        }
                    });
            },

            CountProduct()
            {
                axios
                    .post('{{Route('CountCart')}}')
                    .then((res) => {
                        this.count = res.data.data;
                        $('#countofprod').text(this.count);
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0], 'Error');
                        });
                    });
            }
        },
    });
</script>
