<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($fileUploadId)
    {
        $files = FileUpload::find($fileUploadId);
        $filePath = "upload/".$files->staff_id."/".$files->file_name;
        $fileName = $files->file_name;
        $mimeType = Storage::mimeType($filePath);
        $headers = [['Content-Type' => $mimeType]];
        return Storage::download($filePath, $fileName, $headers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'upload_file' => 'required'
        ]);

        $file_name = $request->file('upload_file')->getClientOriginalName();
        $request->file('upload_file')->storeAs('upload/'.$id,$file_name);

        $fileCount = FileUpload::find($id)->count();

        $fileUpLoad = new FileUpload();
        $fileUpLoad->staff_id = $id;
        $fileUpLoad->file_name = $file_name;
        $fileUpLoad->display_num = $fileCount+1;
        $fileUpLoad->save();

        return redirect()->route('staff.show', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function show(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function edit(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileUpload $fileUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function destroy($staffId, $fileUploadId)
    {
        $files = FileUpload::find($fileUploadId);
        $files->delete_flg = '1';
        $files->save();
        return redirect()->route('staff.show', ['id' => $staffId]);
    }
}
