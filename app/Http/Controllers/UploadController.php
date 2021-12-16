<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function fileUpload(Request $req){

        $req->validate([
        'file' => 'required|mimes:csv,txt,xlx,xls,pdf,docx|max:2048'
        ]);

        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            // save file to azure blob virtual directory uplaods in your container
            $filePath = $req->file('file')->storeAs('uploads/', $fileName, 'azure');

            return back()
            ->with('success','File has been uploaded.');

        }
    }
}
