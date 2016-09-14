@extends('layouts.master')

@section('css')
      <link rel="stylesheet" href="/css/dashboard.css">
@endsection

@section('body')
      <div class="container-fluid">
            <div class="row">
                  <div class="col-sm-3 col-md-2 sidebar">
                        <ul class="nav nav-sidebar">
                              <li class="active">
                                    <a data-toggle="tooltip" data-placement="bottom" title="View available services" href="{{ route('dashboard') }}">
                                          Services<span class="sr-only">(current)</span>
                                    </a>
                              </li>
                              <li>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Review & modify your recent orders" href="{{ route('customer.orders', [ Auth::user()->id ]) }}">
                                          Orders
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
                        <h1 class="page-header">Ironing Service <a class="btn btn-primary pull-right" href="#">Continue</a></h1>
                        <div class="row">
                              <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                    <div class="thumbnail">
                                          <div class="caption text-center">
                                                @foreach($orders as $order)
                                                <h3 class="text-uppercase">{{ $order->name }}</h3>
                                                <hr>
                                                <p>{{ $order->price }}</p>
                                                <hr>
                                                <input class="form-control" type="text" value="0">
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
@endsection

@section('script')
      <script type="text/javascript">
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
      </script>
@endsection