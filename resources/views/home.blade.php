@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <!-- Dashboard for user -->
        <center>
          <div class="card-header">Dashboard</div>
        </center>
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          <center>
            Hello {{Auth::user()->name}}, you are logged in! <br> Welcome to Aston Animal Sanctuary. <br>
            We aim to make sure every animal deserves a warm, comfortable and caring home.
          </center>
          <br> <br>
          <center> <a href="{{ url('animals') }}" class="btn btn-primary">Display Animals</a> </center>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection