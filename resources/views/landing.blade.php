@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="css/landing.css">
@endsection

@section('body')
<!--   <div id="top-section" class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
              <div class="jumbotron text-center">
                    <h2>Book your fellow trusted cleaner</h2> 
                    <p>
                          High standard cleaning and ironing service in the Cheshire area. 
                          Free collection and delivery of Ironing within a 5 mile radius of CW7.
                    </p> 
              </div>
        </div>
  </div> -->
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
  </ol>
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img class="blur" src="/img/domestic-house-bg.jpg" alt="...">
      <div class="carousel-caption">
        <h1>Domestic Cleaning</h1>
        <p>
          High standard cleaning service in the Cheshire area.
        </p>
      </div>
    </div>
    <div class="item">
      <img class="blur" src="/img/clothes-bg.jpg" alt="...">
      <div class="carousel-caption">
        <h1>Washing & Ironing</h1>
        <p>
          A reliable and professional ironing service. All your items
          will be hand ironed in a smoke free environement.
        </p>
      </div>
    </div>
  </div>
 
  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div> <!-- Carousel -->
  <div id="bottom-section" class="row bottom-section">
    
  </div>
@endsection