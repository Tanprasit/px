<div class="modal fade" id="add-address">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add New Address</h4>
                  </div>
                  <!-- Modal Body -->
                  <div class="modal-body">
                        <form action="{{ route('addresses.create') }}" method="POST" class="form-horizontal" id="add-address-form" role="form">
                              {{ csrf_field() }}
                              <div class="form-group">
                                    <label class="col-md-4 control-label" for="number">Address Line 1</label>
                                    <div class="col-md-6">
                                          <input class="form-control" type="text" name="address_line_1" placeholder="" required autofocus>
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-4 control-label" for="number">Address Line 2</label>
                                    <div class="col-md-6">
                                          <input class="form-control" type="text" name="address_line_2" placeholder="">
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-4 control-label" for="number">Town / City</label>
                                    <div class="col-md-6">
                                          <input class="form-control" type="text" name="town_city" placeholder="" required>
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-4 control-label" for="number">County</label>
                                    <div class="col-md-6">
                                          <input class="form-control" type="text" name="county" placeholder="" required>
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-4 control-label" for="number">Postcode</label>
                                    <div class="col-md-6">
                                          <input class="form-control" type="text" name="postcode" placeholder="" required>
                                    </div>
                              </div>
                        </form>
                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="Add" onclick="document.getElementById('add-address-form').submit();">
                  </div>
            </div>
      </div>
</div>