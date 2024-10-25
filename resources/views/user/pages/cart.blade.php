@extends('user.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('display_main') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light text-start table-borderless table-hover  mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="cart_body">

                    </tbody>
                </table>
            </div>

            <div class="col-lg-4">

                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="total"></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">GST</h6>
                            <h6 id="gst" class="font-weight-medium"></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="final"></h5>
                        </div>
                        <button
                            @if (Auth::check()) onclick="window.location.href=`{{ route('display_checkout') }}`" 
                        @else
                            onclick="Swal.fire({icon:'warning',title:'Login To Proceed Ahead ...'})" @endif
                            class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        var quantity, price, total
        quantity_arr = []
        $(document).ready(function() {
            @if (Auth::check())

                id = {{ Auth::user()->id }}
            @endif
            @if (Auth::check())
                id_arr = Object.values(JSON.parse(localStorage.cart{{ Auth::user()->id }}).products.map(o => ({
                    product_id: o.product_id
                }).product_id))
                products = JSON.parse(localStorage.cart{{ Auth::user()->id }}).products
            @else
                id_arr = Object.values(JSON.parse(localStorage.cart).products.map(o => ({
                    product_id: o.product_id
                }).product_id))
                products = JSON.parse(localStorage.cart).products
            @endif
            total = 0
            gst = 0
            final = 0
            // console.log(typeof id_arr[0])
            $.ajax({
                type: "post",
                url: "{{ route('cart_details') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                data: {
                    data: JSON.stringify(id_arr)
                },
                dataType: "json",
                success: function(response) {
                    for (let p = 0; p < response.data.length; p++) {

                        if (response.data[p].prod_quantity == 0) {
                            str = 'Out Of Stock'
                        } else {
                            actual_qty = products.find(item => item.product_id == response.data[p]
                                .prod_id).quantity
                            id = products.find(item => item.product_id == response.data[p].prod_id)
                                .product_id

                            if (response.data[p].prod_quantity < actual_qty) {

                                // console.log(products)

                                counter = response.data[p].prod_quantity
                                // actual_qty = response.data[p].prod_quantity 
                                products = JSON.parse(localStorage.cart{{ Auth::user()->id }}).products

                                products.find(item => item.product_id == response.data[p].prod_id)
                                    .quantity = response.data[p].prod_quantity
                                var data = {
                                    products: products
                                }
                                console.log('Total Products')
                                console.log(products)

                                @if (Auth::check())
                                    localStorage.setItem('cart{{ Auth::user()->id }}', JSON.stringify(
                                        data))
                                @else
                                    localStorage.setItem('cart', JSON.stringify(data))
                                @endif

                            } else {
                                counter = actual_qty
                            }
                            quantity_arr.push({
                                product_id: response.data[p].prod_id,
                                quantity: response.data[p].prod_quantity
                            })

                            total += products.find(item => item.product_id == response.data[p].prod_id)
                                .quantity * response.data[p].prod_price

                            str =
                                `<div class="input-group-btn"><button onclick="change_quantity('minus',` +
                                response.data[p].prod_id + `,this,` + response.data[p].prod_price +
                                `)"class="btn btn-primary btn-minus"><i class="fa p-1 fa-minus"></i></button></div><input  id="counter" type="number" class=" w-10 form-control remove-text bg-secondary border-0 text-center" value="` +
                                counter +
                                `"><div class="input-group-btn"><button onclick="change_quantity('plus',` +
                                response.data[p].prod_id + `,this,` + response.data[p].prod_price +
                                `)" class="btn btn-primary plus btn-plus"><i class="fa p-1 fa-plus"></i></button></div></div>`
                        }

                        $('#cart_body').append(
                            `<tr><td class="align-middle"><img src="{{ url('products') }}/` +
                            response.data[p].prod_image + `" alt="" style="width: 50px;">` +
                            response.data[p].prod_name + `</td><td class="align-middle">₹` +
                            response.data[p].prod_price +
                            `</td><td id="stock" class="align-middle"><div class="input-group quantity mr-3" style="width: 150px;">` +
                            str + `  </td>
                            
                            <td class="total align-middle">` + products.find(item => item.product_id == response.data[
                                p].prod_id).quantity * response.data[p].prod_price +
                            `</td><td class="align-middle"><button onclick="delete_product(` +
                            response.data[p].prod_id +
                            `,this)" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td></tr>`
                            )



                    }
                    gst_percent = parseInt(gst_percent)
                    console.log(gst_percent)
                    gst += total * (gst_percent / 100)

                    final = total + gst
                    $('#total').text('₹ ' + total)
                    $('#gst').text('₹ ' + Math.ceil(gst))
                    $('#final').text('₹ ' + Math.ceil(final))
                    @if (Auth::check())

                        var data = {
                            products: JSON.parse(localStorage.cart{{ Auth::user()->id }}).products,

                        }
                        localStorage.setItem('cart{{ Auth::user()->id }}', JSON.stringify(data))
                        $('#products_count').html(JSON.parse(localStorage.cart{{ Auth::user()->id }})
                            .products.length)
                    @else
                        var data = {
                            products: JSON.parse(localStorage.cart).products,

                        }
                        localStorage.setItem('cart', JSON.stringify(data))
                        $('#products_count').html(JSON.parse(localStorage.cart).products.length)
                    @endif
                    // console.log(quantity_arr)
                }
            });


        })

        function change_quantity(operation, id, elem, price) {
            console.log(total)
            @if (Auth::check())
                products = JSON.parse(localStorage.cart{{ Auth::user()->id }}).products
            @else
                products = JSON.parse(localStorage.cart).products
            @endif
            console.log(id)
            if (operation == 'plus') {
                console.log('plus')

                total_qty = quantity_arr.find(item => item.product_id == id).quantity
                quantity = products.find(item => item.product_id == id).quantity
                if (total_qty <= quantity) {
                    console.log('check')
                    Swal.fire({
                        title: 'Out of Stock',
                        text: "Sorry ! Currently We Have Limited Stock Of This Product",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'

                    })
                } else {

                    products.find(item => item.product_id == id).quantity += 1

                    total += price
                    gst += price * (gst_percent / 100)
                    final = total + gst
                    var data = {
                        products: products,

                    }
                    $(elem).parent().parent().children().next().val(parseInt($(elem).parent().parent().children().next()
                        .val()) + 1)
                        quantity = $(elem).parent().parent().children().next().val()
                    @if (Auth::check())
                        localStorage.setItem('cart{{ Auth::user()->id }}', JSON.stringify(data))
                    @else
                        
                        localStorage.setItem('cart', JSON.stringify(data))
                    @endif
                }

            } else if (operation == 'minus') {
                if ($(elem).parent().parent().children().next().val() != 1) {
                    console.log('minus')
                    products.find(item => item.product_id == id).quantity -= 1
                    console.log(data)
                    total -= price
                    gst -= price * (gst_percent / 100)
                    final = total + gst
                    var data = {
                        products: products,

                    }
                    $(elem).parent().parent().children().next().val(parseInt($(elem).parent().parent().children().next()
                        .val()) - 1)
                    quantity = $(elem).parent().parent().children().next().val()
                    @if (Auth::check())

                        localStorage.setItem('cart{{ Auth::user()->id }}', JSON.stringify(data))
                    @else
                        
                        localStorage.setItem('cart', JSON.stringify(data))
                    @endif
                }
            }
            $('#total').text('₹ ' + total)
            $('#gst').text('₹ ' + Math.ceil(gst))
            $('#final').text('₹ ' + Math.ceil(final))
            $(elem).parent().parent().parent().parent().children().next().next().next().first().html('₹' + parseInt(
                quantity) * parseInt(price))
            @if (Auth::check())

                $('#products_count').html(JSON.parse(localStorage.cart{{ Auth::user()->id }}).products.length)
            @else
                $('#products_count').html(JSON.parse(localStorage.cart).products.length)
            @endif
        }

        function delete_product(id, elem) {
            console.log(id)

            @if (Auth::check())
                products = JSON.parse(localStorage.cart{{ Auth::user()->id }}).products
            @else
                products = JSON.parse(localStorage.cart).products
            @endif

            index = products.find(item => item.product_id == id)
            products = products.filter(function(item) {
                return item.product_id !== id
            })
            var data = {
                products: products
            }
            @if (Auth::check())

                localStorage.setItem('cart{{ Auth::user()->id }}', JSON.stringify(data))
            @else
               
                localStorage.setItem('cart', JSON.stringify(data))
            @endif
            $(elem).parent().parent().remove()

            // console.log(products)
            @if (Auth::check())

                $('#products_count').html(JSON.parse(localStorage.cart{{ Auth::user()->id }}).products.length)
            @else
                $('#products_count').html(JSON.parse(localStorage.cart).products.length)
            @endif
        }
        $('.btn-minus').click(function(e) {
            e.preventDefault();
            console.log($('#counter').val())
            if ($('#counter').val() == 0) {
                $('#counter').val(1)

            }
        });
    </script>
@endpush
