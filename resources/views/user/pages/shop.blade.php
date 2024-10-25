@extends('user.layout.app')
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{route('display_main')}}">Home</a>
                <a class="breadcrumb-item text-dark" href="">Shop</a>
                <span class="breadcrumb-item active">Shop List</span>
            </nav>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-3 col-md-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form onsubmit="return false">
                    <div  class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input name="radio" onchange="filter_data('0','price',this)" type="radio" class="custom-control-input" id="price-0">
                        <label class="custom-control-label" for="price-0">All Price</label>
                        
                    </div>
                    <div  class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input name="radio" onchange="filter_data('1','price',this)" type="radio" class="custom-control-input" id="price-1">
                        <label class="custom-control-label" for="price-1">₹0 - ₹1000</label>
                        
                    </div>
                    <div  class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input name="radio" onchange="filter_data('2','price',this)" type="radio" class="custom-control-input" id="price-2">
                        <label class="custom-control-label" for="price-2">₹1000 - ₹2000</label>
                        
                    </div>
                    <div  class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input name="radio" onchange="filter_data('3','price',this)" type="radio" class="custom-control-input" id="price-3">
                        <label class="custom-control-label" for="price-3">₹2000 - ₹5000</label>
                        
                    </div>
                    <div  class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input name="radio" onchange="filter_data('4','price',this)" type="radio" class="custom-control-input" id="price-4">
                        <label class="custom-control-label" for="price-4">₹5000 - ₹10000</label>
                        
                    </div>
                    <div  class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input name="radio" onchange="filter_data('5','price',this)" type="radio" class="custom-control-input" id="price-5">
                        <label class="custom-control-label" for="price-5">₹10000 - ₹50000</label>
                        
                    </div>
                    <div  class="custom-control custom-radio d-flex align-items-center justify-content-between">
                        <input name="radio" onchange="filter_data('6','price',this)" type="radio" class="custom-control-input" id="price-6">
                        <label class="custom-control-label" for="price-6">₹50000+ </label>
                        
                    </div>
                </form>
            </div>

            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Brand</span></h5>
            <div class="bg-light p-4 mb-30">
                <form onsubmit="return false">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input onchange="filter_data('0','brand',this)" type="checkbox" class="custom-control-input"  id="brand-0" >
                        <label class="custom-control-label" for="brand-0" >All Brands</label>
                        
                    </div>
                    @foreach ($brands as $brand)
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input onchange="filter_data('{{$brand->brand_id}}','brand',this)" type="checkbox" class="custom-control-input" id="brand-{{$brand->brand_id}}" >
                            <label class="custom-control-label" for="brand-{{$brand->brand_id}}" >{{$brand->brand_name}}</label>
                            
                        </div>        
                    @endforeach
                    
                </form>
            </div>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Category</span></h5>
            <div class="bg-light p-4 mb-30">
                <form onsubmit="return false">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input onchange="filter_data('0','category',this)" type="checkbox" class="custom-control-input"  id="cat-0">
                        <label class="custom-control-label" for="cat-0">All Categories</label>
                        
                    </div>
                    @foreach ($categories as $category)
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input onchange="filter_data('{{$category->cat_id}}','category',this)" type="checkbox" class="custom-control-input" id="cat-{{$category->cat_id}}">
                            <label class="custom-control-label" for="cat-{{$category->cat_id}}" >{{$category->cat_name}}</label>
                            
                        </div>        
                    @endforeach
                    
                </form>
            </div>
        </div>
        <div class="col-lg-9 col-md-8">
            <h5 class="section-title position-relative text-center text-uppercase mb-3"><span class="bg-secondary pr-3">Current products</span></h5>

            <div class="row pb-3" id="products_count">
                @if ($products->count() == 0)
                    <h2 class="position-relative text-center text-uppercase mb-3">Sorry , No Products Available At This time</h2>
                @else
                        
                    @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item text-center bg-light mb-4">
                            <div style="max-height: 225px;max-width:225px" class="product-img position-relative overflow-hidden">
                                <img style="height:200px;width:200px" class="img-fluid" src="{{url('products')}}/{{$product->prod_image}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="{{route('show_product')}}?id={{$product->prod_id}}">
                                        <i class="fa fa-shopping-cart"></i></a>
                                    <a 
                                    onclick="like_product('{{$product->prod_id}}',this)"
                                    @if(Auth::check())
                                    @if ($product->isliked == 'true')  
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
                                <a class="h6 text-decoration-none text-truncate" href="{{route('show_product')}}?id={{$product->prod_id}}">{{$product->prod_name}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{$product->prod_price}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

            </div>
               
            @php
                $cat_arr = isset($_REQUEST['cat_arr'])?[$_REQUEST['cat_arr']]:[0];
                $brand_arr = isset($_REQUEST['brand_arr'])?[$_REQUEST['brand_arr']]:[0];
                $filter_price = isset($_REQUEST['filter_price'])?$_REQUEST['filter_price']:0;
            @endphp

            <div class="col-12" id="pagination">
                <div class="d-flex justify-content-center">
                    @if ($products->hasPages())
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                @if ($products->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" 
                                    tabindex="-1">Previous</a>
                                </li>
                                @else
                                <li class="page-item"><a class="page-link" 
                                    href="{{ $products->previousPageUrl() }}{{'&cat_arr='.implode(",",$cat_arr).'&brand_arr='.implode(",",$brand_arr).'&filter_price='.$filter_price}}">
                                        Previous</a>
                                </li>
                                @endif
                                
                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                <li id="page-{{$i}}" class="page-item">
                                    <a  class="page-link" 
                                    href="{{ route('display_shop') }}{{'?page='.$i.'&cat_arr='.implode(",",$cat_arr).'&brand_arr='.implode(",",$brand_arr).'&filter_price='.$filter_price}}" >{{ $i }}</a>
                                </li>
                                @endfor
                                

                                @if ($products->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" 
                                    href="{{ $products->nextPageUrl() }}{{'&cat_arr='.implode(",",$cat_arr).'&brand_arr='.implode(",",$brand_arr).'&filter_price='.$filter_price}}" 
                                    rel="next">Next</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
    <script>
        $(document).ready(function () {
            
            
            var cat_arr = [{{isset($_REQUEST['cat_arr'])?$_REQUEST['cat_arr']:0}}],
            brand_arr =[ {{isset($_REQUEST['brand_arr'])?$_REQUEST['brand_arr']:0}}],
            filter_price = {{isset($_REQUEST['filter_price'])?$_REQUEST['filter_price']:0}},
            page = {{isset($_REQUEST['page'])?$_REQUEST['page']:1}}
            
            cat_arr.forEach(i => {
                $('#cat-'+i).prop('checked',true)
                
            });


            brand_arr.forEach(i => {
                $('#brand-'+i).prop('checked',true)
                
            });


            $('#price-'+filter_price).prop('checked',true)

            $('#page-'+page).addClass('active')



        });
        var cat_arr = [{{isset($_REQUEST['cat_arr'])?$_REQUEST['cat_arr']:0}}],
        brand_arr =[ {{isset($_REQUEST['brand_arr'])?$_REQUEST['brand_arr']:0}}],
        filter_price = {{isset($_REQUEST['filter_price'])?$_REQUEST['filter_price']:0}}

        function filter_data(id,item,elem)
        {
            if(cat_arr.includes(0))
            {
                cat_arr = []
            }
            if(brand_arr.includes(0))
            {
                brand_arr = []
            }
            console.log(id+"   "+item)
            console.log(typeof id)
            if($(elem).is(':checked'))
            {
                console.log('yes')
                if(item == 'category')
                {
                    if (id==0)
                    {
                        cat_arr = []
                    }
                    cat_arr.push(id)
                }
                else if(item == 'brand')
                {
                    if(id == 0)
                    {
                        brand_arr = []
                    }
                    brand_arr.push(id)
                }
                else if (item == 'price')
                {
                    filter_price = id
                }
            }
            else
            {
                if(item == 'category')
                {
                    cat_arr = $.grep(cat_arr, function(n) {
                        return n != id;
                    });
                }
                else if(item == 'brand')
                {
                    brand_arr = $.grep(brand_arr, function(n) {
                        return n != id;
                    });
                }
            }
            if(cat_arr.length <= 0)
            {
                cat_arr = [0]
            }
            if(brand_arr.length <= 0)
            {
                brand_arr = [0]
            }
            
            window.location.href = "{{route('display_shop')}}?cat_arr="+cat_arr+"&brand_arr="+brand_arr+"&filter_price="+filter_price+""

        }
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