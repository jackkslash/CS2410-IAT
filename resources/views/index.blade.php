@extends('layouts.app')
@section('content')
<div class="container">
  @if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
  @endif
  <!-- Home page for none users -->
  <div class="px-4 py-5 my-5 text-center">
    <h1 class="display-5 fw-bold">Aston Animal Sanctuary</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">For all animal adoption needs.</p>
      <br>
      <p class="lead mb-4">Just register or login to see the animals up for adoption.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <button type="button" class="btn btn-lg px-4 me-sm-3"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></button>
        <button type="button" class="btn btn-lg px-4"> <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></button>
      </div>
    </div>
  </div>
</div>
@endsection