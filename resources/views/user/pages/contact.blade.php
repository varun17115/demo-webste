@extends('user.layout.app')
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{route('display_main')}}">Home</a>
                <span class="breadcrumb-item active">Contact</span>
            </nav>
        </div>
    </div>
</div>
<div class="container-fluid">
    <h2 class="section-title position-relative text-center text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pl-3 pr-3">Contact Us</span></h2>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form bg-light p-30">
                <div id="success"></div>
                <form name="sentMessage" id="contactForm" novalidate="novalidate">
                    <div class="control-group">
                        <input type="text" class="form-control remove-text" name="name" id="name" placeholder="Your Name"
                             />
                        <p class="error-con_name text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="email" class="form-control remove-text" name="email" id="email" placeholder="Your Email"
                             />
                        <p class="error-con_email text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="text" class="form-control remove-text" name="subject" id="subject" placeholder="Subject"
                             />
                        <p class="error-con_subject text-danger"></p>
                    </div>
                    <div class="control-group">
                        <textarea class="form-control remove-text" rows="8" name="message" id="message" placeholder="Message"
                            ></textarea>
                        <p class="error-con_message text-danger"></p>
                    </div>
                    <div>
                            @if (Auth::user())
                                <button class="btn btn-primary py-2 px-4" type="submit" id="message_button">Send
                                Message</button>
                                
                            @else
                                <button onclick="alert('Please Login To Send Feedback')" class="btn btn-primary py-2 px-4" type="submit" >Send
                                Message</button>
                            @endif
                            
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <div class="bg-light p-30 ">
                <div id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
                    <div id="map-9cd199b9cc5410cd3b1ad21cab2e54d3"></div><script>(function () {
                    var setting = {"height":350,"width":400,"zoom":15,"queryString":"BMAC Infotech, Ayodhya Chowk, opp. Synergy Hospital, Vasundhara Omkar Society, Manharpura 1, Madhapar, Rajkot, Gujarat, India","place_id":"ChIJw3ZBZRLKWTkRwDJwkh-MuxU","satellite":false,"centerCoord":[22.321632556519976,70.76698274999998],"cid":"0x15bb8c1f927032c0","lang":"en","cityUrl":"/india/rajkot-35209","cityAnchorText":"Map of Rajkot, West Zone, India","id":"map-9cd199b9cc5410cd3b1ad21cab2e54d3","embed_id":"918745"};
                    var d = document;
                    var s = d.createElement('script');
                    s.src = 'https://1map.com/js/script-for-user.js?embed_id=918745';
                    s.async = true;
                    s.onload = function (e) {
                      window.OneMap.initMap(setting)
                    };
                    var to = d.getElementsByTagName('script')[0];
                    to.parentNode.insertBefore(s, to);
                  })();</script><a href="https://1map.com/map-embed">1 Map</a></div>
            
            <div class="bg-light p-20 ">
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $('.remove-text').change(function (e) { 
            // e.preventDefault();
            $(this).parent().find('.text-danger').html('')
        });
        
        $('#message_button').click(function (e) { 
            e.preventDefault();
            fd = new FormData($('#contactForm')[0])
            $.ajax({
                type: "post",
                contentType:false,
                processData: false,
                url: "{{route('get_feedback')}}",
                data: fd,
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                dataType: "json",
                success: function (response) {
                    if(response.errors)
                    {
                        if (response.errors.name) {
                            $('.error-con_name').html('This Field Is Required')
                        }
                        if (response.errors.email) {
                            $('.error-con_email').html(response.errors.email )
                        }
                        if (response.errors.message) {
                            $('.error-con_message').html('This Field Is Required')
                        }
                        if (response.errors.subject) {
                            $('.error-con_subject').html('This Field Is Required')
                        }

                        $.each(response.errors, function (key, value) { 
                             $('.error-con_'+key).html(value)
                        });
                    }
                    else
                    {
                        // $.notify("Thank You For Your Feeback !!");
                        Swal.fire({
                            title: 'Thank You For your Feedback',
                            type: 'success',
                            icon:'success'
                            
                        })
                        $('.form-control .remove-text').val('')
                    }
                }
            });
        });    
    </script>   
@endpush