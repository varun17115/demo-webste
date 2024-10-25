@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="h-100 pe-4 ps-4">
            <div class="row">
                <div style="margin-top:10px">
                    <div class="page-header">
                        <h3 class=" page-title">Current Feedbacks &nbsp;</h3>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card ">
                    <div class="card-body">
                        <div style="overflow: auto" class="w-100 p-1   datatable_css table-responsive">
                            <table class="table  border-0 text-center text-truncate" id="feedbacks">
                                <thead class="thead-dark position-sticky top-0">
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
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $('#feedbacks_nav').addClass('active')

            $('#feedbacks').DataTable({
                "processing": true,
                "serverSide": true,
                'serverMethod': 'POST',
                
                // "headers":{'CSRFToken':'{{ csrf_token() }}'},
               ajax: {
                    'url': '{{ route("get_feedback_data") }}',
                    'type': 'POST',
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns:[
                    {data: 'id',title :'Feedback ID' },
                    {data: 'user_id',title :'User ID' },
                    {data: 'name',title :'Name' },
                    {data: 'email',title :'Email' },
                    {data: 'subject',title :'Subject' },
                    {data: 'message',title :'Message' ,name:'message'},
                ]
            });
        });
    </script>

@endpush