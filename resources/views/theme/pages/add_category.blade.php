@extends('theme.layout.app')

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
{{-- @include('admin.modals.category_modal') --}}
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
        });
        $('#add_cat').click(function(e) {
            e.preventDefault();
            $('#category_modal').modal('toggle')
            $('.form-control .remove-text').val('')
            $('.text-danger').html('')

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
                        if (response.errors.cat_desc) {
                            $("#error-cat_desc").html(
                                "<span class=' text-danger'>Category Description Is required</span>"
                                );
                        } else {
                            $("#error-cat_desc").html('');
                        }
                        if (response.errors.cat_name) {
                            $("#error-cat_name").html(
                                "<span class=' text-danger'>Category Name Is required</span>");
                        } else {
                            $("#error-cat_name").html('');
                        }
                        if (response.errors.cat_image) {
                            $("#error-cat_image").html(
                                "<span class=' text-danger'>Category Image Is required</span>");
                        } else {
                            $("#error-cat_image").html('');
                        }
                    } else {
                        $('#category_modal').modal('hide')
                        $('.text-danger').html('')
                        $('.form-control .remove-text').val('')

                        $('#category_table').DataTable().destroy()
                        create_table()
                    }
                }

            });
        });

        function edit_cat(id) {
            $('.text-danger').html('')

            $('#exampleModalLabel').html('Update Category')
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
                    $('#cat_name').val(response.data[0].cat_name)
                    $('#cat_desc').val(response.data[0].cat_description)
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
        $('.form-control remove-text').change(function(e) {
            // e.preventDefault();
            $(this).parent().children().last().html('')
        });

        function delete_cat(id) {
            var box = confirm('Are You Sure Want to Delete Data');
            if (box == true) {
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
        }
    </script>
@endpush
