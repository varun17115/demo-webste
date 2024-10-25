
<div class="modal modal-xs fade" id="view_order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title fs-5  text-center" id="exampleModalLabel"></h4>
          
          <button type="button" class="btn-close close-modal-btn btn" onclick="$('#view_order').modal('hide')" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
            <form method="post" id="edit_address" >
            @csrf
                <div>
                    
                    <div class="col-md-12 text-center table-responsive mb-5">
                        
                        <table class="table table-light text-start table-borderless table-hover  mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle" id="cart_body">
                               
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="row flex-column">
                            <h5 class="section-title text-center position-relative text-uppercase mb-3">
                                <span class="bg-secondary pr-3">Order Details</span>
                            </h5>
                            <div class="bg-light  mb-2">
                                <div class=" ">
                                    <div class="d-flex justify-content-between ">
                                        <h6>Order Date</h6>
                                        <h6 id="order-date"></h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>Order Id</h6>
                                        <h6 id="order-id"></h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>Payment Type</h6>
                                        <h6 id="payment-type"></h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>Address</h6>
                                        <h6 id="address"></h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>Country</h6>
                                        <h6 id="country"></h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>State</h6>
                                        <h6 id="state"></h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>City</h6>
                                        <h6 id="city"></h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>Zip Code</h6>
                                        <h6 id="zip-code"></h6>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                
                </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>
  