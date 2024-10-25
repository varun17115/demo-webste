
<div class="modal modal-xs fade" id="register_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content bg-dark">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-light text-center" id="exampleModalLabel">Register</h1>
          
          <button type="button" class="btn-close close-modal-btn btn" onclick="$('#register_modal').modal('hide')" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
          <form method="post" id="register_form" >
          @csrf
          <div>
            <div>
                <label class="form-label text-light">Firstname</label>
                <input type="text"  class="form-control remove-text bg-dark text-light" id="firstname" name="firstname"   autofocus>
                <span id='error-firstname'  class="form-error"></span>
            </div>
  
            <div>
                <label class="form-label text-light">lastname</label>
                <input type="text"  class="form-control remove-text bg-dark text-light" id="lastname" name="lastname"   autofocus>

                <div id='error-lastname'  class="form-error"></div>
            </div>
            <div>
                <label class="form-label text-light">Email</label>
                <input type="text"  class="form-control remove-text bg-dark text-light" id="email" name="email"   autofocus>

                <div id='error-email'  class="form-error"></div>
            </div>
            <div>
                <label class="form-label text-light">Phone Number</label>
                <input type="number"  class="form-control remove-text bg-dark text-light" id="phone" name="phone"   autofocus>

                <div id='error-phone'  class="form-error"></div>
            </div>
            <div>
                <label class="form-label text-light">Password</label>
                <input type="password"  class="form-control remove-text bg-dark text-light" id="pass" name="pass"   autofocus>

                <div id='error-pass'  class="form-error"></div>
            </div>
            <div>
                <label class="form-label text-light">Confirm Password</label>
                <input type="password"  class="form-control remove-text bg-dark text-light" id="cpass" name="cpass"   autofocus>

                <div id='error-cpass'  class="form-error"></div>
            </div>
            <div>
                <span class="text-light">Already have an account ? <button type="button" class="btn border-0 text-primary open_login_modal"  >Click To Login</button></span>
            </div>
          </div>
      </form>
        </div>
        <div class="modal-footer">
          
          <button class="w-100 btn btn-lg btn-success"  id='user_register'  type="submit">Register</button><br>
        </div>
      </div>
    </div>
  </div>
