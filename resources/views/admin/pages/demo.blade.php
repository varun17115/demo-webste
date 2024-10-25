@include('admin.partial.header')
<head>
  <script src="https://cdn.jsdelivr.net/gh/igorlino/elevatezoom-plus@1.2.3/src/jquery.ez-plus.js"></script>
</head>
<img class="m-4" src="{{url('storage/images')}}/1679645841.jpg" id="zoom_01" style="height:400px;width:800px" alt="">
<script>
  $('#zoom_01').ezPlus(); 
</script>