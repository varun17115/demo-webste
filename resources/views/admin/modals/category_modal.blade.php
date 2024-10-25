<div class="modal modal-xs fade" id="category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h1 class="modal-title fs-5 " id="exampleModalLabel">Add Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="category_form" >
        @csrf
        <div>
            <div>
                <label class="form-label ">Category Name</label>
                <input type="text"  class="form-control remove-text  " id="cat_name" name="cat_name"   autofocus>

                <span id='error-cat_name'></span>
            </div>

            <div>
                <label class="form-label ">Category Description</label>
                <textarea class="form-control remove-text  "name="cat_description" id="cat_description" cols="30" rows="4"></textarea>
                <div id='error-cat_description'></div>
            </div>
            <div class="d-flex">
              <div class="d-flex align-items-center">
                <div class="w-50">
                    <label class="form-label ">Category Photo</label>
                    <input type="file" onchange="imageinput(this)" id='image_name' class="form-control remove-text  " name="cat_image" />
                </div>
                <div class="w-50 d-flex flex-column justify-content-center">
                    <img src="{{url('download.png')}}" id='imageprev' name='imageprev' class="form-control remove-text   rounded-circle" style="height:150px;width:150px" />
                    <br><div id='error-cat_image'></div>
                </div>
  
              </div>
            </div>

        </div>
    </form>
      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
        
        <button class="w-100 btn btn-lg "  id='add_cat_btn'  style="background-color:chartreuse" type="submit">ADD Category</button><br>
      </div>
    </div>
  </div>
</div>
<script>
    
</script>