<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h1 class="modal-title fs-5 " id="exampleModalLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="myform123">
                    @csrf
                    <div>
                        <div>
                            <label class="form-label ">Firstname</label>
                            <input type="text" class="form-control remove-text  " name="firstname"
                                placeholder="Firstname" autofocus>

                            <span class="remove" id='error-firstname'></span>
                        </div>

                        <div>
                            <label class="form-label ">Lastname</label>
                            <input type="text" class="form-control remove-text  " name="lastname"
                                placeholder="Lastname" autofocus>
                            <div class="remove" id='error-lastname'></div>
                        </div>

                        <div>
                            <label class="form-label ">Email address</label>
                            <input type="email" class="form-control remove-text  " id='email' name="email"
                                placeholder="name@example.com" autofocus>
                            <div class="remove" id='error-email'></div>
                        </div>

                        <div>
                            <label class="form-label ">Phone</label>
                            <input type="tel" class="form-control remove-text  " name="phone"
                                placeholder="123-123-1234" autofocus>
                            <div class="remove" id='error-phone'></div>
                        </div>


                        <div>
                            <label class="form-label ">Password</label>
                            <input type="password" class="form-control remove-text  " id='password' name="password"
                                placeholder="Password">
                            <div class="remove" id='error-password'></div>
                        </div>


                        <div>
                            <label class="form-label ">Confirm Password</label>
                            <input type="password" class="form-control remove-text  " name="password_confirmation"
                                placeholder="Confirm Password">
                            <div class="remove" id='error-password_confirmation'></div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}

                <button class="w-100 btn btn-lg " id='add_rec' style="background-color:chartreuse"
                    type="submit">ADD</button><br>
            </div>
        </div>
    </div>
</div>
