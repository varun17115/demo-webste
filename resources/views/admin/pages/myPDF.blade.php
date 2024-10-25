{{-- <!DOCTYPE html> --}}
{{-- <html lang="en"> --}}
    <head>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <style type="text/css">
        h2{
            text-align: center;
            font-size:22px;
            margin-bottom:50px;
        }
        body{
            background:#fff;
            padding:8px
        }
        
    </style> 
    </head>
    <body>
        <h1>User Images</h1>
        <div id="data"> 
            {{-- {{$data}} --}}
            @foreach ($data as $item)
                <img src="{{public_path('user_image').'/'.$item->image}}" style="height:200px;width:200px"><br>
                <span>Title => {{ isset($item->title)?$item->title:'Title Not Available' }}</span><br>
                <span>description => {{ isset($item->description)?$item->description:'description Not Available' }}</span><br>
                <span>Created At => {{$item->created_at}}</span>    <br>
            @endforeach    
        </div>    
    </body>
</html>
<script>
    
</script>