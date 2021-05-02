<!--inherite master template app.blade.php -->
@extends('layouts.app')
<!--define the content section -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 ">
            <div class="card">
                <div class="card-header">Input a animal.</div>
                <!--display errors -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul> @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li> @endforeach
                    </ul>
                </div><br /> @endif
                <!--display success status -->
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div><br />
                @endif
                <!--form -->
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{url('animals')}}" enctype="multipart/form-data">
                        @csrf
                        <!-- text input -->
                        <div class="col-md-8"><label>Animal Name</label>
                            <input type="text" name="name" placeholder="Name" />
                        </div>
                        <!-- date of birth picker -->
                        <div class="col-md-8">
                            <label>Date of Birth:</label>
                            <input type="date" name="dob" placeholder="yyyy/mm/dd" />
                        </div>
                        <!-- dropdown for animal types -->
                        <div class="col-md-8"><label>Animal Type</label>
                            <select name="type">
                                <option value="Dog">Dog</option>
                                <option value="Cat">Cat</option>
                                <option value="Rabbit">Rabbit</option>
                                <option value="Hamster">Hamster</option>
                            </select>
                        </div>
                        <!-- text input -->
                        <div class="col-md-8"><label>Description</label>
                            <input type="text" name="description" placeholder="Description" />
                        </div>
                        <div class="col-md-8"><label>Availability</label>
                            <select name="availability">
                                <option value="Available">Available</option>
                                <option value="Unvailable">Unvailable</option>
                            </select>
                        </div>
                        <!-- file explorer for images -->
                        <div class="col-md-8"><label>Image</label>
                            <input type="file" name="image" placeholder="Image file" />
                        </div>
                        <div class="col-md-8"><label>Image</label>
                            <input type="file" name="image2" placeholder="Image file" />
                        </div>
                        <div class="col-md-6 col-md-offset-4">
                            <input type="submit" class="btn btn-primary btn-sm" />
                            <input type="reset" class="btn btn-primary btn-sm" />
                            <td><a href="{{route('home')}}" class="btn btn-primary btn-sm" role="button">Back</a></td>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection