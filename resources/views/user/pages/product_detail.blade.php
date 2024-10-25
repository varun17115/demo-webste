@extends('user.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('display_main') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" id="product_image" src="" alt="Image">
                        </div>

                    </div>

                </div>
                <img src="" id="product_image">
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3 id="prod_name">Product Name Goes Here</h3>

                    <h3 id="prod_price" class="font-weight-semi-bold mb-4">150.00</h3>
                    <p id="prod_desc" class="mb-4"></p>

                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Colors:</strong>
                        <form>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-1" name="color">
                                <label class="custom-control-label" for="color-1">Black</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-2" name="color">
                                <label class="custom-control-label" for="color-2">White</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-3" name="color">
                                <label class="custom-control-label" for="color-3">Red</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-4" name="color">
                                <label class="custom-control-label" for="color-4">Blue</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-5" name="color">
                                <label class="custom-control-label" for="color-5">Green</label>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex align-items-center mb-4 pt-2">

                        <button onclick="add_cart()" id="add_cart" class="btn btn-primary px-3"><i
                                class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam
                                invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod
                                consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam.
                                Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos
                                dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod
                                nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt
                                tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <p>Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor
                                consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita
                                clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum.
                                Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.</p>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Additional Information</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam
                                invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod
                                consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam.
                                Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos
                                dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod
                                nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt
                                tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-center text-uppercase mx-xl-5 mb-4"><span
                class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel owl-theme vendor-carousel ">
                    @foreach ($data as $data)
                        <div class="product-item align-center bg-light">
                            <div style="max-height: 195px;max-width:195px"
                                class="product-img position-relative overflow-hidden">
                                <img style="height:195px;width:195px" class="img-fluid "
                                    src="{{ url('products') }}/{{ $data->prod_image }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('show_product') }}?id={{ $data->prod_id }}"><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a onclick="like_product('{{ $data->prod_id }}',this)"
                                        @if (Auth::check()) 
                                            @if ($data->isliked == 'true')  
                                                class="btn btn-outline-dark text-danger btn-square laal-dil" 
                                            @else
                                                class="btn btn-outline-dark btn-square" 
                                            @endif
                                        @else class="btn btn-outline-dark btn-square" @endif
                                        ><i class="fa fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $data->prod_name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $data->prod_price }}</h5>
                                    <h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {});
        var product_id = null,
            product_price = null,
            product_qty = null
        $.ajax({
            type: "post",
            url: "{{ route('get_product_detail') }}",
            data: {
                "id": "{{ $_REQUEST['id'] }}"
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },

            dataType: "json",
            success: function(response) {
                $('#product_image').attr('src', '{{ url('products') }}/' + response.data[0].prod_image + '')
                $('#prod_name').html(response.data[0].prod_name)
                $('#prod_price').html("₹ " + response.data[0].prod_price)
                $('#prod_desc').html(response.data[0].prod_description)
                product_id = response.data[0].prod_id
                product_price = response.data[0].prod_price
                product_qty = response.data[0].prod_quantity
                $('#product_image').ezPlus({
                    cursor: 'pointer',
                    galleryActiveClass: "active",
                    imageCrossfade: true,
                    lensColour: '#FFD333',
                    lensShape: 'round',
                    // lensSize: 600,
                    zoomWindowWidth: 400,
                    zoomWindowHeight: 400,
                    zoomLevel: 1,
                    zoomType: 'window',
                    zoomWindowBgColour: '#fff',
                    borderColour: 'yellowgreen',
                    borderSize: 2,
                })

            }

        });

        $('#add_cart').click(function(e) {
            e.preventDefault();
            // console.log(product_qty)
            @if (Auth::check())
                products = JSON.parse(localStorage.cart{{ Auth::user()->id }}).products
            @else
                products = JSON.parse(localStorage.cart).products
            @endif
            if (products.find(item => item.product_id === product_id)) {
                qty = products.find(item => item.product_id === product_id).quantity
            }


            console.log(qty)
            if (qty > product_qty) {
                // console.log('Out of Stock')
                Swal.fire({
                    title: 'Out of Stock',
                    text: "Sorry ! Currently We Have Limited Stock Of This Product",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'

                })
            }

        });

        function add_cart() {
            product_array = []
            quantity_array = []
            // console.log('USer Logined')
            var data = {
                products: [{
                    product_id: product_id,
                    quantity: 1
                }]
            }
            @if (Auth::check())
                if (localStorage.cart == null && localStorage.cart{{ Auth::user()->id }} == null) {
                    console.log('if')
                    localStorage.setItem('cart{{ Auth::user()->id }}', JSON.stringify(data))
                } else {

                    products = JSON.parse(localStorage.cart{{ Auth::user()->id }}).products
                }
            @else
                console.log('Login')
                if (localStorage.cart == null) {

                    localStorage.setItem('cart', JSON.stringify(data))

                } else {

                    products = JSON.parse(localStorage.cart).products
                }
            @endif
            if (products.find(item => item.product_id === product_id)) {
                qty = products.find(item => item.product_id === product_id).quantity
                console.log('Found')

                if (qty >= product_qty) {
                    Swal.fire({
                        title: 'Out of Stock',
                        text: "Sorry ! Currently We Have Limited Stock Of This Product",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'

                    })
                } else {
                    index = products.find(item => item.product_id == product_id).quantity
                    console.log(index)

                    products.find(item => item.product_id == product_id).quantity += 1

                    console.log(data)

                }

            } else {
                products.push({
                    product_id: product_id,
                    quantity: 1
                })
                quantity_array.push(1)


            }
            var data = {
                products: products
            }
            console.log(data)


            @if (Auth::check())
                localStorage.setItem('cart{{ Auth::user()->id }}', JSON.stringify(data))
                $('#products_count').html(JSON.parse(localStorage.cart{{ Auth::user()->id }}).products.length)
                $('#counter').val(1)
            @else
                localStorage.setItem('cart', JSON.stringify(data))
                $('#products_count').html(JSON.parse(localStorage.cart).products.length)
                $('#counter').val(1)
            @endif

        }

        function like_product(id, elem) {
            @if (Auth::check())


                console.log(id)
                $.ajax({
                    type: "post",
                    url: "{{ route('like_product') }}",
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.operation == 'remove') {
                            toastr.info(response.message)
                            console.log()
                            $(elem).removeClass('text-danger')
                            $(elem).removeClass('laal-dil')

                        } else if (response.operation == 'add') {
                            toastr.success(response.message)
                            $(elem).addClass('text-danger')
                            $(elem).addClass('laal-dil')
                        }
                        $('#favourite_count').html(response.total)
                    }
                });
            @else
                Swal.fire({
                    icon: 'warning',
                    title: 'Login To Like Product',
                    text: 'Add Products To See Cart ...',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#login_modal').modal('show')

                    }
                })
            @endif
        }
    </script>
@endpush
