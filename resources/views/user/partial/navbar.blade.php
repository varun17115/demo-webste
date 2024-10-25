<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary h-100 w-100" data-toggle="collapse"
                href="#navbar-vertical" style="height: 90px; padding: 0 30px;">
                <h5 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h5>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100" id="nav_bar">
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar align-middle navbar-expand-lg bg-dark navbar-dark   px-0" style="">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{ route('display_main') }}" class="nav-item nav-link">Home</a>
                        <a href="{{ route('display_shop') }}" class="nav-item nav-link">Shop</a>

                        <a href="{{ route('contact_us') }}" class="nav-item nav-link">Contact</a>
                    </div>

                    <div class="navbar-nav ml-auto py-0 d-block">
                        <a href="{{ route('show_likes_page') }}" class="btn px-0">
                            <i class="fas fa-heart text-primary"></i>
                            <span id="favourite_count"
                                class="badge text-secondary border border-secondary rounded-circle"
                                style="padding-bottom: 2px;">0</span>
                        </a>
                        <a onclick="check_cart()" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span id="products_count"
                                class="badge text-secondary border border-secondary rounded-circle"
                                style="padding-bottom: 2px;">0</span>
                        </a>
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-lg-block">
                        @if (Auth::check())
                            <a class="nav-link" onclick="return false" id="profileDropdown" href="#"
                                data-toggle="dropdown" aria-expanded="false">
                                <div class="navbar-profile d-flex">
                                    @if (Auth::user()->image)
                                        <img class="img-xs rounded-circle" style="height: 50px;width:50px"
                                            src="{{ asset('images/' . Auth::user()->image) }}" alt="">
                                    @else
                                        <img class="img-xs rounded-circle" style="height: 50px;width:50px"
                                            src="{{ asset('default.webp') }}" alt="">
                                    @endif
                                    <p style="padding-left:10px" class="mb-0 d-none d-sm-block pt-3">
                                        {{ Auth::user()->firstname }}</p>
                                    <i class="fa fa-caret-down pt-3 p-1" aria-hidden="true"></i>


                                </div>
                            </a>
                        @else
                            <a id="user_login" class="nav-item nav-link float-end">Click To Login</a>

                        @endif
                        <div class="dropdown-menu bg-dark dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="profileDropdown">
                            <h6 class="p-3 mb-0 text-primary">Profile</h6>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('manage_address') }}" class="dropdown-item d-flex preview-item ">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon rounded-circle">
                                        <i class="mdi mdi-settings text-success"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content ml-3">
                                    <p class="text-primary preview-subject mb-1">Manage Address</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('show_order') }}" class="dropdown-item d-flex preview-item ">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon rounded-circle">
                                        <i class="mdi mdi-settings text-success"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content ml-3">
                                    <p class="text-primary preview-subject mb-1">Your Orders</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout_user') }}" class="dropdown-item d-flex preview-item ">
                                <div class="preview-thumbnail text-light">
                                    <div class="preview-icon rounded-circle">
                                        <i class="mdi mdi-logout text-danger"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="text-primary preview-subject ml-3 mb-1">Log out</p>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

</div>
@include('user.modal.login_modal')
@include('user.modal.register_modal')
@push('script')
    <script>
        $(document).ready(function() {

            console.log('in')


            $.ajax({
                type: "post",
                url: "{{ route('user_get_data') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                // data: "dat",
                dataType: "json",
                success: function(response) {
                    for (let v = 0; v < response.category.length; v++) {
                        $('#nav_bar').append('<a href="{{ route('display_shop') }}?cat_arr=' + response
                            .category[v].cat_id +
                            '&brand_arr=0&filter_price=0" class="nav-item nav-link">' + response
                            .category[v].cat_name + '</a>')
                    }
                    $('#favourite_count').html(response.total)
                }

            });
            @if (Auth::check())
                if (localStorage.cart{{ Auth::user()->id }} == null) {
                    $('#products_count').html(0)
                } else {
                    if (localStorage.cart{{ Auth::user()->id }}) {
                        $('#products_count').html(JSON.parse(localStorage.cart{{ Auth::user()->id }}).products
                            .length)

                    } else {
                        $('#products_count').html(0)
                    }

                }
            @else
                if (localStorage.cart == null) {
                    $('#products_count').html(0)
                } else {
                    if (localStorage.cart) {
                        $('#products_count').html(JSON.parse(localStorage.cart).products.length)

                    } else {
                        $('#products_count').html(0)
                    }

                }
            @endif



        });
        $('#user_login').click(function(e) {
            e.preventDefault();
            $('#login_modal').modal('show')
        });

        $('.open_register_modal').click(function(e) {
            $('#login_modal').modal('hide')
            setTimeout(() => {
                $('#register_modal').modal('show')

            }, 500);
        });
        $('.open_login_modal').click(function(e) {
            $('#register_modal').modal('hide')
            setTimeout(() => {
                $('#login_modal').modal('show')

            }, 500);
        });
        $('#user_register').click(function(e) {
            e.preventDefault();
            fd = new FormData($('#register_form')[0])
            console.log('register')
            $.ajax({
                type: "post",
                url: "{{ route('register_user') }}",
                data: fd,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.errors) {

                        if (response.errors.firstname) {
                            $("#error-firstname").html("<span class=' text-primary'>" + response.errors
                                .firstname + "</span>");
                        }
                        if (response.errors.lastname) {
                            $("#error-lastname").html("<span class=' text-primary'>" + response.errors
                                .lastname + "</span>");
                        }
                        if (response.errors.email) {
                            $("#error-email").html("<span class=' text-primary'>" + response.errors
                                .email + "</span>");
                        }
                        if (response.errors.phone) {
                            $("#error-phone").html("<span class=' text-primary'>" + response.errors
                                .phone + "</span>");
                        }
                        if (response.errors.password) {
                            $("#error-pass").html("<span class=' text-primary'>" + response.errors
                                .password + "</span>");
                        }
                        if (response.errors.password_confirmation) {
                            $("#error-cpass").html("<span class=' text-primary'>" + response.errors
                                .password_confirmation + "</span>");
                        }
                    } else {
                        window.location = "{{ route('display_main') }}";
                    }
                }
            });
            console.log('register')

        });
        $('#user_login_modal').click(function(e) {
            e.preventDefault();
            fd = new FormData($('#login_form')[0])

            $.ajax({
                type: "post",
                url: "{{ route('login_user') }}",
                data: fd,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.errors) {
                        if (response.errors.email) {
                            $("#error-email-l").html("<span class=' text-primary'>" + response.errors
                                .email + "</span>");
                        }

                        if (response.errors.password) {
                            $("#error-pass-l").html("<span class=' text-primary'>" + response.errors
                                .password + "</span>");
                        }
                    } else {
                        window.location = "{{ route('display_main') }}";
                    }
                }
            });

        });
        $(' .form-control .remove-text').change(function(e) {
            // $('#login_form .form-error').html('')
        });
        $('.close-modal-btn').click(function(e) {

            $('.form-control .remove-text').val('')



        });

        function check_cart() {
            @if (Auth::check())
                if (localStorage.cart{{ Auth::user()->id }} != null) {
                    window.location.href = "{{ route('display_cart') }}"
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Your Cart Is Empty ...',
                        text: 'Add Products To See Cart ...',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('display_shop') }}"
                        }
                    })

                }
            @else
                if (localStorage.cart != null) {
                    window.location.href = "{{ route('display_cart') }}"
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Your Cart Is Empty ...',
                        text: 'Add Products To See Cart ...',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('display_shop') }}"
                        }
                    })
                }
            @endif
        }
    </script>
@endpush
