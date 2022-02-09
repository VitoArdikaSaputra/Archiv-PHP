<?php

namespace App\Http\Controllers;

use App\Models\data_surat as File;
use Illuminate\Http\Request;

class FileDocumentController extends Controller
{
    public function upload_dokumen(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:5120',
        ]);

        $fileModel = new File;

        if($request->file()){
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->nama_file = time().'_'.$request->file->getClientOriginalName();
            $fileModel->file_path = '/storage/'.$filePath;
            $fileModel->save();
        }
    }
}
