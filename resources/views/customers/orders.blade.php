@extends('layouts.master')

@section('css')
      <link rel="stylesheet" href="/css/dashboard.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
@endsection

@section('body')
      <div class="container-fluid">
            <div class="row">
                  <div class="col-sm-3 col-md-2 sidebar">
                        <ul class="nav nav-sidebar">
                              <li>
                                    <a data-toggle="tooltip" data-placement="bottom" title="View available services" href="{{ route('orders.index') }}">
                                          Services
                                    </a>
                              </li>
                              <li class="active">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Review & modify your recent orders" href="{{ route('customer.orders', [ Auth::user()->id ]) }}">
                                          Orders<span class="sr-only">(current)</span>
                                    </a>
                              </li>
                              <li>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Update your account settings" href="{{ route('customers.edit', [ Auth::user()->id ]) }}">
                                          Settings
                                    </a>
                              </li>
                        </ul>
                  </div>

                  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                        @if(\Session::has('message'))
                              <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <p>{!! \Session::get('message') !!}</p>
                              </div>
                        @endif
                        <h1 class="page-header">Outstanding Orders</h1>
                        <table  class="display" cellspacing="0" width="100%" id="outstanding-order-table">
                              <thead>
                                    <tr>
                                          <th>
                                                Order Date
                                          </th>
                                          <th>
                                                Delivery Date
                                          </th>
                                          <th>
                                                Order Number
                                          </th>
                                          <th>
                                                Service(s)
                                          </th>
                                          <!-- Action to view the order -->
                                          <th>
                                          </th>
                                    </tr>
                              </thead>
                              <tbody>
                                    @foreach($outstandingOrders as $order)
                                          <tr>
                                                <td>{{ $order->pivot->order_date }}</td>
                                                <td>{{ $order->pivot->delivery_date }}</td>
                                                <td><a href="#">{{ $order->id }}</a></td>
                                                <td>{{ $order->name }} <small>{{ $order->description }}</small></td>
                                                <td></td>
                                          </tr>
                                    @endforeach
                              </tbody>
                        </table>
                        <h1 class="page-header">Completed Orders</h1>
                        <table  class="display" cellspacing="0" width="100%" id="completed-order-table">
                              <thead>
                                    <tr>
                                          <th>
                                                Order Date
                                          </th>
                                          <th>
                                                Delivery Date
                                          </th>
                                          <th>
                                                Order Number
                                          </th>
                                          <th>
                                                Service(s)
                                          </th>
                                          <!-- Action to view the order -->
                                          <th>
                                          </th>
                                    </tr>
                              </thead>
                              <tbody>
                                    @foreach($completedOrders as $order)
                                           <tr>
                                                 <td>{{ $order->pivot->order_date }}</td>
                                                 <td>{{ $order->pivot->delivery_date }}</td>
                                                 <td><a href="#">{{ $order->id }}</a></td>
                                                 <td>{{ $order->name }} <small>{{ $order->description }}</small></td>
                                                 <td></td>
                                           </tr>
                                    @endforeach
                              </tbody>
                        </table>
                  </div>
            </div>
      </div>
@endsection

@section('script')
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript">
            $(function () {
              $('[data-toggle="tooltip"]').tooltip();
              $('#outstanding-order-table, #completed-order-table').DataTable({
                "scrollX": true
              });
            })
      </script>
@endsection