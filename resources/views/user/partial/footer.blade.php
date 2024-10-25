<div class="container-fluid bg-dark text-secondary mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <h5 class="text-secondary text-uppercase mb-4">Get In Touch With Us</h5>
            <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no</p>
            <p class="mb-2" id="shop_address"><i class="fa fa-map-marker-alt text-primary mr-3"></i></p>
            <p class="mb-2" id="shop_email"><i class="fa fa-envelope text-primary mr-3"></i></p>
            <p class="mb-0" id="shop_phone"><i class="fa fa-phone-alt text-primary mr-3"></i></p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                        <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                    </div>
                </div>
                
                <div class="col-md-6 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                    <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control remove-text" placeholder="Your Email Address">
                            <div class="input-group-append">
                                <button class="btn btn-primary">Sign Up</button>
                            </div>
                        </div>
                    </form>
                    <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex">
                        <a class="btn btn-primary btn-square mr-2" href="#" id="twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="#" id="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="#" id="linkedin"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-primary btn-square" href="#" id="instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-secondary">
                &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                by
                <a class="text-primary" href="https://htmlcodex.com">Varun Baradia</a>
                <br>Distributed By: <a href="https://themewagon.com" target="_blank">BMAC infotech</a>
            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="{{asset('multishop_assets/img/payments.png')}}" alt="">
        </div>
    </div>
</div>
<div id="notifications"></div>
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@push('script')
    
<script>
    gst_percent = null
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });
    $.ajax({
        type: "post",
        url: "{{route('footer_details')}}",
        // data: "data",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},

        success: function (response) {
            $('#shop_address').append(response.data.shop_address)
            $('#shop_phone').append(response.data.shop_phone)
            $('#shop_email').append(response.data.shop_email)
            $('#instagram').attr('href',response.data.instagram_link)
            $('#twitter').attr('href',response.data.twitter_link)
            $('#facebook').attr('href',response.data.facebook_link)
            $('#linkedin').attr('href',response.data.linkedin_link)
            gst_percent = response.data.product_gst
        }
    });


</script>
@endpush