
<div class="modal fade" id="edit_title" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Edit Title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="title_form" >
        @csrf
        <div>
            <div>
                <label class="form-label text-light">Title</label>
                <input type="text" class="form-control remove-text text-light bg-dark"  name="title" id='title' placeholder="title......" autofocus>
            </div>
            <div>
                <label class="form-label text-light">Description</label>
                <textarea name="description" id="desc" class="form-control remove-text text-light bg-dark" rows="10" class="w-100" ></textarea>
            </div>
        </div>
    </form>
      </div>
      <div class="modal-footer">
        <button class="w-100 btn btn-lg " id='edit_button'  style="background-color:chartreuse" type="submit">Save</button><br>
      </div>
    </div>
  </div>
</div>