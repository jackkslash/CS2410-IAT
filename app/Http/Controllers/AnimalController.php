<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Animal;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $animals = Animal::where('availability', 'Available')->paginate(8);
    return view('animals.index', compact('animals'));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    if (Gate::denies('adminAccess')) {
      abort(404, "Sorry you can not do this action.");
    }
    return view('animals.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if (Gate::denies('adminAccess')) {
      abort(404, "Sorry you can not do this action.");
    }
    // form validation
    $animal = $this->validate(request(), [
      'name' => 'required',
      'dob' => 'required',
      'type' => 'required',
      'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
      'availability' => 'required',
    ]);
    //uploading of the image
    if ($request->hasFile('image')) {
      //gets filename with extension
      $fileNameWithExt = $request->file('image')->getClientOriginalName();
      //gets filename
      $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      //gets  extension
      $extension = $request->file('image')->getClientOriginalExtension();
      //gets filename to store
      $fileNameToStore = $filename . '_' . time() . '.' . $extension;
      //Uploads image
      $path = $request->file('image')->storeAs('public/image', $fileNameToStore);
    } else {
      $fileNameToStore = 'noimage.jpg';
    }
    // create  Animal object, set its values from input
    $animal = new Animal;;
    $animal->image = $fileNameToStore;

    if ($request->hasFile('image2')) {
      //gets filename with  extension
      $fileNameWithExt = $request->file('image')->getClientOriginalName();
      // gets filename
      $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      //gets  extension
      $extension = $request->file('image2')->getClientOriginalExtension();
      //gets filename to store
      $fileNameToStore = $filename . '_' . time() . '.' . $extension;
      //Uploads  image
      $path = $request->file('image2')->storeAs('public/image', $fileNameToStore);
    } else {
      $fileNameToStore = 'noimage.jpg';
    }

    $animal->name = $request->input('name');
    $animal->dob = $request->input('dob');
    $animal->type = $request->input('type');
    $animal->description = $request->input('description');
    $animal->availability = $request->input('availability');

    $animal->created_at = now();
    $animal->image2 = $fileNameToStore;
    // save  Animal object
    $animal->save();
    // generate a redirect HTTP response success message
    return back()->with('success', 'Animal has been added');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $animal = Animal::find($id);
    return view('animals.show', compact('animal'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    if (Gate::denies('adminAccess')) {
      abort(404, "Sorry you can not do this action.");
    }
    $animal = Animal::find($id);
    return view('animals.edit', compact('animal'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    if (Gate::denies('adminAccess')) {
      abort(404, "Sorry you can not do this action.");
    }
    
    $this->validate(request(), [
      'name' => 'required',
      'dob' => 'required',
      'type' => 'required',
      'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
      'image2' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
      'availability' => 'required',
    ]);

    $animal = Animal::find($id);

    //uploading of the image
    if ($request->hasFile('image')) {
      //gets filename with extension
      $fileNameWithExt = $request->file('image')->getClientOriginalName();
      //gets filename
      $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      //gets  extension
      $extension = $request->file('image')->getClientOriginalExtension();
      //gets filename to store
      $fileNameToStore = $filename . '_' . time() . '.' . $extension;
      //Uploads image
      $path = $request->file('image')->storeAs('public/image', $fileNameToStore);
      
      $animal->image = $fileNameToStore;
    } else {
      $fileNameToStore = 'noimage.jpg';
    }

    if ($request->hasFile('image2')) {
      //gets filename with  extension
      $fileNameWithExt = $request->file('image2')->getClientOriginalName();
      // gets filename
      $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      //gets  extension
      $extension = $request->file('image2')->getClientOriginalExtension();
      //gets filename to store
      $fileNameToStore = $filename . '_' . time() . '.' . $extension;
      //Uploads  image
      $path = $request->file('image2')->storeAs('public/image', $fileNameToStore);
    
      $animal->image2 = $fileNameToStore;
    }else {
      $fileNameToStore = 'noimage.jpg';
    }

    $animal->name = $request->input('name');
    $animal->dob = $request->input('dob');
    $animal->type = $request->input('type');
    $animal->description = $request->input('description');
    $animal->availability = $request->input('availability');
    $animal->updated_at = now();

    $animal->save();
    return redirect('animals')->with('success', 'Animal has been updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    if (Gate::denies('adminAccess')) {
      abort(404, "Sorry you can not do this action.");
    }

    $animal = Animal::find($id);

    if ($animal->image != 'noimage.jpg') {
      // Delete Image
      Storage::delete('public/image/' . $animal->image);
    }

    if ($animal->image != 'noimage.jpg') {
      // Delete Image
      Storage::delete('public/image/' . $animal->image2);
    }

    $animal->delete();
    return redirect('animals')->with('success', 'Animal entry deleted.');
  }
}
