@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="h-100 ps-4 pe-4">
            {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

            <div class="row">
                <div style="margin-top:10px">
                    <div class="page-header">
                        <h3 class=" page-title">Add Category &nbsp;</h3>
                        <div class=" d-flex float-end">
                            <button style="margin-left:30px" type="button" class=" btn btn-success mb-3 fg-dark"
                                id="add_cat">Click To Add New Category &nbsp;</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card ">
                    <div class="card-body">
                        <div style="overflow: auto" class="w-100 p-1  datatable_css table-responsive">
                            <table class="table  border-0 text-center" id="category_table">
                                <thead class="thead-dark position-sticky top-0">
                                </thead>
                                <tbody onload="showLoading()" id='tbody'>
                                    <section id="loading">
                                        <div id="loading-content"></div>
                                    </section>
                                </tbody>
                                <tbody id="products"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('admin.modals.category_modal')
@push('script')
    <script>
        var a = 0,
            cat_id = null

        function create_table() {
            console.log('Creating Category Table ...')
            $('#category_table').DataTable({
                "processing": true,
                "serverSide": true,
                'serverMethod': 'POST',

                // "headers":{'CSRFToken':'{{ csrf_token() }}'},
                ajax: {
                    'url': '{{ route('get_cat_data') }}',
                    'type': 'POST',
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'cat_id',
                        title: 'Category Id'
                    },
                    {
                        data: 'cat_image',
                        name: 'cat_image',
                        orderable: false,
                        searchable: false,
                        title: 'Category Image'
                    },
                    {
                        data: 'cat_name',
                        title: 'Category Name'
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
            $('#category_nav').addClass('active')

        });
        $('#add_cat').click(function(e) {
            e.preventDefault();
            $('#category_modal').modal('toggle')
            $('.remove-text').val('')
            $('.text-danger').html('')
            $('#exampleModalLabel').html('Add Category')
            $('#add_cat_btn').html('Add Category')

            $('#imageprev').attr('src', '{{ url('download.png') }}')

            a = 0
        });
        $('#add_cat_btn').click(function(e) {
            fd = new FormData($('#category_form')[0])
            if (a == 1) {
                if ($('#image_name').val()) {
                    fd.append('image_change', 'yes')
                }
                fd.append('update', true)
                fd.append('cat_id', cat_id)
            } else {
                image_name = $('#image_name').val()
                fd.append('image_name', image_name)

            }

            $.ajax({
                type: "post",
                url: "{{ route('add_category') }}",
                data: fd,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.errors) {
                        $.each(response.errors, function(key, value) {

                            $('#error-' + key).html('<span class="text-danger remove">' +
                                value + '</span>')

                        });

                    } else {
                        $('#category_modal').modal('hide')
                        $('.text-danger').html('')
                        $('.form-control .remove-text').val('')
                        Swal.fire({
                            title: "Success",
                            text: "Category Added/Updated Successfully",
                            icon: "success",
                        })
                        $('#category_table').DataTable().destroy()
                        create_table()
                    }
                }

            });
        });

        function edit_cat(id) {
            $('.text-danger').html('')

            $('#exampleModalLabel').html('Update Category')
            $('#add_cat_btn').html('Update Category')

            cat_id = id
            $.ajax({
                type: "post",
                url: "{{ route('edit_category') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $('#category_modal').modal('toggle')
                    $.each(response.data[0], function(key, value) {
                        $('#' + key).val(value)
                    });
                    $('#image_name').val('')

                    $('#imageprev').attr('src', '{{ url('category_image') }}/' + response.data[0].cat_image)
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
        $('#category_form .form-control').change(function(e) {
            $(this).parent().find('.remove').html('')
        });

        function delete_cat(id) {
            Swal.fire({
                icon: 'error',
                title: 'Are You Sure You Want To Delete Category ?',
                showCancelButton: true,
                denyButtonText: `Cancel`,
                confirmButtonText: 'Sure',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('delete_category') }}",
                        data: {
                            id: id
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#category_table').DataTable().destroy()
                            create_table()
                        }
                    });

                }
            })
        }
    </script>
@endpush
