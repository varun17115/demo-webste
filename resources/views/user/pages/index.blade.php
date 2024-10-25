@extends('user.layout.app')
@section('content')
<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-center text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pl-3 pr-3">Our Fascilities</span></h2>
    <div class="row fs-4 pb-3" style="font-size: 28px">
        
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1" >
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 &nbsp; Support</h5>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-center text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pl-3 pr-3">Categories</span></h2>
    <div class="row px-xl-5 pb-3" id="cat_div">
    </div>
</div>
<div class="container-fluid py-5">
    <h2 class="section-title text-center position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pl-3 pr-3">Featured Products</span></h2>
    <div class="row px-xl-5">
        <div class="col" >
            <div class="owl-carousel owl-theme vendor-carousel " >
                @foreach ($products as $products)
                    <div class="pb-1">
                        <div class="product-item text-center bg-light mb-4">
                            <div style="max-height:195px;max-width:195px" class="product-img position-relative overflow-hidden">
                                <img style="height:195px;width:195px" class="img-fluid" src="{{url('products')}}/{{$products->prod_image}}" alt="">
                                <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href="{{route('show_product')}}?id={{$products->prod_id}}"><i class="fa fa-shopping-cart"></i></a>
                                        <a 
                                        onclick="like_product('{{$products->prod_id}}',this)"
                                        @if(Auth::check())
                                            @if ($products->isliked == 'true')  
                                            class="btn btn-outline-dark text-danger btn-square laal-dil" 
                                            
                                            @else
                                            class="btn btn-outline-dark btn-square" 
                                            @endif 
                                        @else
                                        
                                        
                                        class="btn btn-outline-dark btn-square" 

                                        @endif                        
                                     ><i class="fa fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{$products->prod_name}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{$products->prod_price}}</h5>
                                    <h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-5">
    <h2 class="section-title text-center position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pl-3 pr-3">Our Special Brands</span></h2>
    <div class="row px-xl-5">
        <div class="col" >
            <div class="owl-carousel owl-theme vendor-carousel " >
                @foreach ($brands as $brands)
                    <div class="bg-light p-4">                                           
                        <a href="{{route("display_shop")}}?cat_arr=0&brand_arr={{$brands->brand_id}}&filter_price=0"><img src="{{url('brand_image')}}/{{$brands->brand_image}}" alt=""></a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>



@endsection
@push('script')
    <script>
        $(document).ready(function () {
            @if (Auth::check())
                if(localStorage.cart != null)
                {
                    old_cart = JSON.parse(localStorage.cart).products
                    var data = {
                            products:old_cart
                            
                        }
                    if(localStorage.cart{{Auth::user()->id}} != null)
                    {
                        new_cart =  JSON.parse(localStorage.cart{{Auth::user()->id}}).products
                        
                        
                        
                        new_cart.forEach(element => {
                            old_cart.some(item => {
                                if(item.product_id == element.product_id)
                                {
                                    console.log(element.product_id)
                                    element.quantity = parseInt(element.quantity) + parseInt(item.quantity)
                                    console.log(element)
                                    Object.assign(element.quantity,element.quantity)
                                    console.log(new_cart)
                                    old_cart.shift()

                                }
                                else
                                {
                                    new_cart.push(item)
                                    old_cart.shift()
                                    console.log(item)
                                    console.log(new_cart)
                                }
                            })
                        });
                        var data = {
                            products:new_cart
                            
                        }
                        localStorage.removeItem('cart')                        
                    }
                    localStorage.setItem('cart{{Auth::user()->id}}',JSON.stringify(data))
                }

            @endif
            $.ajax({
                type: "post",
                url: "{{route('user_get_data')}}",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                // data: "dat",
                dataType: "json",
                success: function (response) {
                    for (let v = 0; v < response.category.length; v++) {
                        $('#cat_div').append('<div class="col-lg-3 col-md-4 col-sm-6 pb-1"><a class="text-decoration-none" href="{{route("display_shop")}}?cat_arr='+response.category[v].cat_id+'&brand_arr=0&filter_price=0"><div class="cat-item d-flex align-items-center mb-4"><div class="overflow-hidden" style="width: 100px; height: 100px;"><img class="h-100 w-100 img-fluid" src="{{url("category_image")}}/'+response.category[v].cat_image+'" alt=""></div><div class="flex-fill pl-3"><h6>'+response.category[v].cat_name+'</h6></div></div></a></div>')
                    }
                }
            }); 
        });
        function like_product(id,elem)
        {
            @if(Auth::check())


            console.log(id)
            $.ajax({
                type: "post",
                url: "{{route('like_product')}}",
                data: {id:id},
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                dataType: "json",
                success: function (response) {
                    if(response.operation == 'remove')
                    {
                        toastr.info(response.message)
                        console.log()
                        $(elem).removeClass('text-danger')
                        $(elem).removeClass('laal-dil')

                    }
                    else if(response.operation == 'add')
                    {
                        toastr.success(response.message)
                        $(elem).addClass('text-danger')
                        $(elem).addClass('laal-dil')
                    }
                    $('#favourite_count').html(response.total)
                }
            });
            @else
            Swal.fire({icon:'warning',
                    title:'Login To Like Product',
                    text : 'Add Products To See Cart ...',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,}).then((result) => {
                        if (result.isConfirmed) {
                            $('#login_modal').modal('show')
                            
                        } 
                    })
            @endif
        }
    </script>
@endpush