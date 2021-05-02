@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <!-- Animal Display page-->
                <div class="card-header">Display animal</div>
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div><br />
                @endif
                <div class="card-body">
                    <table class="table table-striped">
                        <!-- Animal info -->
                        <tr>
                            <td> <b>Animal name: </th>
                            <td> {{$animal['name']}}</td>
                        </tr>
                        <tr>
                            <th>Desciprtion </th>
                            <td style="max-width:150px;">{{$animal->description}}</td>
                        </tr>
                        <tr>
                            <!-- image carousel for animal images -->
                            <center>
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{asset('storage/image/'.$animal['image'])}}" alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{asset('storage/image/'.$animal['image2'])}}" alt="Second slide">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <!-- Buttons -->
                            <td><a href="{{route('animals.index')}}" class="btn btn-primary" role="button">Back to the list</a></td>
                            <!-- Store into database -->
                            <form method="POST" class="form-horizontal" action="{{url('adoptions')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="userId" value="{{ auth()->user()->id }}" />
                                <input type="hidden" name="animalId" value="{{ $animal['id'] }}" />
                                <input type="hidden" name="name" value="{{ $animal['name'] }}" />
                                <input type="hidden" name="username" value="{{ auth()->user()->name }}" />
                                <input type="submit" class="btn btn-primary" value="Adopt This Animal" />
                            </form>
                            <!-- Admin use to edit or delete individual animal profiles -->
                            @can('adminAccess')
                            <td><a href="{{route('animals.edit', ['animal' => $animal['id']])}}" class="btn btn-warning">Edit</a></td>
                            <td>
                                <form action="{{route('animals.destroy', ['animal' => $animal['id']])}}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection