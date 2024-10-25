@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row ps-4 pe-4">
            <div class="card ">
                <div class="card-body">
                    <div class="card-title fs-4 d-flex justify-content-center">
                        Edit Profile
                    </div>
                    <form method="post" id='myform' onsubmit="return false" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <div>
                                <label class="form-label">Firstname</label>
                                <input type="text" class="form-control remove-text " id='firstname' name="firstname"
                                    placeholder="Firstname" autofocus>
                                <span id='error-firstname' class="remove"></span>

                            </div>
                            <div>
                                <label class="form-label">Lastname</label>
                                <input type="text" class="form-control remove-text " id='lastname' name="lastname"
                                    placeholder="Lastname" autofocus>
                                <span id='error-lastname' class="remove"></span>

                            </div>
                            <div>
                                <label class="form-label">Email address</label>
                                <input type="email" class="form-control remove-text " id='email' name="email"
                                    placeholder="name@example.com" autofocus>
                                <span id='error-email' class="remove"></span>

                            </div>
                            <div>
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-control remove-text " id='phone' name="phone"
                                    placeholder="123-123-1234" autofocus>
                                <span id='error-phone' class="remove"></span>

                            </div>

                            <div>
                                <label class="form-label">Profile Photo</label>

                                <input type="file" onchange="imageinput(this)" id='image'
                                    class="form-control remove-text " name="image" />

                                <img src="#" id='imageprev' name='imageprev' style="height:200px;width:200px"
                                    class="rounded-circle " />

                            </div>
                            <div class="pass" style="display:none">
                                <label class="form-label">New password</label>
                                <input type="password" class="form-control remove-text " id='password' name=""
                                    autofocus>
                                <span id='error-password' class="remove"></span>

                            </div>
                            <div class="pass" style="display:none">
                                <label class="form-label">confirm password</label>
                                <input type="password" class="form-control remove-text " id='cpass' name=""
                                    autofocus>
                                <span id='error-confirm_password' class="remove"></span>
                            </div>
                            <a id="show_pass" onclick="show_pass()" class="border-0 ">Change Password</a>

                            <button class="w-100 btn btn-lg" style="background-color:aqua"
                                type="submit">Update</button><br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        var image, count = 1;
        $(document).ready(function() {
            $('#edit_nav').addClass('active')

            id = '{{ $_REQUEST['id'] }}'
            $.ajax({
                type: "post",
                url: "edit_rec",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    image = response.data[0].image


                    $.each(response.data[0], function(key, value) {
                        if (key != 'image') {
                            $('#' + key).val(value)

                        }
                    })

                    if (image == null) {
                        $('#imageprev').attr('src', '{{ asset('default.webp') }}')
                    } else {
                        $('#imageprev').attr('src', "{{ url('/images') }}/" + image)
                    }
                }
            });

        });
        $('#myform').submit(function(e) {
            id = '{{ Auth::user()->id }}'
            var fd = new FormData(this);
            fd.append('id', id)
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
                    // console.log(response)
                    if (response.status == true) {
                        console.log('TRUE');
                       $('.remove').html('')

                        // window.location = "{{ route('welcome') }}";
                    } else {
                        $.each(response.errors, function(key, value) {
                            console.log('#' + key)
                            $('#error-' + key).html(
                                '<span class="text-danger remove"> ' + value +
                                ' </span>')
                        })
                        Swal.fire({
                            icon: 'success',
                            title: 'Profile Updated Successfully',
                        })

                    }
                }
            });
        });

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

        function show_pass() {
            count = count + 1
            if (count % 2 == 0) {
                $('.pass').css({
                    'display': 'block'
                })
                $('#show_pass').html('Don"t Change Pass')
                $('#password').attr('name', 'password')
                $('#cpass').attr('name', 'confirm_password')

            } else {
                $('.pass').css({
                    'display': 'none'
                })
                $('#show_pass').html('Change Pass')
                $('#password').attr('name', '')
                $('#cpass').attr('name', '')

            }

        }
        $('#myform .form-control').change(function(e) {
            $(this).parent().find('.remove').html('')
        });
    </script>
@endpush
