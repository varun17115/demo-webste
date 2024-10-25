@extends('theme.layout.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">

    <div class="d-flex ps-4 pe-4 flex-column">
        <div class="row ">  
            <div style="margin-top:10px">
                <div class="page-header">
                    <h3 class=" page-title">Gallery &nbsp;</h3>
                    <div class=" d-flex float-end">
                        <button class="btn btn-l btn-success text-light me-2" id="slide_show"><span class="mdi fs-5 mdi-play-box-outline"></span></button>
                        <button class=" btn btn-l btn-success text-light"  id="download"><span class="mdi fs-5 mdi-download"></span></button>
                    </div>
                </div>
            </div>     
        </div>

        <div >
            
        </div>
        <section id="loading">
            <div id="loading-content"></div>
        </section>
        <div class="row">
            <div class="card ">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-center">
                        <form method="post" id="image_form" onsubmit="return false" enctype="multipart/form-data">
                            <input style="width:50%" class="d-inline-block form-control remove-text " type="file" name="images[]" id="images" multiple>
                            <input class="btn btn-l btn-info" type="submit" value="SUBMIT"><br>
                        </form>
                    </div>
                    <div id='display_images'></div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
{{-- @include('admin.modals.image_slider_modal') --}}
{{-- @include('admin.modals.edit_title') --}}
@push('script')
    <script>
    var image_id;
        showLoading()
        $(document).ready(function () {
            $.ajax({
                type: "post",
                url: "{{route('all_images_get')}}",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                data: "",
                dataType: "json",
                success: function (response) {
                    console.log(response)
                    if(response.images.length)
                    {
                        for (let index = 0; index < response.images.length; index++) {
                            $('#display_images').append(`<div class="main-div card flex-column d-inline-flex position-relative align-top">
                            <a onclick="edit_title(`+response.images[index].id+`)"><div class="image_div d-flex justify-content-center align-content-center flex-wrap">
                            <img id="user_image" class="d-block" src="{{url('user_image')}}/`+response.images[index].image+`">
                            </div><button onclick="delete_image(`+response.images[index].id+`,this)"  class="delete_btn btn btn-m m-0 p-0 top-0 end-0 bg-danger position-absolute rounded-circle"></a>
                            <span class="mdi  mdi-window-close"></span></button>
                            <span id="`+response.images[index].id+`_title" class="text-nowrap title  fw-bold text-center overflow-hidden text-truncate align-items-center d-inline-block"></span>
                            <span class="d-inline-block text-nowrap  description w-50 align-self-center text-center overflow-hidden text-truncate " id="`+response.images[index].id+`_desc"></span></div>`)

                            $('#'+response.images[index].id+'_title').html(response.images[index].title)
                            $('#'+response.images[index].id+'_desc').html(response.images[index].description)

                        }

                    }
                    hideLoading()
                }
            });
        });
        $('#image_form').submit(function (e) { 
            showLoading()
            e.preventDefault();
            fd = new FormData(this)
            id = '{{Auth::user()->id}}'
            fd.append('id',id);
            $.ajax({
                type: "post",
                url: "{{route('add_images')}}",
                data: fd,
                processData: false,
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                contentType:false,

                dataType: "json",
                success: function (response) {
                    console.log(response)
                    $('#images').val('')
                    for (let index = 0; index < response.images.length; index++) {
                        $('#display_images').append(`<div class="main-div flex-column d-inline-flex position-relative align-top">
                            <a onclick="edit_title(`+response.id[index]+`)"><div class="image_div w-100  d-flex justify-content-center align-content-start flex-wrap">
                            <img id="user_image" class="d-block" src="{{url('user_image')}}/`+response.images[index]+`">
                            </div><button onclick="delete_image(`+response.id[index]+`,this)"  class="delete_btn top-0 end-0 bg-danger position-absolute rounded-circle"></a><span class="mdi text-light mdi-window-close"></span><i class="text-light fa fa-times" aria-hidden="true"></i></button>
                            <span id="`+response.id[index]+`_title" class="text-nowrap title text-light fw-bold text-center overflow-hidden text-truncate align-items-center d-inline-block"></span>
                            <span class="d-inline-block text-nowrap text-light description w-50 align-self-center text-center overflow-hidden text-truncate " id="`+response.id[index]+`_desc"></span></div>`)

                    }
                    hideLoading()

                }
            });
        });
        function delete_image(params,elem) {
            console.log(params)
            var box = confirm('Are You Sure Want to Delete Data');
            if (box == true)
            {
                $.ajax({
                    type: "post",
                    url: "{{route('delete_image')}}",
                    data: {'id':params},
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    dataType: "json",
                    success: function (response) {
                        hideLoading()
                        if (response.status) {
                            $(elem).parent().remove()
                        }
                    }       
                });
            }
            
            
        }
function showLoading() {
  document.querySelector('#loading').classList.add('loading');
  document.querySelector('#loading-content').classList.add('loading-content');
}

function hideLoading() {
  document.querySelector('#loading').classList.remove('loading');
  document.querySelector('#loading-content').classList.remove('loading-content');
}
function edit_title(param)
{
    console.log(param)
    image_id = param
    $.ajax({
        type: "post",
        url: "{{route('show_edit_title')}}",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        data: {'id':param},
        dataType: "json",
        success: function (response) {
            $('#edit_title').modal('toggle')
            $('#title').val(response.data[0].title)
            $('#desc').val(response.data[0].description)
        }
    });
}
$('#edit_button').click(function (e) { 
    e.preventDefault();
    fd = new FormData($('#title_form')[0])
    fd.append('id',image_id)
    $.ajax({
        type: "post",
        url: "{{route('update_title')}}",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        data: fd,
        dataType: "json",
        contentType:false,
        processData: false,
        success: function (response) {
            console.log(response)
            if(response.status)
            {
                $('#edit_title').modal('hide')
                $('#'+image_id+'_title').html($('#title').val())
                $('#'+image_id+'_desc').html($('#desc').val())

            }
        }
    });
});
$('#slide_show').click(function (e) { 
    e.preventDefault();

    showLoading()
    $.ajax({
        type: "post",
        url: "{{route('all_images_get')}}",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        dataType: "json",
        success: function (response) {
            $('#image_slider').modal('toggle')
            $('.slideshow-container').html('')
            hideLoading()
            if(response.images.length)
            {
                for (let i = 0; i < response.images.length; i++) {
                // console.log(response.images[0])
                text = ""
                    if(response.images[i].title != null)
                    {
                        text = response.images[i].title
                    }
                    else
                    {
                        text = ""
                    }
                    if(response.images[i].description != null)
                    {
                        text2 = response.images[i].description
                    }
                    else
                    {
                        text2 = ""
                    }
                    $('.slideshow-container').append('<div class="mySlides w-100 justify-content-center flex-column" ><img class="slide_image" src={{url("user_image")}}/'+response.images[i].image+' style="margin:auto"><div class="text text-light fs-5 text-center text-truncate"><span>'+text+'</span><br><span>'+text2+'</span></div>')
                
                }
        	showSlides(1);
            }
            else
            {
                $('.slideshow-container').html('Please Add Some Images')
                $('.slideshow-container').css({'color':'white','font-size':'30px','font-weight':'600'})
            }

        }
    });
    
});
$('#download').click(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "{{route('generate_pdf')}}",
        data: {'id':'{{Auth::user()->id}}'},
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        xhrFields: {
                responseType: 'blob'
            },
        success: function (response) {
            var blob = new Blob([response]);
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = "{{time()}}"+"{{Auth::user()->firstname}}"+".pdf";
            link.click();
        }
    });
});
    </script>
@endpush