@extends('user.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('display_main') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row px-xl-5">

            <div class="col-lg-12 col-md-12">
                <h5 class="section-title position-relative text-center text-uppercase mb-3"><span
                        class="bg-secondary pr-3">Wish List products</span></h5>

                <div class="row pb-3" id="products_count">
                    @if ($products->count() == 0)
                        <h2 class="position-relative text-center text-uppercase mb-3">Sorry , No Products Available At This
                            time</h2>
                    @else
                        @foreach ($products as $product)
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-1">
                                <div class="product-item text-center bg-light mb-4">
                                    <div style="" class="product-img position-relative overflow-hidden">
                                        <img style="height:200px;width:200px" class="img-fluid mt-3"
                                            src="{{ url('products') }}/{{ $product->favourites->prod_image }}"
                                            alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square"
                                                href="{{ route('show_product') }}?id={{ $product->favourites->prod_id }}"><i
                                                    class="fa fa-shopping-cart"></i></a>

                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="far fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="{{ route('show_product') }}?id={{ $product->favourites->prod_id }}">{{ $product->favourites->prod_name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $product->favourites->prod_price }}</h5>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button onclick="remove_liked('{{ $product->favourites->prod_id }}',this)"
                                            class="btn btn-danger mb-3">remove</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>

                <div class="col-12" id="pagination">
                    <div class="d-flex justify-content-center">
                        @if ($products->hasPages())
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    @if ($products->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                    @else
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $products->previousPageUrl() }}">
                                                Previous</a>
                                        </li>
                                    @endif

                                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                                        <li id="page-{{ $i }}" class="page-item">
                                            <a class="page-link" href="{{ route('show_likes_page') }}{{'?page='.$i}}">
                                                {{$i}}
                                            </a>
                                        </li>
                                    @endfor


                                    @if ($products->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $products->nextPageUrl() }}"
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
        function remove_liked(id,elem) {
            console.log(id)

            $.ajax({
                type: "post",
                url: "{{route('remove_liked')}}",
                data: {id:id},
                dataType: "json",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                success: function (response) {
                    console.log($(elem))
                    $(elem).parent().parent().parent().remove()  
                    Swal.fire({
                        title: 'info',
                        text: 'You have unliked this product',
                        icon: 'info',

                    })
                    $('#favourite_count').text(response.total)
                }
            });
        }
    </script>
@endpush
