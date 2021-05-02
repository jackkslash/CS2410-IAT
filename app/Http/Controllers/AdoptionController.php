<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Adoption;

class AdoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adoptions = Adoption::all();
        return view('adoptions.index', array('adoptions' => $adoptions));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adoption = $this->validate(request(), [
            'userId' => 'required',
            'animalId' => 'required',
            'name' => 'required',
            'username' => 'required',
        ]);

            $adoption = new Adoption;
            $adoption->userId = $request->input('userId');
            $adoption->animalId = $request->input('animalId');
            $adoption->name = $request->input('name');
            $adoption->username = $request->input('username');

            $adoption->save();

            return redirect('animals')->with('success', 'Adoption request made.');
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
        $adoptions = Adoption::find($id);
        $animalId = $adoptions->animalId;
        $this->validate(request(), [
            'decision' => 'required'
        ]);
        $adoptions->decision = $request->input('decision');
        $adoptions->save();

        if ($adoptions->decision == 'Approved') {
            $animal = Animal::where('id', "=", $animalId)->first();
            $animal->availability = 'Unavailable';
            $animal->save();

            return back()->with('success', 'Adoption Request has been updated');
        }
        return back()->with('success', 'Adoption Request has been updated');
    }
}