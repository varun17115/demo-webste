@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="ps-4 " style="margin-top:10px">
                <div class="page-header">
                    <h3 class=" page-title">Manage Users &nbsp;</h3>
                    <div class=" d-flex float-end">
                        <button type="button" id='add_user' class="btn btn-m  text-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" style="float:right;border:0px ">
                            <span class="mdi mdi-plus-box  text-danger fs-3"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ps-4 pe-4">
            <div class="w-100 card ">
                <div class="w-100 p-3 card-body p-0">
                    <div style="overflow: auto" class="h-100 p-1  datatable_css table-responsive">
                        <table class="table text-black border-0 text-center" id="table">
                            <thead class="position-sticky top-0">
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
    <div>
        @include('admin.modals.add_user_modal')
        @include('admin.modals.edit_user_modal')
    </div>
@endsection
@push('script')
    <script>
        var resp, resp2;
        var image;

        function create_table(response) {
            $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                'serverMethod': 'POST',
                'responsive': true,
                // "headers":{'CSRFToken':'{{ csrf_token() }}'},
                ajax: {
                    'url': '{{ route('manage_users') }}',
                    'type': 'POST',
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'id',
                        title: ' Id'
                    },
                    {
                        data: 'firstname',
                        title: 'Firstname'
                    },
                    {
                        data: 'lastname',
                        title: 'Lastname'
                    },
                    {
                        data: 'email',
                        title: 'Email'
                    },
                    {
                        data: 'phone',
                        title: 'Phone'
                    },
                    {
                        data: 'user_type',
                        title: 'User Type'
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
            $('#users_nav').addClass('active')
        });

        function delete_data(id) {

            Swal.fire({
                icon: 'error',
                title: 'Are You Sure You Want To Delete Data ?',
                showCancelButton: true,
                denyButtonText: `Cancel`,
                confirmButtonText: 'Sure',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: "delete_rec",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#table').DataTable().destroy()
        
                            create_table()
        
                        }
                    });
                   
                }
            })
        }

        function edit_data(id) {
            console.log(id)
            $.ajax({
                type: "post",
                url: "edit_rec",
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    $('#edit_modal').modal('toggle')
                    image = response.data[0].image

                    $.each(response.data[0], function(key, value) {
                        $('#' + key + '-e').val(value)
                    })



                    if (image == null) {
                        $('#imageprev').attr('src', '{{ asset('default.webp') }}')
                    } else {
                        $('#imageprev').attr('src', "{{ url('/images') }}/" + image)
                    }
                }
            });
        }

        $('#add_rec').on("click", function() {
            var e = this;
            fd = new FormData($('#myform123')[0])

            $.ajax({
                type: "post",
                url: 'add_user',
                data: fd,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                processData: false,
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    if (response.status) {
                        console.log(response);
                        Swal("Success", "Record Added Successfully", "success");
                        $('#myform123 .remove').text('')
                        $("#exampleModal").modal('hide')
                        $('#table').DataTable().destroy()

                        create_table()

                    } else {
                        console.log('FALSE');

                        $(".text").remove();
                        if (response.errors) {
                            $.each(response.errors, function(key, value) {
                                console.log('#' + key)
                                $('#error-' + key).html(
                                    '<span class="text-danger remove"> ' + value +
                                    ' </span>')
                            })
                        }

                    }
                }
            });
        });

        function showLoading() {
            document.querySelector('#loading').classList.add('loading');
            document.querySelector('#loading-content').classList.add('loading-content');
        }

        function hideLoading() {
            document.querySelector('#loading').classList.remove('loading');
            document.querySelector('#loading-content').classList.remove('loading-content');
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
        $('.btn-close').click(function(e) {
            e.preventDefault();
            $('#myform123 .remove').text('')
            $('#edit_form .remove').text('')

        });
        $('#update').click(function(e) {
            var fd = new FormData($('#edit_form')[0]);
            if ($('#image')[0].files.length != 0) {
                fd.append('update', true)
            } else if ($('#imageprev').attr('src')) {
                fd.append('image_name', image)
            }
            $.ajax({
                type: "post",
                url: "update_rec",
                data: fd,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dataType: "json",
                processData: false,
                success: function(response) {
                    if (response.status) {
                        console.log('TRUE');

                        $("#edit_modal").modal('hide')
                        newsrc = "{{ asset('images') }}/" + response.status
                        $('#nav_image').attr("src", newsrc)
                        $('#drop_image').attr("src", newsrc)

                        Swal("Success", "Record Updated Successfully", "success");

                        $('#table').DataTable().destroy()

                        create_table()
                    } else {
                        $.each(response.errors, function(key, value) {
                            console.log('#' + key)
                            $('#error-' + key + '-e').html(
                                '<span class="text-danger remove"> ' + value +
                                ' </span>')
                        })

                    }
                }
            });
        });
        $('#myform123 .form-control').change(function(e) {
            $(this).parent().find('.remove').html('')
        });
        $('#edit_form .form-control').change(function(e) {
            $(this).parent().find('.remove').html('')
        });
        
    </script>
@endpush
