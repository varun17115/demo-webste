<html lang="en">
    <head>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        @include('admin.partial.login_style')
    </head>
<body>
  <div class="login-box">
    <h1 align="center">Login</h1>
    <form method="post" onsubmit="return false" autocomplete="off" id='thisform' action="{{ route('login.login') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div class="inputBox">
            <input type="text" id='email' autocomplete="off" name="email" >
            <label id="lab-email">Email</label>
            <span id="error-email"></span><br>
        </div>
        <div class="inputBox" style="margin-top:30px">
            <input type="password" id='password' name="password" autocomplete="off" >
            <label id="lab-pass">Password</label>
            <span id="error-pass"></span>
        </div>
            <span id="error-invalid"></span><br>

        <button type="submit">
            <span></span> <span></span> <span></span> <span></span>
            LOGIN
        </button><br>
        <div style="margin-top:10px">
            <span class="text-light">Haven't register yet ? <a href="register">Click Here</a></span>
        </div>
    </form>
  </div>
</body>
<script>
        $('#email').focus(function (e) { 
            e.preventDefault();
            $('#lab-email').css({'top':'-18px','left':0,'color':'#03a9f4','font-size':'12px'});
        });
        $('#password').focus(function (e) { 
            e.preventDefault();
            $('#lab-pass').css({'top':'-18px','left':0,'color':'#03a9f4','font-size':'12px'});
        });
        $('#email').focusout(function (e) { 
            if($('#email').val() == '')
            {
                $('#lab-email').css({'top':'0','left':0,'color':'white','font-size':'16px'});
            }
        })
        $('#password').focusout(function (e) { 
            if($('#password').val() == '')
            {
                $('#lab-pass').css({'top':'0','left':0,'color':'white','font-size':'16px'});
            }
        })
    $(document).ready(function () {
        
        // $('#email').removeAttr('required')
        $('#thisform').on("submit",function () {  
            var e = this;
            var email = $('#email').val();
            var password = $('#password').val();
            $.ajax({
                type: "post",
                url:  $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                success: function (response) {
                    console.log(response.status)
                    if(response.status) {
                        console.log(true)
                        $("#error-email").html('');
                        $("#error-pass").html('');

                        window.location ="{{ route('welcome') }}";
                    }
                    else
                    {
                        console.log(response.errors)

                        if (response.errors.email) {
                            $("#error-email").html("<span class=' text-light'>" +response.errors.email  + "</span>");
                        }
                        else
                        {
                            $("#error-email").html('');
                        }
                        

                        console.log(response.errors.wrongpass);
                        if (response.errors.password) {
                            $("#error-pass").html("<span class=' text-light'>" +response.errors.password  + "</span>");
                        }
                        else
                        {
                            $("#error-pass").html('')
                        }
                       
                        console.log('here');

                        if (response.errors.wrongpass) {
                            $("#error-invalid").html("<span class=' text-light'>" +response.errors.wrongpass  + "</span>");
                        }
                        else
                        {
                            $("#error-invalid").html('')
                        }
                        
                    }
                }
            
            });
        
        
        });
    });
</script>