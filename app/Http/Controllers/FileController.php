<?php

namespace App\Http\Controllers;

use App\Integrations\WeaviateAPI;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = File::orderby('id' ,'desc')->paginate(25);

        return view('dashboard.files' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $file = File::find($id);

        $weavite = new WeaviateAPI();

        $weavite->deleteChunks($file->name);

        $file->delete();

        flash('file deleted successfully');

        return redirect()->back();
    }
}
