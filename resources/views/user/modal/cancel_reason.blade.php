<div class="modal modal-xs fade" id="cancel_reason-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <div class="modal-header">
                <h3 class="modal-title fs-5  text-center" id="exampleModalLabel">Give Reason For Cancellation</h3>

                <button type="button" class="btn-close close-modal-btn btn" onclick="$('#cancel_reason').modal('hide')"
                    data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <form method="post" id="cancel_form">
                    @csrf
                    <div class="d-flex flex-column">
                        <div class="w-100">
                            <label>Reason For Cancellation</label>
                            <select  id="reason" class=" text-dark form-control ">
                                <option value="" selected disabled>Give A Reason</option>
                                <option value="Too late">Too late</option>
                                <option value="Mind Changed">Mind Changed</option>
                                <option value="Dissatisfaction">Dissatisfaction</option>
                                <option value="Personal reasons">Personal reasons</option>
                                <option value="Other">Other</option>

                            </select>
                            <div class="error-div"></div>
                        </div>
                        <div class=" w-100 mt-3" style="display:none" id="reason_box">
                            <label class="form-label ">Enter Reason</label>
                            <textarea class=" theme-border w-100" id="reason_text"  name="reason" style="border-radius: 5px !important" cols="30"
                                rows="4"></textarea>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

                <button class="w-100 btn btn-lg btn-success" id='cancel_reason-btn' type="submit">Submit</button><br>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $('#reason').change(function (e) { 
            // e.preventDefault();

            if($(this).val() == 'Other')
            {
                $('#reason_box').show()
            }        
            else
            {
                $('#reason_box').hide()
            }    
        });
        

    </script>
@endpush