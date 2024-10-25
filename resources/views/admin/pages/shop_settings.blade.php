@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="h-100 ps-4 pe-4">
            {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

            <div class="row">
                <div style="margin-top:10px">
                    <div class="page-header">
                        <h3 class=" page-title">Shop Settings &nbsp;</h3>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card ">
                    <div class="card-body">
                        <form id="settings_form" action="">
                            <div class="form-group row mb-3">
                                <label for="inputEmail3" class="col-sm-2  col-form-label">Shop Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="shop_name"  class="form-control  " id="shop_name"
                                        value="{{$data['shop_name']}}" placeholder="Shop Name">
                                </div>
                                <div class="error-shop_name remove-text"></div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputEmail3" class="col-sm-2  col-form-label">Shop Address</label>
                                <div class="col-sm-10">

                                    <input type="text"  name="shop_address" class="form-control  " id="shop_address"
                                        value="{{$data['shop_address']}}" placeholder="Shop Address">
                                </div>
                                <div class="error-shop_address remove-text"></div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputEmail3" class="col-sm-2  col-form-label">Shop Phone</label>
                                <div class="col-sm-10">
                                    <input type="text"  name="shop_phone" class="form-control  " id="shop_phone"
                                        value="{{$data['shop_phone']}}" placeholder="Shop Phone">
                                </div>
                                
                                <div class="error-shop_phone remove-text"></div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputEmail3" class="col-sm-2  col-form-label">Shop Email</label>
                                <div class="col-sm-10">
                                    <input type="text"  name="shop_email" class="form-control  " id="shop_email"
                                        value="{{$data['shop_email']}}" placeholder="Shop Email">
                                </div>
                                <div class="error-shop_email remove-text"></div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputEmail3" class="col-sm-2  col-form-label">Product GST</label>
                                <div class="col-sm-10">
                                    <input type="text"  name="product_gst" class="form-control  " id="product_gst"
                                        value="{{$data['product_gst']}}" placeholder="Gst Count">
                                </div>
                                <div class="error-product_gst remove-text"></div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputEmail3" class="col-sm-2  col-form-label">Twitter link</label>
                                <div class="col-sm-10">
                                    <input type="text"   name="twitter_link" class="form-control  " id="twitter_link"
                                        value="{{$data['twitter_link']}}" placeholder="Twitter link">
                                </div>
                                <div class="error-twitter_link remove-text"></div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputEmail3"   class="col-sm-2  col-form-label">Facebook
                                    link</label>
                                <div class="col-sm-10">
                                    <input type="text" name="facebook_link" class="form-control  " id="facebook_link"
                                        value="{{$data['facebook_link']}}" placeholder="Facebook link">
                                </div>
                                <div class="error-facebook_link remove-text"></div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputEmail3"  class="col-sm-2  col-form-label">Linkedin
                                    Link</label>
                                <div class="col-sm-10">
                                    <input type="text" name="linkedin_link" class="form-control  " id="linkedin_link"
                                        value="{{$data['linkedin_link']}}" placeholder="Linkedin Link">
                                </div>
                                <div class="error-linkedin_link remove-text"></div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputEmail3"  class="col-sm-2  col-form-label">Instagram
                                    Link</label>
                                <div class="col-sm-10">
                                    <input type="text" name="instagram_link" class="form-control  " id="instagram_link"
                                        value="{{$data['instagram_link']}}" 
                                        placeholder="Instagram Link">
                                </div>
                                <div class="error-instagram_link remove-text"></div>
                            </div>
                            <div class="form-group row mb-3">
                                <button id="save_settings" type="submit"  class="btn btn-info ">Save Settings</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        
        $(document).ready(function() {
            $('#settings_nav').addClass('active')
            
           
            $('#save_settings').click(function(e) {
                e.preventDefault();
                console.log('saving Settings ..')
                $.ajax({
                    type: "post",
                    url: "{{ route('save_settings') }}",
                    data: $('#settings_form').serialize(),
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},

                    dataType: "json",
                    success: function (response) {
                        if(response.errors)
                        {
                            $.each(response.errors, function (key, value) {
                                
                                $('.error-'+key).html('<span class="text-danger">'+value+'</span>')
                            })
                        }
                        else
                        {
                            console.log('success')
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Settings Saved Successfully',
                                
                            })
                        }
                    }
                });
                
            });
            $('#settings_form .form-control').change(function (e) { 
                e.preventDefault();
                $(this).parent().parent().children().last().html('')
            });
        });
    </script>
@endpush
