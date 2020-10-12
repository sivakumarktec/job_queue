<div class="modal fade" id="ajax-customer-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="customerCrudModal"></h4>
        </div>
        <form id="customerForm" name="customerForm" class="form-horizontal">
          <div class="modal-body">
              <input type="hidden" name="customer_id" id="customer_id">
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="required">
                </div>
              </div>
 
              <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-12">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" required="required">
                </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="btn-save" value="create">
                Save
              </button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
    </div>
  </div>
</div>