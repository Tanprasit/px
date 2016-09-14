<div class="modal fade" id="checkout">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Review Order</h4>
                  </div>
                  <div class="modal-body">
                        <table class="table">
                              <thead>
                                    <tr>
                                          <th class="col-md-8">Item</th>
                                          <th>Quantity</th>
                                          <th>Price</th>
                                    </tr>
                              </thead>
                              <tfoot>
                                    <tr>
                                          <td></td>
                                          <!-- TODO calculate the total price -->
                                          <td>Total</td>
                                          <td>£100</td>
                                    </tr>
                              </tfoot>
                              <tbody>
                                    <tr>
                                          <!-- TODO JS to add the items to the modal -->
                                          <td>Adult</td>
                                          <td>12</td>
                                          <td>£0.50</td>
                                    </tr>
                              </tbody>
                        </table>
                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Proceed</button>
                  </div>
            </div>
      </div>
</div>

@section('script')
      <script type="text/javascript">
            
      </script>
@endsection