@extends('user.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Orders</a>
                    <span class="breadcrumb-item active">Current Orders</span>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <div class="card card-body bg-light mb-30">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="h4 mb-30">Current Orders</h2>
                            <div class="table-responsive">
                                <table class="table text-center table-bordered table-hover table-striped table-checkable"
                                    id="order_table">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Order Date</th>
                                            <th>Order Status</th>
                                            <th>Order Total</th>
                                            <th>Total Products</th>
                                            <th>Payment Method</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $order)
                                            <tr>
                                                <td>{{ $order->order_id }}</td>
                                                <td>{{ $order->order_date }}</td>
                                                <td sty>
                                                    @if ($order->status == 'pending')
                                                        <span style="font-size: 16px"
                                                            class="badge badge-warning">Pending</span>
                                                    @elseif ($order->status == 'shipped')
                                                        <span style="font-size: 16px"
                                                            class="badge badge-info">shipped</span>
                                                    @elseif ($order->status == 'delivered')
                                                        <span style="font-size: 16px"
                                                            class="badge badge-success">delivered</span>
                                                    @elseif ($order->status == 'cancelled')
                                                        <span style="font-size: 16px"
                                                            class="badge badge-danger">Cancelled</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->Total_Price }}</td>
                                                <td>{{ $order->Total_Products }}</td>
                                                <td>{{ $order->Payment_Method }}</td>
                                                <td>
                                                    <button onclick="show_order('{{ $order->id }}')"
                                                        class="btn btn-primary btn-sm ">View Order</button>
                                                    <button onclick="cancel_order('{{ $order->id }}')"
                                                        class="btn btn-danger btn-sm">Cancel</button>
                                                    <button onclick="reorder_order('{{ $order->id }}')"
                                                        class="btn btn-info btn-sm">Reorder</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('user/modal/view_order')
@include('user/modal/cancel_reason')
@push('script')
    <script>
        cancel_id = null

        function cancel_order(id) {
            Swal.fire({
                icon: 'error',
                title: 'Are You Sure You Want To Cancel Order ?',
                showCancelButton: true,
                denyButtonText: `Cancel`,
                confirmButtonText: 'Sure',
            }).then((result) => {
                if (result.isConfirmed) {
                    cancel_id = id
                    setTimeout(() => {
                        $('#cancel_reason-modal').modal('show')

                    }, 500);
                }
            })
        }

        function show_order(id) {
            console.log(id)
            $.ajax({
                type: "post",
                url: "{{ route('get_order_data') }}",
                data: {
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    // console.log(response)
                    $("#view_order").modal('show')
                    $('#cart_body').empty()
                    for (let i = 0; i < response.order.order_items.length; i++) {
                        $('#cart_body').append(' <tr><td><img style="width:50px" src="{{ url('products') }}/' +
                            response.order.order_items[i].product.prod_image +
                            '"> </td><td class="align-middle h5 ">' + response.order.order_items[i].product
                            .prod_name + '</td><td class="align-middle h5 ">' + response.order.order_items[
                                i].product_price + '</td><td class="align-middle h5 ">' + response.order
                            .order_items[i].product_quantity + '</td></tr>')
                        console.log(i)
                    }
                    $('#exampleModalLabel').text('Order Id #' + response.order.order_id)
                    $('#order-date').text(response.order.order_date)
                    $('#payment-type').text(response.order.Payment_Method)
                    $('#order-id').text(' #' + response.order.order_id)
                    $('#address').text(response.order.address_detail.address)
                    $('#city').text(response.order.address_detail.city)
                    $('#state').text(response.order.address_detail.state)
                    $('#country').text(response.order.address_detail.country)
                    $('#zip-code').text(response.order.address_detail.zip_code)
                }
            });
        }
        $('#cancel_reason-btn').click(function(e) {
            // reason = null
            e.preventDefault();

            if ($('#reason').val() == 'Other') {
                console.log('if')
                reason = $('#reason_text').val()
            } else {
                console.log('else')
                reason = $('#reason').val()
            }
            if ($('#reason').val() == null) {
                console.log('else if')
                $('.error-div').html('<span class="text-danger">Enter A Valid Reason</span>')
            } else {
                $('.error-div').html('')
                $.ajax({
                    type: "post",
                    url: "{{ route('cancel_order') }}",
                    data: {
                        id: cancel_id,
                        reason: reason
                    },
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response)
                        $('#cancel_reason-modal').modal('hide')
                    }
                });

            }
        });

        function reorder_order(id) {
            products = []
            $.ajax({
                type: "post",
                url: "{{ route('reorder') }}",
                data: {
                    id: id
                },
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response)
                    for (let i = 0; i < response.order_details.order_items.length; i++) {
                        products.push({
                            'product_id': response.order_details.order_items[i].product_id,
                            'quantity': response.order_details.order_items[i].product_quantity,
                        })
                    }
                    var data = {
                        products: products,
                        reorder:true
                    }
                    console.log(data)

                    if(localStorage.cart{{Auth::user()->id}} != null)
                    {
                        localStorage.removeItem('cart{{Auth::user()->id}}')
                    }

                    localStorage.setItem('cart{{Auth::user()->id}}',JSON.stringify(data))

                    window.location.href='{{route("display_cart")}}'
                }
            });
        }
    </script>
@endpush
