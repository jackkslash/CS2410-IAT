<!--inherite master template app.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @can('adminAccess')
        <div class="col-md-14">
            <div class="card">
                <div class="card-header">Pending Requests</div>
                <!--display success status -->
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div><br />
                @endif
                <!-- lists all adoptions that are pending for admin to see -->
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>User ID</th>
                                <th>User name</th>
                                <th>Animal ID</th>
                                <th>Animal Name</th>
                                <th>Decision</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- collect all pending adoptions from adoption DB -->
                            @foreach($adoptions as $adoption)
                            @if($adoption['decision'] == 'Pending')
                            <tr>
                                <td>{{$adoption['created_at']}}</td>
                                <td>{{$adoption['userId']}}</td>
                                <td>{{$adoption['username']}}</td>
                                <td>{{$adoption['animalId']}}</td>
                                <td>{{$adoption['name']}}</td>
                                <td>{{$adoption['decision']}}</td>
                                <!--only show if admin-->

                                <td>
                                    <form class="form-horizontal" method="POST" action="{{route('adoptions.update', [$adoption->id, $adoption->animalId])}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <select name="decision">
                                            <option value="Approved">Approved</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                        <input type="submit" class=""/>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="col-md-14">
                <div class="card">
                <!-- lists all adoptions recorded in the adoption DB -->
                    <div class="card-header">Request History</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date Created</th>
                                    <th>User ID</th>
                                    <th>User name</th>
                                    <th>Animal ID</th>
                                    <th>Animal Name</th>
                                    <th>Decision</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($adoptions as $adoption)
                                <tr>
                                    <td>{{$adoption['created_at']}}</td>
                                    <td>{{$adoption['userId']}}</td>
                                    <td>{{$adoption['username']}}</td>
                                    <td>{{$adoption['animalId']}}</td>
                                    <td>{{$adoption['name']}}</td>
                                    <td>{{$adoption['decision']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endcan
            <!-- end of admin view -->
            <!-- start of user view of requests -->
            <br>
            <div class="col-md-14">
                <div class="card">
                    <div class="card-header">User Request History</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date Created</th>
                                    <th>User ID</th>
                                    <th>User name</th>
                                    <th>Animal ID</th>
                                    <th>Animal Name</th>
                                    <th>Decision</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- checks user id and collects requests that link to that id in the adoption DB -->
                                @php
                                $id = Auth::id();
                                @endphp
                                @foreach($adoptions as $adoption)
                                @if($adoption['userId'] == $id)
                                <tr>
                                    <td>{{$adoption['created_at']}}</td>
                                    <td>{{$adoption['userId']}}</td>
                                    <td>{{$adoption['username']}}</td>
                                    <td>{{$adoption['animalId']}}</td>
                                    <td>{{$adoption['name']}}</td>
                                    <td>{{$adoption['decision']}}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection