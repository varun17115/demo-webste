<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h1 class="modal-title fs-5 " id="exampleModalLabel">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" id='edit_form' onsubmit="return false" enctype="multipart/form-data">

                    @csrf
                    <div>
                        <div class="d-flex">
                            <div class="w-50">
                                <label class="form-label ">Firstname</label>
                                <input type="text" class="form-control remove-text  " id='firstname-e'
                                    name="firstname" placeholder="Firstname" autofocus>
                                <span id='error-firstname-e'></span>
                            </div>
                            <div class="w-50">
                                <label class="form-label ">Lastname</label>
                                <input type="text" class="form-control remove-text  " id='lastname-e' name="lastname"
                                    placeholder="Lastname" autofocus>
                                <span id='error-lastname-e'></span>
                            </div>

                        </div>
                        <div>
                            <label class="form-label ">Email address</label>
                            <input type="email" class="form-control remove-text  " id='email-e' name="email"
                                placeholder="name@example.com" autofocus>
                            <span id='error-email-e'></span>

                        </div>
                        <div>
                            <label class="form-label ">Phone</label>
                            <input type="tel" class="form-control remove-text  " id='phone-e' name="phone"
                                placeholder="123-123-1234" autofocus>
                            <span id='error-phone-e'></span>

                        </div>
                        <div>
                            <div>
                                <label class="form-label ">Profile Photo</label>
                                <input type="file" onchange="imageinput(this)" id='image'
                                    class="form-control remove-text  " name="image" />
                                <div class="d-flex justify-content-center">
                                    <img src="#" id='imageprev' name='imageprev'
                                        class="form-control remove-text   rounded-circle"
                                        style="height:200px;width:200px" />

                                </div>
                            </div>

                        </div>

                        <input type="hidden" class="form-control remove-text  " value="" name="id"
                            id='id-e' placeholder="123-123-1234" autofocus>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button id="update" class="w-100 btn btn-lg" style="background-color:aqua"
                    type="submit">Update</button><br>

            </div>
        </div>
    </div>
</div>
