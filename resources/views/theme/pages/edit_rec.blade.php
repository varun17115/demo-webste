@extends('theme.layout.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row ps-4 pe-4">
            <div class="card ">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-center">
                        Edit
                    </div>
                    <form method="post" id='myform' onsubmit="return false" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <div>
                                <label class="form-label">Firstname</label>
                                <input type="text" class="form-control remove-text " id='fname' name="firstname"
                                    placeholder="Firstname" autofocus>
                                <span id='error-fname'></span>

                            </div>
                            <div>
                                <label class="form-label">Lastname</label>
                                <input type="text" class="form-control remove-text " id='lname' name="lastname"
                                    placeholder="Lastname" autofocus>
                                <span id='error-lname'></span>

                            </div>
                            <div>
                                <label class="form-label">Email address</label>
                                <input type="email" class="form-control remove-text " id='email' name="email"
                                    placeholder="name@example.com" autofocus>
                                <span id='error-email'></span>

                            </div>
                            <div>
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-control remove-text " id='phone' name="phone"
                                    placeholder="123-123-1234" autofocus>
                                <span id='error-phone'></span>

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
                                <span id='error-password'></span>

                            </div>
                            <div class="pass" style="display:none">
                                <label class="form-label">confirm password</label>
                                <input type="password" class="form-control remove-text " id='cpass' name=""
                                    autofocus>
                                <span id='error-cpass'></span>
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
                    $('#fname').val(response.data[0].firstname)
                    $('#lname').val(response.data[0].lastname)
                    $('#email').val(response.data[0].email)
                    $('#phone').val(response.data[0].phone)
                    $('#id').val(response.data[0].id)
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
                        $("#error-fname").html('');
                        $("#error-lname").html('');
                        $("#error-email").html('');
                        $("#error-phone").html('');
                        $("#error-password").html('');
                        $("#error-cpass").html('');

                        window.location = "{{ route('welcome') }}";
                    } else {
                        // console.log(response.errors)
                        if (response.errors.firstname) {
                            $("#error-fname").html("<span class=' text-danger'>" + response.errors
                                .firstname + "</span>");
                        } else {
                            $("#error-fname").html('');
                        }
                        if (response.errors.lastname) {
                            $("#error-lname").html("<span class=' text-danger'>" + response.errors
                                .lastname + "</span>");
                        } else {
                            $("#error-lname").html('')
                        }
                        if (response.errors.email) {
                            $("#error-email").html("<span class=' text-danger'>" + response.errors
                                .email + "</span>");
                        } else {
                            $("#error-email").html('')
                        }

                        if (response.errors.phone) {
                            $("#error-phone").html("<span class=' text-danger'>" + response.errors
                                .phone + "</span>");
                        } else {
                            $("#error-phone").html('')
                        }

                        if (response.errors.password) {
                            $("#error-password").html("<span class=' text-danger'>" + response.errors
                                .password + "</span>");
                        } else {
                            $("#error-password").html('')
                        }

                        if (response.errors.confirm_password) {
                            console.log(response.errors.confirm_password)
                            $("#error-cpass").html("<span class=' text-danger'>" + response.errors
                                .confirm_password + "</span>");
                        } else {
                            $("#error-cpass").html('')
                        }

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
    </script>
@endpush
