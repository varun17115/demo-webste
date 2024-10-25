@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="h-100 ps-4 pe-4">
            {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}


            <div class="row">
                <div style="margin-top:10px">
                    <div class="page-header">
                        <h3 class=" page-title">Add Product &nbsp;</h3>
                        <div class=" d-flex float-end">
                            <button style="margin-left:30px" type="button" class=" btn btn-success mb-3 fg-dark"
                                id="new_prod_btn">Click To Add New Product &nbsp;</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card w-100 pt-3 pb-3">
                    <div class="w-100 card-body p-0">
                        <div style="overflow: auto" class="datatable_css w-100 p-1  table-responsive">
                            <table class="table  border-0 text-center" id="products_table">
                                <thead class="  top-0">
                                </thead>
                                <tbody onload="showLoading()" id='tbody'>
                                    <section id="loading">
                                        <div id="loading-content"></div>
                                    </section>
                                </tbody>
                                <tbody class="" id="products">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@include('admin.modals.add_product_modal')


@push('script')
    <script>
        var product_id, a = 0,
            error_text = null,
            ab;

        function create_table() {
            console.log('Creating Table.......')

            $('#products_table').DataTable({
                "processing": true,
                "serverSide": true,
                'serverMethod': 'POST',

                // "headers":{'CSRFToken':'{{ csrf_token() }}'},
                ajax: {
                    'url': '{{ route('get_products') }}',
                    'type': 'POST',
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'prod_id',
                        title: 'Product Id'
                    },
                    {
                        data: 'prod_image',
                        name: 'prod_image',
                        orderable: false,
                        searchable: false,
                        title: 'Product Image'
                    },
                    {
                        data: 'prod_name',
                        title: 'Product Name'
                    },
                    {
                        data: 'prod_price',
                        title: 'Product Price'
                    },
                    {
                        data: 'action',
                        name: 'Action',
                        title: 'Action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'feature',
                        name: 'feature',
                        title: 'Feature',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

        }

        $(document).ready(function() {
            // showLoading()
            $('#products_nav').addClass('active')

            $.ajax({
                type: "post",
                url: "{{ route('get_categories') }}",
                // data: "",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    console.log(response.category.length)
                    for (let i = 0; i < response.category.length; i++) {
                        $('.category').append('<option value="' + response.category[i].cat_id + '">' +
                            response.category[i].cat_name + '</option>')
                        // console.log('yes')
                    }
                    for (let k = 0; k < response.brand.length; k++) {
                        $('.brand').append('<option value="' + response.brand[k].brand_id + '">' +
                            response.brand[k].brand_name + '</option>')

                    }
                }
            });

            create_table()

            // hideLoading()

        });

        $('#new_prod_btn').click(function() {
            console.log('addding new product ....')
            a = 0
            $('.remove-text').val('')

            $('#imageprev').attr('src', '{{ url('download.png') }}')
            $('#add_product').modal('toggle')
            if ($('#add_new_prod').html() == "Update Product") {
                $('#add_new_prod').html('Add Product')
                $('#exampleModalLabel').html('Add Product')
            }
        });

        $('#add_new_prod').click(function(e) {
            fd = new FormData($('#new_product')[0])
            fd.append('prod_id', product_id)

            console.log(a)
            if (a == 1 || ab) {
                showLoading()
                if ($('#image_name').val()) {
                    fd.append('image_change', 'yes')
                }
                fd.append('update', true)
                // $('#add_product').modal('hide')

                hideLoading()
            } else {
                category_id = $('#category').val()
                image_name = $('#image_name').val()
                fd.append('category_id', category_id)
                fd.append('image_name', image_name)
                // showLoading()

                $('#imageprev').attr('src', '{{ url('download.png') }}')
            }
            $.ajax({
                type: "post",
                url: "{{ route('add_new_product') }}",
                data: fd,
                dataType: "json",
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                processData: false,
                success: function(response) {
                    ab = response.update
                    if (response.update) {
                        console.log('ONE')
                        a = 1
                    } else {
                        console.log('ZERO')
                        a = 0
                    }
                    if (response.errors) {
                        $.each(response.errors, function(key, value) {
                            $('#error-' + key).html(
                                '<span class="text-danger remove"> ' + value +
                                ' </span>')
                        });


                    } else {
                        console.log('adding')
                        $('#add_product').modal('hide')
                        $('.text-danger').html('')
                        $('.form-control .remove-text').val('')
                        Swal.fire({
                            title: "Success",
                            text: "Product Added/Updated Successfully",
                            icon: "success",
                        })
                        $('#products_table').DataTable().destroy()
                        create_table()

                    }
                    a = 0
                }

            });
        });
        $('.btn-close').click(function(e) {

            $('.text-danger').html('')
            $('.form-control .remove-text').val('')
            $('#imageprev').attr('src', '{{ url('download.png') }}')
        });

        function edit_data(id, cat_id) {




            console.log(id)
            $('#add_new_prod').html('Update Product')
            $('#exampleModalLabel').html('Update Product')
            $.ajax({
                type: "post",
                url: "{{ route('get_product_data') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id,
                    cat_id: cat_id
                },
                dataType: "json",
                success: function(response) {
                    console.log(response.data[0].prod_brand_id)
                    $('#add_product').modal('toggle')
                    $('#image_name').val('')
                    $.each(response.data[0], function(key, value) {
                        $('#' + key).val(value)
                    });

                    product_id = response.data[0].prod_id
                    $('#imageprev').attr('src', '{{ url('products') }}/' + response.data[0].prod_image)

                    // $('#add_new_prod').attr('id','update_prod')
                    a = 1
                }
            });
        }


        function imageinput(image) {
            const file = image.files[0]
            console.log(file);
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#imageprev").attr('src', event.target.result)
                    src = event.target.result
                }
                reader.readAsDataURL(file)
            }
        }

        function feature_image(id, elem) {
            var status
            if ($(elem).is(':checked')) {
                console.log('yes')
                status = true
            } else {
                console.log('no')
                status = false
            }
            $.ajax({
                type: "post",
                url: "{{ route('feature_image') }}",
                data: {
                    id: id,
                    status: status
                },
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status == "true") {
                        Swal.fire({
                            title: "Success",
                            text: "Product Added To Feature",
                            icon: "success",
                        });
                    } else {
                        Swal.fire({
                            title: "Success",
                            text: "Product Removed To Feature",

                            icon: "success",
                        });

                    }
                }
            });
        }

        function showLoading() {
            document.querySelector('#loading').classList.add('loading');
            document.querySelector('#loading-content').classList.add('loading-content');
        }

        function hideLoading() {
            document.querySelector('#loading').classList.remove('loading');
            document.querySelector('#loading-content').classList.remove('loading-content');
        }

        function delete_data(id) {
            Swal.fire({
                icon: 'error',
                title: 'Are You Sure You Want To Delete Product ?',
                showCancelButton: true,
                denyButtonText: `Cancel`,
                confirmButtonText: 'Sure',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('delete_product') }}",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },

                        success: function(response) {
                            $('#products_table').DataTable().destroy()
                            create_table()
                        }
                    });

                }
            })
        }
        $('#new_product .form-control').change(function(e) {
            $(this).parent().find('.remove').html('')
        });
    </script>
@endpush
