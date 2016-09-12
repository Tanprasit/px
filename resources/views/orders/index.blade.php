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
                                    <a data-toggle="tooltip" data-placement="bottom" title="View available services" href="#">
                                          Services
                                    </a>
                              </li>
                              <li>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Review & modify your recent orders" href="#">
                                          Orders<span class="sr-only">(current)</span>
                                    </a>
                              </li>
                              <li>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Update your account settings" href="#">
                                          Settings
                                    </a>
                              </li>
                        </ul>
                  </div>

                  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                        <h1 class="page-header">Outstanding Orders</h1>
                        <div class="row">
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