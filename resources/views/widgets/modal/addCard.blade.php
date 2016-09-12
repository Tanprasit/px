<div class="modal fade" id="addCard">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">New Card</h4>
                  </div>
                  <!-- Modal Body -->
                  <div class="modal-body">
                        <form action="{{ route('customer.addcard', [ Auth::user()->id ]) }}" method="POST" class="form-horizontal" id="add-card-form" role="form">
                              {{ csrf_field() }}
                              <div class="form-group">
                                    <label class="col-md-4 control-label" for="name_on_card">Name on Card</label>
                                    <div class="col-md-6">
                                          <input class="form-control" type="text" name="name_on_card" placeholder="Card Holder's Name">
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-4 control-label" for="number">Card Number</label>
                                    <div class="col-md-6">
                                          <input class="form-control" type="text" name="number" placeholder="Debit/Credit Card Number" maxlength="19">
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-4 control-label" for="expiry_month">Expiration Date</label>
                                    <div class="col-md-3">
                                          <select class="form-control" name="expiry_month" id="expiry_month">
                                                 <option>Month</option>
                                                 <option value="01">Jan (01)</option>
                                                 <option value="02">Feb (02)</option>
                                                 <option value="03">Mar (03)</option>
                                                 <option value="04">Apr (04)</option>
                                                 <option value="05">May (05)</option>
                                                 <option value="06">June (06)</option>
                                                 <option value="07">July (07)</option>
                                                 <option value="08">Aug (08)</option>
                                                 <option value="09">Sep (09)</option>
                                                 <option value="10">Oct (10)</option>
                                                 <option value="11">Nov (11)</option>
                                                 <option value="12">Dec (12)</option>
                                          </select>
                                    </div>
                                    <div class="col-md-3">
                                          <select class="form-control" name="expiry_year" id="expiry-year">
                                                <option value="2013">2013</option>
                                                <option value="2014">2014</option>
                                                <option value="2015">2015</option>
                                                <option value="2016">2016</option>
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                          </select>
                                    </div>
                              </div>
                        </form>
                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="Add" onclick="document.getElementById('add-card-form').submit();">
                  </div>
            </div>
      </div>
</div>