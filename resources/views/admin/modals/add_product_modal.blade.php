<div class="modal modal-xs fade" id="add_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content ">
      <div class="modal-header">
        <h1 class="modal-title fs-5 " id="exampleModalLabel">Add Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="new_product" >
        @csrf
        <div>
            <div>
                <label class="form-label ">Product Name</label>
                <input type="text"  class="form-control remove-text  " id="prod_name" name="prod_name"   autofocus>

                <span id='error-prod_name'></span>
            </div>

            <div>
                <label class="form-label ">Product Description</label>
                <textarea class="form-control remove-text  "name="prod_description" id="prod_description" cols="30" rows="1"></textarea>
                <div id='error-prod_description' class="remove"></div>
            </div>
            <div class="d-flex">
              <div class="w-50">
                <label class="form-label ">Product Quantity</label>
                <input type="number"  class="form-control remove-text  "  id="prod_quantity" name="prod_quantity"   autofocus>
                <div id='error-prod_quantity' class="remove"></div>
              </div>
              <div class="w-50">
                <label class="form-label ">Product Price</label>
                <input type="number" class="form-control remove-text  "  id="prod_price" name="prod_price"   autofocus>
                <div id='error-prod_price' class="remove"></div>
              </div>
            </div>

            <div class="d-flex">
              <div class="w-50">
                <label class="form-label ">Product Brand</label>
                <select class="form-control remove-text brand border border-1  form-select  " id="prod_brand_id" name="prod_brand_id" >
                  <option value="0" disabled selected>Select a Option</option>
              </select>
                <div id='error-prod_brand_id' class="remove"></div>
              </div>
  
              <div class="w-50" >
                  <label class="form-label ">Product Category</label>
                  <select class="form-control remove-text category border border-1  form-select  " id="prod_category_id" name="prod_category_id" >
                      <option value="0" disabled selected>Select a Option</option>
                  </select>
                  <div id='error-prod_category_id' class="remove"></div>
              </div>
            </div>
            <div class="d-flex">
              <div class=" d-flex align-items-center" >
                <div class="w-50">
                  <label class="form-label ">product Photo</label>
                  <input type="file" onchange="imageinput(this)" id='image_name' class="form-control remove-text " name="prod_image" />
                </div>
                <div class="w-50 d-flex justify-content-center flex-column" >
                  <img src="{{url('download.png')}}" id='imageprev' name='imageprev' class="form-control remove-text  rounded-circle" style="height:150px;width:150px ;margin-top:10px">
                  <div id='error-prod_image' class="remove"></div>
                </div>
              </div>

            </div>

        </div>
    </form>
      </div>
      <div class="modal-footer">
        
        <button class="w-100 btn btn-lg "  id='add_new_prod'  style="background-color:chartreuse" type="submit">ADD Product</button><br>
      </div>
    </div>
  </div>
</div>
<script>
    
</script>