@extends('layouts.master')

<!-- Add custom css -->
@section('css')
      <link rel="stylesheet" href="css/service.css">
@endsection

<!-- Display a list of services that are available on the site -->
@section('body')
      <div class="row">
            <div class="col-md-6 col-md-offset-3">
                  <div class="panel panel-default">
                        <div class="panel-heading">
                              <h5 class="text-center">
                                    DOMESTIC CLEANING
                              </h5>
                        </div>
                        <div class="panel-body domestic-body-bg">
                              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                              <!-- TODO: For loop for services will go here -->
                                    <div class="thumbnail">
                                          <div class="caption text-center">
                                                <h6>WEEKLY</h6>
                                                <hr>
                                                <h3>£10 <small>/hr</small></h3>
                                                <hr>
                                                <p>
                                                      <small>NO CONTRACT</small>
                                                </p>
                                                <hr>
                                                <a class="btn btn-primary btn-group-justified" href="#">Select</a>
                                          </div>
                                    </div>
                              </div>
                              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                                    <div class="thumbnail">
                                          <div class="caption text-center">
                                                <h6>FORTNIGHTLY</h6>
                                                <hr>
                                                <h3>£10 <small>/hr</small></h3>
                                                <hr>
                                                <p>
                                                      <small>NO CONTRACT</small>
                                                </p>
                                                <hr>
                                                <a class="btn btn-primary btn-group-justified" href="#">Select</a>
                                          </div>
                                    </div>
                              </div>
                              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                                    <div class="thumbnail">
                                          <div class="caption text-center">
                                                <h6>ONLY ONCE</h6>
                                                <hr>
                                                <h3>£15 <small>/hr</small></h3>
                                                <hr>
                                                <p>
                                                      <small>NO CONTRACT</small>
                                                </p>
                                                <hr>
                                                <a class="btn btn-primary btn-group-justified" href="#">Select</a>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
      <div class="row">
            <div  class="col-md-6 col-md-offset-3">
                  <div class="panel panel-default">
                        <div class="panel-heading">
                              <h5 class="text-center">
                                    LAUNDRY
                              </h5>
                        </div>
                        <div class="panel-body laundry-body-bg">
                              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                              <!-- TODO: For loop for services will go here -->
                                    <div class="thumbnail">
                                          <div class="caption text-center">
                                                <h6>SMALL LOAD</h6>
                                                <hr>
                                                <h3>£9</h3>
                                                <hr>
                                                <p>
                                                      <small>10 ITEMS</small>
                                                </p>
                                                <hr>
                                                <a class="btn btn-primary btn-group-justified" href="#">Select</a>
                                          </div>
                                    </div>
                              </div>
                              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                              <!-- TODO: For loop for services will go here -->
                                    <div class="thumbnail">
                                          <div class="caption text-center">
                                                <h6>MEDIUM LOAD</h6>
                                                <hr>
                                                <h3>£13</h3>
                                                <hr>
                                                <p>
                                                      <small>11 - 20 ITEMS</small>
                                                </p>
                                                <hr>
                                                <a class="btn btn-primary btn-group-justified" href="#">Select</a>
                                          </div>
                                    </div>
                              </div>
                              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                              <!-- TODO: For loop for services will go here -->
                                    <div class="thumbnail">
                                          <div class="caption text-center">
                                                <h6>LARGE LOAD</h6>
                                                <hr>
                                                <h3>£15</h3>
                                                <hr>
                                                <p>
                                                      <small>21 - 30 ITEMS</small>
                                                </p>
                                                <hr>
                                                <a class="btn btn-primary btn-group-justified" href="#">Select</a>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
@endsection

