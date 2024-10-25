{{-- @extends('admin.layouts.auth-master') --}}
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    
    @include('admin.partial.login_style')
</head>
<body>
        <div class="login-box">
            <h1 align="center">Register</h1>
            <form method="post" id='myform' onsubmit="return false" action={{route('register.post')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <div class="inputBox">
                    <input class="focus_input" type="text"  name="firstname" >
                    <label class="focus_label" >Firstname</label>
                    <span style="background-color:rgba(0, 0, 0, 0.8) " id="error-fname"></span><br>
                </div>
                <div class="inputBox" style="margin-top:15px">
                    <input class="focus_input" type="text" name="lastname"  >
                    <label class="focus_label" >Lastname</label>
                    <div style="background-color:rgba(0, 0, 0, 0.8) " id='error-lname'></div>
                </div>

                <div class="inputBox" style="margin-top:15px">
                    
                    <input class="focus_input" type="text"  name="email">
                    <label class="focus_label"  >Email</label>
                    <div style="background-color:rgba(0, 0, 0, 0.8) " id='error-email'></div>
                    
                </div>

                <div class="inputBox" style="margin-top:15px">
                    <input type="tel" class="focus_input"  name="phone" >
                    <label class="focus_label" >Phone</label>
                    <div style="background-color:rgba(0, 0, 0, 0.8) " id='error-phone'></div>
                </div>

                <div class="inputBox" style="margin-top:15px">
                    <input type="password" class="focus_input"  name="password" >
                    <label class="focus_label" >Password</label>
                    <div style="background-color:rgba(0, 0, 0, 0.8) " id='error-pass'></div>
            
                </div>

                 <div class="inputBox" style="margin-top:15px">
                    <input type="password" class="focus_input"  name="password_confirmation"  >
                    <label class="focus_label" >Confirm Password</label>
                    <div style="background-color:rgba(0, 0, 0, 0.8) " id='error-cpass'></div>
                </div>

                <div class="d-flex justify-content-center" >
                    <button type="submit">
                    <span></span> <span></span> <span></span> <span></span>
                    REGISTER
                    </button><br>
                </div>
                
                <div style="margin-top:5px">
                    <span class="text-white" >Already Have An Account ? <a href="login">Click Here</a></span>
                </div>
            </form>
        </div>
        {{-- <p >Already Registered ?<a href="{{route('login')}}">Click Here To Login</a></p> --}}
    </form>
</body>
    <script>
        
        $('.focus_input').focus(function (e) { 
            e.preventDefault();
            $(this).parent().find('.focus_label').css({'top':'-18px','left':0,'color':'#03a9f4','font-size':'12px'})
        });
        $('.focus_input').focusout(function (e) { 
            if($(this).val() == '')
            {
                $(this).parent().find('.focus_label').css({'top':'0','left':0,'color':'white','font-size':'16px'})
            }
        })

        $(function(){
            $('#myform').on("submit",function () {  
                var e = this;
                var email = $('#email').val();
                var password = $('#password').val();

                console.log($(this).serialize())
                $.ajax({
                    type: "post",
                    url: 'register',
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            console.log('TRUE');
                            $("#error-fname").html('');
                            $("#error-lname").html('');
                            $("#error-email").html('');
                            $("#error-pass").html('');
                            $("#error-cpass").html('');
                            $("#error-phone").html('');

                            window.location ="{{ route('login_ajax') }}?email="+email+"&password="+password;
                        }else{
                            $(".alert").remove();
                            $("#error-fname").html('');
                            $("#error-lname").html('');
                            $("#error-email").html('');
                            $("#error-pass").html('');
                            $("#error-cpass").html('');
                            $("#error-phone").html('');
                            if(response.errors.firstname)
                            {
                                $("#error-fname").html("<span class=' text-info'>* " +response.errors.firstname  + "</span>");
                            }
                            else
                            {
                                $("#error-fname").html('');
                            }
                            if(response.errors.lastname)
                            {
                                $("#error-lname").html("<span class=' text-info'>* " +response.errors.lastname  + "</span>");
                            }
                            else
                            {
                                $("#error-lname").html('')
                            }
                            if(response.errors.email)
                            {
                                $("#error-email").html("<span class=' text-info'>* " +response.errors.email[0]  + "</span>");
                            }
                            else
                            {
                                $("#error-email").html('')
                            }
                            if(response.errors.phone)
                            {
                                $("#error-phone").html("<span class=' text-info'>* " +response.errors.phone  + "</span>");
                            }
                            else
                            {
                                $("#error-phone").html('')
                            }
                            if(response.errors.password)
                            {
                                $("#error-pass").html("<span class=' text-info'>* " +response.errors.password  + "</span>");
                            }
                            else
                            {
                                $("#error-pass").html('')
                            }
                            if(response.errors.password_confirmation)
                            {
                                $("#error-cpass").html("<span class=' text-info'>* " +response.errors.password_confirmation  + "</span>");
                            }
                            else
                            {
                                $("#error-cpass").html('')
                            }

                            
                        }
                    }
                });
            })
        });
    </script>