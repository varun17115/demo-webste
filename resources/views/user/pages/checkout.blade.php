@extends('user.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form id="address_data" action="">

            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <h5 class="section-title position-relative text-uppercase mb-3">
                        <span class="bg-secondary pr-3">Billing Address</span>
                    </h5>
                    <div class="bg-light p-30 mb-5">

                        <div class="row">

                            <div class="col-md-12 form-group">

                                <div class="form-group mb-4">
                                    <div class="custom-control custom-radio">
                                        <input checked type="radio" onclick="change_address_text('old')"
                                            class="custom-control-input " name="adddress_selection" id="old">
                                        <label class="custom-control-label" for="old">Your Addresses</label>
                                        <div id="old_address" style="display: block"></div>
                                        <div id="error_address"></div>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="custom-control custom-radio">
                                        <input type="radio"
                                            onclick="change_address_text('new')  "class="custom-control-input"
                                            name="adddress_selection" id="new">
                                        <label class="custom-control-label" for="new">Add New Address </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group form-show" style="display: none">
                                <div class="d-flex flex-row">
                                    <label class="w-50">Address</label>
                                    <span class="w-50 text-right">
                                        <button type="button" onclick="change_address_text('empty')"
                                            class="btn btn-danger rounded-sm">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </span>

                                </div>
                                <textarea name="address" class="form-control remove-text" id="address" cols="30" rows="5"></textarea>
                                <div class="error-address"></div>
                            </div>

                            <div class="col-md-6 form-group form-show" style="display: none">
                                <label>Country</label>
                                <select name="country" id="country" class="custom-select form-control remove-text">
                                    <option selected disabled>Select a Country</option>
                                    <option>United States</option>
                                    <option>India</option>
                                    <option>Russia</option>
                                    <option>Thailand</option>
                                </select>
                                <div class="error-country"></div>

                            </div>
                            <div class="col-md-6 form-group form-show" style="display: none">
                                <label>State</label>
                                <input class="form-control remove-text" id="state" name="state" type="text"
                                    placeholder="New York">
                                <div class="error-state"></div>

                            </div>
                            <div class="col-md-6 form-group form-show" style="display: none">
                                <label>City</label>
                                <input class="form-control remove-text" id="city" name="city" type="text"
                                    placeholder="New York">
                                <div class="error-city"></div>

                            </div>
                            <div class="col-md-6 form-group form-show" style="display: none">
                                <label>ZIP Code</label>
                                <input class="form-control remove-text" id="zip_code" name="zip_code" type="number"
                                    placeholder="123">
                                <div class="error-zip_code"></div>

                            </div>
                            <div class="col-md-12">
                                <button type="button" style="display: none" id="save_address"
                                    class="btn btn-block btn-primary font-weight-bold py-3 form-show">Save Address</button>

                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order
                            Total</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pt-3 pb-2">
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
                        </div>
                    </div>

                    <h5 class="section-title position-relative text-uppercase mb-3"><span
                            class="bg-secondary pr-3">Payment method</span></h5>

                    <div class=" form-group">
                        <div class="bg-light p-30 mb-5">

                            <label for="">Payment Method</label>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input remove" value="UPI"
                                        name="payment" id="UPI">
                                    <label class="custom-control-label" for="UPI">UPI</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input remove" value="cheque"
                                        name="payment" id="directcheck">
                                    <label class="custom-control-label" for="directcheck">Direct Check</label>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input remove" value="transfer"
                                        name="payment" id="banktransfer">
                                    <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input remove" checked value="cash"
                                        name="payment" id="COD">
                                    <label class="custom-control-label" for="COD">Cash On Delivery</label>
                                </div>
                            </div>
                            <div class="error-payment"></div>
                            <button type="button" style="display: block;" id="order_cart"
                                class="btn btn-block btn-primary font-weight-bold py-3 ">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('script')
    <script>
        id_array = []
        price_array = []
        subtotal = 0
        gst = 0
        total = 0
        $(document).ready(function() {
            products = JSON.parse(localStorage.cart{{ Auth::user()->id }}).products
            for (let i = 0; i < products.length; i++) {
                id_array.push(products[i].product_id)
            }

            $.ajax({
                type: "post",
                url: "{{ route('fetch_cart_products') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    id_array: JSON.stringify(id_array)
                },

                dataType: "json",
                success: function(response) {
                    products = JSON.parse(localStorage.cart{{ Auth::user()->id }}).products

                    for (let k = 0; k < response.products.length; k++) {
                        if(response.products[k].prod_quantity != 0)
                        {
                            subtotal += products.find(item => item.product_id == response.products[k]
                                .prod_id).quantity * response.products[k].prod_price
                            price_array.push(response.products[k].prod_price)
                        }
                    }

                    gst_percent = parseInt(gst_percent)
                    console.log(gst_percent)
                    gst += subtotal * (gst_percent / 100)

                    total = subtotal + Math.ceil(gst)
                    console.log(total)
                    $('#total').text('₹ ' + subtotal)
                    $('#gst').text('₹ ' + Math.ceil(gst))
                    $('#final').text('₹ ' + total)
                }
            });
            $.ajax({
                type: "post",
                url: "{{ route('fetch_old_address') }}",
                data: {
                    id: {{ Auth::user()->id }}
                },
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                success: function(response) {
                    for (let i = 0; i < response.data.length; i++) {
                        response_data = response.data
                        $('#old_address').append(
                            '<div class="form-group"><div class="custom-control custom-radio remove" ><input onclick="change_address_text(' +
                            response.data[i].address_id +
                            ')" type="radio" class="custom-control-input" name="old" id="' +
                            response.data[i].address_id +
                            '" ><label class="custom-control-label" for="' + response.data[i]
                            .address_id + '">' + response.data[i].address + ',' + response.data[
                                i].zip_code + ',' + response.data[i].city + ',' + response.data[
                                i].state + ',' + response.data[i].country +
                            '</label></div></div>')
                    }
                    // $('#old_address').append(' <button  type="button" style="display: block;" id="old_btn" class="btn btn-block btn-primary font-weight-bold py-3 ">Use Selected Address</button>')
                }
            });
        });

        $('#save_address').click(function() {
            console.log('saving')
            fd = new FormData($('#address_data')[0])
            // fd.append('payment',$('[name="payment"]').val())
            $.ajax({
                type: "post",
                url: "{{ route('save_address') }}",
                data: fd,
                dataType: "json",
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                success: function(response) {
                    if (response.errors) {
                        $.each(response.errors, function(key, value) {
                            console.log('#error-' + key)
                            $('.error-' + key).html('<span class="text-danger">' + value +
                                '</span>')
                        })
                    } else {
                        console.log(response)
                        Swal.fire({
                            title: 'Address Saved',
                            text: 'Your Address Has Been Savef',
                            type: 'success',
                            icon:'success'
                            
                        })
                        $('#old_address').html('')
                        for (let i = 0; i < response.data.length; i++) {
                            response_data = response.data
                            $('#old_address').append(
                                '<div class="form-group"><div class="custom-control custom-radio " ><input onclick="change_address_text(' +
                                response.data[i].address_id +
                                ')" type="radio" class="custom-control-input" name="old" id="' +
                                response.data[i].address_id +
                                '" ><label class="custom-control-label" for="' + response.data[i]
                                .address_id + '">' + response.data[i].address + ',' + response.data[
                                    i].zip_code + ',' + response.data[i].city + ',' + response.data[
                                    i].state + ',' + response.data[i].country +
                                '</label></div></div>')

                        }
                        $('#address_data .form-control remove-text').val('')
                    }


                }
            });
        });
        $('.form-control .remove-text').change(function(e) {
            $('#login_form .form-error').html('')
        });
        $('.remove').click(function(e) {
            $(this).parent().parent().parent().children().last().html('')
        });

        function change_address_text(var1) {
            console.log(var1)
            if (var1 == 'old') {
                $('#old_address').css('display', 'block')
                $('#old_btn').css('display', 'block')

                $('.form-show').css('display', 'none')

            } else if (var1 == 'new') {
                $('.form-show').css('display', 'block')
                $('#old_address').css('display', 'none')
                $('#old_btn').css('display', 'none')

            }

        }
        $('#order_cart').click(function(e) {
            e.preventDefault();
            console.log('Order')
            if (!$("input[name='old']:checked").val()) {
                $('#error_address').html('<span class="text-danger">Please Select An Address</span>')

            } else {
                $('#error_address').html('')
                console.log($("input[name='old']:checked").attr('id'));
                obj = {
                    address_id: $("input[name='old']:checked").attr('id'),
                    products: JSON.parse(localStorage.cart{{ Auth::user()->id }}).products,
                    total_products: JSON.parse(localStorage.cart{{ Auth::user()->id }}).products.length,
                    total_price: total,
                    price: price_array

                }
                total = JSON.parse(localStorage.cart{{ Auth::user()->id }}).total
                gst = JSON.parse(localStorage.cart{{ Auth::user()->id }}).gst
                final = total + gst
                $.ajax({
                    type: "post",
                    url: "{{ route('place_order') }}",
                    data: obj,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },

                    success: function(response) {
                        Swal.fire({
                            title: 'Order Placed',
                            text: 'Your Order Has Been Placed Successfully',
                            type: 'success',
                            icon:'success'

                        })
                        id = response.id
                        localStorage.removeItem('cart{{ Auth::user()->id }}')
                        setTimeout(() => {
                            window.location.href = "{{ route('order_success') }}?id=" +
                                response.id + ""
                        }, 1000);
                    }
                });

            }

        });
    </script>
@endpush
