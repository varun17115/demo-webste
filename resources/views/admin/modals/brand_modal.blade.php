<div class="modal modal-xs fade" id="brand_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content ">
      <div class="modal-header">
        <h1 class="modal-title fs-5 " id="exampleModalLabel">Add Brand</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="brand_form" >
        @csrf
        <div>
            <div>
                <label class="form-label ">Brand Name</label>
                <input type="text"  class="form-control remove-text  " id="brand_name" name="brand_name"   autofocus>

                <span id='error-brand_name'></span>
            </div>

            <div>
                <label class="form-label ">Brand Description</label>
                <textarea class="form-control remove-text  "name="brand_description"id="brand_description" cols="30" rows="4"></textarea>
                <div id='error-brand_description'></div>
            </div>
            <div class="d-flex">
              <div class="d-flex align-items-center">
                <div class="w-50">
                  <label class="form-label ">Brand Photo</label>
                  <input type="file" onchange="imageinput(this)" id='image_name' class="form-control remove-text  " name="brand_image" />
                </div>
                <div class="w-50 d-flex justify-content-center flex-column">
                  <img src="{{url('download.png')}}" id='imageprev' name='imageprev' class="form-control remove-text   rounded-circle" style="height:150px;width:150px" />
                  <div id='error-brand_image'></div>
                </div>
  
              </div>
            </div>

        </div>
    </form>
      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
        
        <button class="w-100 btn btn-lg "  id='add_brand_btn'  style="background-color:chartreuse" type="submit">ADD Brand</button><br>
      </div>
    </div>
  </div>
</div>
<script>
    
</script>