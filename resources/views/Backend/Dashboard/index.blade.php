@extends('layouts.admin')

@section('content')
  <div class="card-columns row ">
    <div class="card bg-primary col-md-3">
      <div class="card-body text-center">
          <div class="row block_data">
            <div class="col-md-8">
              <h3>Projects</h3>
              <h5>{{$Projectscount}} Projects</h5>
             </div>
            <div class="col-md-4"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></div>
          </div>
      </div>
    </div>
   
    <!--<div class="card bg-danger col-md-3">
      <div class="card-body text-center">
        <p class="card-text">Some text inside the fourth card</p>
      </div>
    </div>
    <div class="card bg-light col-md-3">
      <div class="card-body text-center">
        <p class="card-text">Some text inside the fifth card</p>
      </div>
    </div>
    <div class="card bg-info col-md-3">
      <div class="card-body text-center">
        <p class="card-text">Some text inside the sixth card</p>
      </div>
    </div>-->
  </div>

@endsection
