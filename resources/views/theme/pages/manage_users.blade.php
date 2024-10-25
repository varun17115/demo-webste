@extends('theme.layout.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">  
            <div class="ps-4 " style="margin-top:10px">
                <div class="page-header">
                    <h3 class=" page-title">Manage Users &nbsp;</h3>
                    <div class=" d-flex float-end">
                        <button type="button" id='add_user' class="btn btn-m  text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float:right;border:0px ">
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
                        <table  class="table  border-0 text-center"  id="table" >
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
           var resp ,resp2;
function create_table(response)
{
    $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        'serverMethod': 'POST',
        'responsive':true,
        // "headers":{'CSRFToken':'{{ csrf_token() }}'},
        ajax: {
            'url': '{{ route("manage_users") }}',
            'type': 'POST',
            'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns:[
            {data: 'id',title :' Id' },
            {data: 'firstname',title :'Firstname'},
            {data: 'lastname',title :'Lastname'},
            {data: 'email',title :'Email'},
            {data: 'phone',title :'Phone'},
            {data:'user_type',title:'User Type'},
            {data: 'action', name: 'Action',title :'Action',orderable: false, searchable: false},
        ]
    });
}
$(document).ready(function () {
    create_table()

});
function delete_data(id)
{
    var box = confirm('Are You Sure Want to Delete Data');
    if(box == true)
    {
        $.ajax({
            type: "get",
            url: "delete_rec",
            data: {_token:'{{ csrf_token() }}',id:id},
            dataType: "json",
            success: function (response) {
                $('#table').DataTable().destroy()

                create_table()

            }
        });
    }
    
}
function edit_data(id)
{
    console.log(id)
    $.ajax({
        type: "post",
        url: "edit_rec",
        data: {'_token':'{{csrf_token()}}',id:id},
        dataType: "json",
        success: function (response) {
            console.log(response)
            $('#edit_modal').modal('toggle')
            image = response.data[0].image
            $('#fname-e').val(response.data[0].firstname)
            $('#lname-e').val(response.data[0].lastname)
            $('#email-e').val(response.data[0].email)
            $('#phone-e').val(response.data[0].phone)
            $('#id-e').val(response.data[0].id)
            if (image == null)
            {
                // $('#imageprev').attr('src','{{asset("default.webp")}}')
            }
            else
            {
                // $('#imageprev').attr('src',"{{url('/images')}}/"+image)
            }
        }
    });
}

$('#add_rec').on("click",function () {  
    var e = this;
    fd = new FormData($('#myform123')[0])

    $.ajax({
        type: "post",
        url: 'add_user',
        data: fd,
        contentType:false,
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        processData: false,
        dataType: "json",
        success: function (response) {
            console.log(response)
            if (response.status) {
                console.log(response);
                $("#error-fname").html('');
                $("#error-lname").html('');
                $("#error-email").html('');
                $("#error-pass").html('');
                $("#error-cpass").html('');
                $("#error-phone").html('');

                $("#exampleModal").modal('hide')
                $('#table').DataTable().destroy()

                create_table()
                
            }else{
                console.log('FALSE');

                $(".text").remove();
                if(response.errors.firstname)
                {
                    $("#error-fname").html("<span class=' text-danger'>" +response.errors.firstname  + "</span>");
                }
                else
                {
                    $("#error-fname").html('');
                }
                if(response.errors.lastname)
                {
                    $("#error-lname").html("<span class=' text-danger'>" +response.errors.lastname  + "</span>");
                }
                else
                {
                    $("#error-lname").html('')
                }
                if(response.errors.email)
                {
                    $("#error-email").html("<span class=' text-danger'>" +response.errors.email  + "</span>");
                }
                else
                {
                    $("#error-email").html('')
                }
                if(response.errors.phone)
                {
                    $("#error-phone").html("<span class=' text-danger'>" +response.errors.phone  + "</span>");
                }
                else
                {
                    $("#error-phone").html('')
                }
                if(response.errors.password)
                {
                    $("#error-pass").html("<span class=' text-danger'>" +response.errors.password  + "</span>");
                }
                else
                {
                    $("#error-pass").html('')
                }
                if(response.errors.password_confirmation)
                {
                    $("#error-cpass").html("<span class=' text-danger'>" +response.errors.password_confirmation  + "</span>");
                }
                else
                {
                    $("#error-cpass").html('')
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

function imageinput(image)
{
    const file = image.files[0]
    console.log(file);
    if(file)
    {
        let reader = new FileReader();
        reader.onload = function(event){
            $("#imageprev").attr('src',event.target.result)
            src = event.target.result
        }
        reader.readAsDataURL(file)
    }
}
$('#update').click(function (e) { 
    var fd = new FormData($('#edit_form')[0]);
    $.ajax({
        type: "post",
        url: "update_rec",
        data: fd,
        contentType:false,
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        dataType: "json",
        processData: false,
        success: function (response) {
            if (response.status) {
                console.log('TRUE');
                $("#error-fname").html('');
                $("#error-lname").html('');
                $("#error-email").html('');
                $("#error-phone").html('');
                $("#edit_modal").modal('hide')

                
                swal("Success", "Record Updated Successfully", "success");

                $('#table').DataTable().destroy()


                create_table()
                // window.location ="{{ route('show') }}";
            }else{
                if(response.errors.firstname)
                {
                    $("#error-fname-e").html("<span class=' text-danger'>" +response.errors.firstname  + "</span>");
                }
                else
                {
                    $("#error-fname-e").html('');
                }
                if(response.errors.lastname)
                {
                    $("#error-lname-e").html("<span class=' text-danger'>" +response.errors.lastname  + "</span>");
                }
                else
                {
                    $("#error-lname-e").html('')
                }
                if(response.errors.email)
                {
                    $("#error-email-e").html("<span class=' text-danger'>" +response.errors.email  + "</span>");
                }
                else
                {
                    $("#error-email-e").html('')
                }
                if(response.errors.phone)
                {
                    $("#error-phone-e").html("<span class=' text-danger'>" +response.errors.phone  + "</span>");
                }
                else
                {
                    $("#error-phone-e").html('')
                }
                
            }
        }
    });
});
    </script>
@endpush