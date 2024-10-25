<script>
    function delete_record(id)
    {
        console.log(id)
        var txt;
        var box = confirm('Are You Sure Want to Delete Data');
        
        if(box == true)
        {
            window.location.href='delete_rec/'+id
        }
    
    }
    
    $('#md-menu').click(function (e) { 
        if($('#body').hasClass('sidebar-icon-only'))
        {
            console.log('yes')
            $('#fixed-nav').addClass('fixed-nav')
        }
        else
        {
            $('#fixed-nav').removeClass('fixed-nav')
    
        }
    });
                
    </script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
    
    <script src="{{asset('sneat_assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('sneat_assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('sneat_assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    
    <script src="{{asset('sneat_assets/vendor/js/menu.js')}}"></script>
    
    <script src="{{asset('sneat_assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    
    <script src="{{asset('sneat_assets/js/main.js')}}"></script>
    
    <script src="{{asset('sneat_assets/js/dashboards-analytics.js')}}"></script>
    
    
    