<!--inherite master template app.blade.php -->
@extends('layouts.app')
@section('content')<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="card">
                <!-- Display all animals page -->
                <div class="card-header">Display all animals</div>
                <div class="card-body">
                    <table class="table-sortable table">
                        @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ \Session::get('success') }}</p>
                        </div><br />
                        @endif
                        <!-- dropdown filter -->
                        <div class="row">
                            <div class="col-md-4"><label for="type">Select Animal type...</label></div>
                            <div class="col-md-6"><select style="width: 50%;" name="type" class="form-control" id="dropdown-search"></div>
                            <option value="">All</option>
                            <option value="Dog">Dog</option>
                            <option value="Cat">Cat</option>
                            </select>
                        </div>
                        <br>
                        <div class="col-md-8">
                            <p>Click on headings of the table to sort by that category</p>
                        </div>
                        <!-- headings clickable by js -->
                        <thead>
                            <tr class="table-active">
                                <th scope="col">Name</th>
                                <th scope="col">DOB</th>
                                <th scope="col">Type</th>
                                <th scope="col">Description</th>
                                <th scope="col">Availability</th>
                                <th scope="col">Image</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- Displays table of all anaimals from DB -->
                            @forelse($animals as $animal)<tr>
                                <td scope="row">{{$animal['name']}}</td>
                                <td>{{$animal['dob']}}</td>
                                <td>{{$animal['type']}}</td>
                                <td>{{$animal['description']}}</td>
                                <td>{{$animal['availability']}}</td>
                                <td style="max-width: 200px"><img class="img-thumbnail" style="border:1px solid black;" src="{{asset('storage/image/'.$animal['image'])}}"></td>
                                <!--only show if admin-->
                                <td style="max-width: 100px;"><a href="{{route('animals.show', ['animal' => $animal['id'] ] )}}" class="btn btn-primary">More Info</a>
                                    @can('adminAccess')
                                    <!-- Admin contorls only visable to admin -->
                                    <a href="{{route('animals.edit', ['animal' => $animal['id']])}}" class="btn btn-warning">Edit</a>

                                    <form action="{{action([App\Http\Controllers\AnimalController::class, 'destroy'], ['animal' => $animal['id']]) }}" method="post">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-danger" type="submit"> Delete</button>
                                    </form>
                                </td>
                                @endcan
                            </tr>
                            @empty
                            <!-- No animals avaible in DB this is shown -->
                            <p>No animals are currently up for adoption.</p>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- pagination to split up table -->
                    <div>
                        {{ $animals->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection