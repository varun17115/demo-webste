
<div class="modal modal-xs fade" id="address_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content ">
        <div class="modal-header">
          <h1 class="modal-title fs-5  text-center" id="exampleModalLabel">Edit Address</h1>
          
          <button type="button" class="btn-close close-modal-btn btn" onclick="$('#address_modal').modal('hide')" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
            <form method="post" id="edit_address" >
            @csrf
                <div>
                    <div class="d-flex flex-column w-100 mt-3">
                        <label class="form-label ">Full Address</label>
                        <textarea class=" theme-border " id="address" name="address" style="border-radius: 5px !important" cols="30" rows="4"></textarea>

                    </div>
                    <div class="d-flex">
                        <div class="w-50">
                            <label>Country</label>
                                <select  name="country" id="country" class="custom-select form-control remove-text">
                                    <option selected disabled>Select a Country</option>
                                    <option value="United States" >United States</option>
                                    <option value="India">India</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Thailand">Thailand</option>
                                </select>
                            <div class="error-country"></div>
                        </div>
                        <div class="w-50">
                            <label class="form-label ">State</label>
                            <input type="text" class="form-control remove-text  "  id='state' name="state"  placeholder="Lastname"  autofocus>
                            <span id='error-state'></span>  
                        </div>                        
                          
                    </div>
                    <div class="d-flex">
                        <div class="w-50">
                            <label class="form-label ">City</label>
                            <input type="text" class="form-control remove-text "  id='city' name="city"  placeholder="Lastname"  autofocus>
                            <span id='error-state'></span>  
                        </div> 
                        <div class="w-50">
                            <label class="form-label ">Zip  Code</label>
                            <input type="text" class="form-control remove-text "  id='zip_code' name="zip_code"  placeholder="Lastname"  autofocus>
                            <span id='error-state'></span>  
                        </div>                        
                          
                    </div>
                
                </div>
            </form>
        </div>
        <div class="modal-footer">
          
          <button class="w-100 btn btn-lg btn-success"  id='update_address'  type="submit">Update</button><br>
        </div>
      </div>
    </div>
  </div>
  