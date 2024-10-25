@extends('user.layout.app')
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{route('display_main')}}">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Setting</a>
                <span class="breadcrumb-item active">Manage Addreses</span>
            </nav>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <div class="card card-body bg-light mb-30">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="h4 mb-30">Manage Addresses</h2>
                        <div class="table-responsive">
                            <table class="table text-center table-bordered table-hover table-striped table-checkable" id="address_table">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
@include('user.modal.edit_address')
@endsection
@push('script')
<script>
    address_id = null
    $(document).ready(function() {
        console.log('Doc Ready')
        var table = $('#address_table').DataTable({
            "processing": true,
            "serverSide": true,
            'serverMethod': 'POST',
            "ajax": {
                "url": "{{route('get_address')}}",
                "type": "post",
                'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                "columns": [
                    {data: "address_id",title:"#"},
                    {data: "address",title:"Address"},
                    {data: "country",title:"Country"},
                    {data: "state",title:"State"},
                    {data: "city",title:"City"},
                    {data: "zip_code",title:"Zip Code"},
                    {data: 'action', name: 'Action',title :'Action',orderable: false, searchable: false},

                ],
                
            });
        })
        function edit_address(id) {
            console.log(id)
            $.ajax({
                    type: "post",
                    url: "{{route('edit_address')}}",
                    data: {id: id},
                    dataType:"json",
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    success: function(data) {
                        console.log(data[0])
                        $('#address_modal').modal('show')
                        $.each(data[0], function (key, value) { 
                            $('#'+key).val(value)
                        });
                       
                        address_id = data[0].address_id
                    }
                });
        }
        function delete_address(id) {
            Swal.fire({
                icon: 'error',
                title: 'Are You Sure You Want To Delete Address ?',
                showCancelButton: true,
                denyButtonText: `Cancel`,
                confirmButtonText: 'Sure',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    type: "post",
                    url: "{{route('delete_address')}}",
                    data: {id: id},
                    dataType:"json",
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    success: function(data) {
                        console.log(data)
                            $('#address_table').DataTable().ajax.reload()
                        }
                    });
                   
                }
            })

        }


        $('#update_address').click(function (e) { 
            fd = new FormData($('#edit_address')[0])
            fd.append('update',true)
            fd.append('id',address_id)
            $.ajax({
                type: "post",
                url: "{{route('save_address')}}",
                data: fd,
                dataType: "json",
                contentType:false,
                processData: false,
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                success: function (response) {
                    if(response.errors)
                    {
                        $.each(response.errors, function (key, value) {
                            console.log('#error-'+key)
                            $('.error-'+key).html('<span class="text-danger">'+value+'</span>')
                        })
                    }
                    else
                    {
                        Swal.fire({
                            icon: 'success',
                            title: 'Address Updated Successfully',
                            
                        })
                        $('#address_modal').modal('hide')
                        $('#address_table').DataTable().ajax.reload()

                    }
                }
            });                
            
        });
        
</script>
@endpush