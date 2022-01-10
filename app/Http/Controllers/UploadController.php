<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UploadController extends Controller
{


    public function index(){

        $files = Storage::disk('azure')->files('uploads/documentos');

        return view('welcome')->with(['files' => $files]);
    }

    public function fileUpload(Request $req){

        $req->validate([
        'file' => 'required|mimes:csv,txt,xlx,xls,pdf,docx|max:2048'
        ]);

        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            // save file to azure blob virtual directory uplaods in your container
            $filePath = $req->file('file')->storeAs('uploads/documentos', $fileName, 'azure');

            return back()
            ->with('success','File has been uploaded.');
        }


    }

    public function downloadFile($fileName){

        return Storage::disk('azure')->download(base64_decode($fileName));

    }
}
