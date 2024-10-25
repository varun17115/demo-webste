@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="h-100 ps-4 pe-4">

            <div class="row">
                <div style="margin-top:10px">
                    <div class="page-header">
                        <h3 class=" page-title">Add Brand &nbsp;</h3>
                        <div class=" d-flex float-end">
                            <button style="margin-left:30px" type="button" class="mb-3 btn btn-success fg-dark"
                                id="add_brand">Click To Add New Brand &nbsp;</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card ">
                    <div class="card-body">
                        <div style="overflow:auto" class="w-100 p-1 datatable_css  table-responsive">
                            <table class="table  border-0 text-center" id="brands_table">
                                <thead class=" position-sticky top-0"></thead>
                                <tbody onload="showLoading()" id='tbody'>
                                    <section id="loading">
                                        <div id="loading-content"></div>
                                    </section>
                                </tbody>
                                <tbody id="products"> </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('admin.modals.brand_modal')
@push('script')
    <script>
        var a = 0,
            brand_id = null

        function create_table() {
            console.log('Creating Brand Table ...')
            $('#brands_table').DataTable({
                "processing": true,
                "serverSide": true,
                'serverMethod': 'POST',

                // "headers":{'CSRFToken':'{{ csrf_token() }}'},
                ajax: {
                    'url': '{{ route('get_brand_data') }}',
                    'type': 'POST',
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'brand_id',
                        title: 'Brand Id'
                    },
                    {
                        data: 'brand_image',
                        name: 'brand_image',
                        orderable: false,
                        searchable: false,
                        title: 'Brand Image'
                    },
                    {
                        data: 'brand_name',
                        title: 'Brand Name'
                    },
                    {
                        data: 'action',
                        name: 'Action',
                        title: 'Action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        }
        $(document).ready(function() {
            create_table()
            $('#brand_nav').addClass('active')

        });
        $('#add_brand').click(function(e) {
            e.preventDefault();
            $('#brand_modal').modal('toggle')
            $('.form-control .remove-text').val('')
            $('.remove-text').val('')

            $('#exampleModalLabel').html('Add Brand')
            $('#add_brand_btn').html('Add Brand')

            $('#imageprev').attr('src', '{{ url('download.png') }}')

            a = 0
        });
        $('#add_brand_btn').click(function(e) {
            fd = new FormData($('#brand_form')[0])
            if (a == 1) {
                if ($('#image_name').val()) {
                    fd.append('image_change', 'yes')
                }
                fd.append('update', true)
                fd.append('brand_id', brand_id)
            } else {
                image_name = $('#image_name').val()
                fd.append('image_name', image_name)

            }

            $.ajax({
                type: "post",
                url: "{{ route('add_brand') }}",
                data: fd,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.errors) {
                        console.log('errors')
                        $.each(response.errors, function(key, value) {
                            console.log('#error-' + key)
                            $('#error-' + key).html('<span class="text-danger remove">'+value+'</span>')
                        });
                    } else {
                        $('#brand_modal').modal('hide')
                        $('.text-danger').html('')
                        $('.form-control .remove-text').val('')
                        Swal.fire({
                            title: "Success",
                            text: "Brand Added/Updated Successfully",
                            icon: "success",
                        })
                        $('#brands_table').DataTable().destroy()
                        create_table()
                    }
                }

            });
        });
        $('#brand_form .form-control').change(function(e) {
            $(this).parent().find('.remove').html('')
        });

        function edit_brand(id) {
            $('.text-danger').html('')

            $('#exampleModalLabel').html('Update Brand')
            $('#add_brand_btn').html('Update Brand')

            brand_id = id
            $.ajax({
                type: "post",
                url: "{{ route('edit_brand') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $('#brand_modal').modal('toggle')
                    $('#image_name').val('')

                    $.each(response.data[0], function(key, value) {
                        $('#' + key).val(value)
                    });
                    $('#imageprev').attr('src', '{{ url('brand_image') }}/' + response.data[0].brand_image)
                }
            });
            a = 1
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


        function delete_brand(id) {
            Swal.fire({
                icon: 'error',
                title: 'Are You Sure You Want To Delete Brand ?',
                showCancelButton: true,
                denyButtonText: `Cancel`,
                confirmButtonText: 'Sure',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    type: "post",
                    url: "{{ route('delete_brand') }}",
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#brands_table').DataTable().destroy()

                        create_table()
                    }
                });

                }
            })
          
        }
    </script>
@endpush
