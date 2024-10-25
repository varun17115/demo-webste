
<div class="modal modal-xs fade" id="login_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-light text-center" id="exampleModalLabel">Login</h1>
        
        <button type="button" class="btn-close close-modal-btn btn" onclick="$('#login_modal').modal('hide')" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
      </div>
      <div class="modal-body">
        <form method="post" id="login_form" >
        @csrf
        <div>
            <div>
                <label class="form-label text-light">Email</label>
                <input type="text"  class="form-control remove-text  bg-dark text-light" id="email-l" name="email-l"   autofocus>
                <span id='error-email-l ' class="form-error"></span>
            </div>

            <div>
                <label class="form-label text-light">Password</label>
                <input type="password"  class="form-control remove-text bg-dark  text-light" id="password-l" name="password-l"   autofocus>

                <div id='error-pass-l ' class="form-error"></div>
            </div>
            <div>
                <span class="text-light">didn"t have an account ? <button type="button" class="btn border-0 text-primary open_register_modal"  href="">Click To Register</button></span>
            </div>
        </div>
    </form>
      </div>
      <div class="modal-footer">
        
        <button class="w-100 btn btn-lg btn-success"  id='user_login_modal'  type="submit">Login</button><br>
      </div>
    </div>
  </div>
</div>
