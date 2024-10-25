@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="h-100 ps-4 pe-4">

            <div class="row">  
                <div style="margin-top:10px">
                    <div class="page-header">
                        <h3 class=" page-title">Current Orders &nbsp;</h3>
                        
                    </div>
                </div>     
            </div>
            <div class="row">
                <div class="card ">
                    <div class="card-body">
                        <div style="overflow: auto" class="w-100 p-1   datatable_css table-responsive">
                            <table  class="table w-100  border-0 text-center text-truncate" id="orders" >
                                <thead class="thead-dark position-sticky top-0">
                                </thead>            
                                <tbody onload="showLoading()" id='tbody'>
                                    <section id="loading">
                                        <div id="loading-content"></div>
                                    </section>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('admin.modals.view_order')
@push('script')
    <script>
        var cls = null
        function create_table()
        {
            console.log('Creating order Table ...')
            $('#orders').DataTable({
                "processing": true,
                "serverSide": true,
                'serverMethod': 'POST',
                
                columns:[
                    {data: 'order_id',title :'Order Id' ,"width":'10%'},
                    {data: 'user_id', title :'User Id',"width":'10%'},
                    
                    {data: 'Total_Price',title :'Total Payment',"width":'10%'},

                    {data: 'Payment_Method',title :'Payment Method' ,"width":'10%'},
                    {data: 'order_date',title :'Date' ,"width":'10%'},
                    {data:null,title:'Change Status',render:dropdown,"width":'15%'},
                    {data:'action',title:'action',searchable:false,orderable:false}

                ],
               ajax: {
                    'url': '{{ route("show_orders") }}',
                    'type': 'POST',
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },

            });
        }
        $(document).ready(function () {
            create_table()
            $('#orders_nav').addClass('active')

        });
        
        function dropdown(data, type, row, meta){
            // console.log(data)
            select_box =  `<select onchange="update_status(this,'${data.order_id}')" id="select_status" class="form-select " name="" id="">
                <option value="pending" ${data.status=='pending'?'selected':''}>Pending</option>
                <option value="shipped" ${data.status=='shipped'?'selected':''} >Shipped</option>
                <option value="delivered" ${data.status=='delivered'?'selected':''}>Deliverd</option>
                <option  value="cancelled" ${data.status=='cancelled'?'selected':''}>Cancelled</option>
            </select>`

            $("#"+data.status+"").prop('selected',true)

            return select_box
        }
        function update_status(elem,id)
        {
            console.log($(elem).val())
            console.log(id)
            $.ajax({
                type: "post",
                url: "{{route('update_status')}}",
                data: {status:$(elem).val(),id:id},
                dataType: "json",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                success: function (response) {
                    console.log(response)
                    Swal.fire({
                        icon: 'info',
                        title: 'Status Updated',
                    })
                    $('#orders').DataTable().destroy()
                    create_table()
                }
            });
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
                        $('#cart_body').append(' <tr class=""><td><img style="width:50px;height:auto !important" src="{{ url('products') }}/' +
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
    </script>
@endpush    