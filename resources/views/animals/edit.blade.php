@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <!-- edit page for animals -->
                <div class="card-header">Edit and update the animal</div>
                <!--display errors -->
                @if ($errors->any())<div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li> @endforeach
                    </ul>
                </div><br />
                @endif
                <!--display success status -->
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div><br />
                @endif
                <!--form -->
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('animals.update', ['animal' => $animal['id']])}}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <!-- text input -->
                        <div class="col-md-8">
                            <label>Name:</label>
                            <input type="text" name="name" value="{{$animal->name}}" />
                        </div>
                        <!-- date of birth input -->
                        <div class="col-md-8">
                            <label>Date Of Birth:</label>
                            <input type="date" name="dob" value="{{$animal->dob}}" />
                        </div>
                        <!-- dropdown for animal type -->
                        <div class="col-md-8">
                            <label>Type:</label>
                            <select name="type">
                                <option value="Dog">Dog</option>
                                <option value="Cat">Cat</option>
                                <option value="Rabbit">Rabbit</option>
                                <option value="Hamster">Hamster</option>
                            </select>
                        </div>
                        <!-- text input for description -->
                        <div class="col-md-8">
                            <label>Description:</label>
                            <textarea rows="1" cols="40" name="description"> {{$animal->description}} </textarea>
                        </div>
                        <!-- dropdown for animal availability -->
                        <div class="col-md-8">
                            <label>Animal Availability:</label>
                            <select name="availability">
                                <option value="Available">Available</option>
                                <option value="Unavailable">Not Available</option>
                            </select>
                        </div>
                        <!-- file explorer for images -->
                        <div class="col-md-8">
                            <label>Picture one:</label>
                            <input type="file" name="image" placeholder="Image file" />
                        </div>
                        <div class="col-md-8">
                            <label>Picture two:</label>
                            <input type="file" name="image2" placeholder="Image file" />
                        </div>
                        <div class="col-md-6 col-md-offset-4">
                            <input type="submit" class="btn btn-primary" />
                            <input type="reset" class="btn btn-primary" /></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection