<?php

namespace App\Http\Controllers;

use App\Models\Storagek;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return Storagek::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required'

        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $namefile = time() . $file->getClientOriginalName();
            $file->move(public_path('storage/images/') . '', $namefile);
        }
        if ($files = $request->file('file')) {
            $storagek = new Storagek();
            $storagek->file = $namefile;
            $storagek->email = $request->input('email');
            $storagek->save();
            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $namefile
            ]);
        } else {
            return response()->json(['Err' => 'File no found']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        if ($email != '') {
            return Storagek::where('email', $email)->get();
        } else {
            return response()->json(['Err' => 'File no found']);
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('welcome');
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
        //
        return view('welcome');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $storagek = Storagek::find($id);
            unlink(public_path('storage/images/').$storagek->file);
            $storagek->delete();
            return response()->json([
                "success" => true,
                "message" => "File successfully delete",
            ]);
        } else {
            return response()->json(['Err' => 'id no found']);
        }



        //
    }
}
