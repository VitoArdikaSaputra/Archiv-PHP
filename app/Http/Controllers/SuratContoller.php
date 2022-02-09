<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data_surat;
use App\Http\Controllers\FileDocumentController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Node\Block\Document;

class SuratContoller extends Controller
{
    public function index(data_surat $data)
    {
        $data = data_surat::all();
 
        if($data == false) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        } else {
            return response()->json(['message' => 'success', 'data' => $data], 200);
        }
    }

    public function show(data_surat $id)
    {
        if($id == false) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        } else {
            return response()->json(['message' => 'success', 'data' => $id], 200);
        }
    }   

    public function store(Request $request)
    {
        $data_surat = data_surat::create($request->all());

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf,docs|max:52400',
            // 'nama_file' => 'string',
            // 'file_path' => 'string',
            'nomor_surat' => 'required|string',
            'nama_surat' => 'required|string|max:100',
            // 'disposisi' => 'string|max:255',
            'penerima' => 'required|string|max:144',
            'pengirim' => 'required|string|max:144',
            'jenis_retensi' => 'required',
            // 'tanggal_retensi' => 'date',
            'nomor_akuisisi' => 'required|string',
            // 'tanggal_akuisisi' => 'date',
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }

        if($request->file()){
            $namaFile = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('surats', $namaFile, 'public');
            $data_surat->nama_file = time().'_'.$request->file->getClientOriginalName();
            $data_surat->file_path = '/storage/'.$filePath;
            $data_surat->save();
        }
    
        return response()->json($data_surat, 201);
    }

    public function update(Request $request, data_surat $id)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:5120',
            'nama_surat' => 'required:string|max:100',
            'disposisi' => 'string',
            'penerima' => 'required|string|max:144',
            'pengirim' => 'required|string|max:144',
            'jenis_retensi' => 'required',
            'tanggal_retensi' => 'required|date',
            'nomor_akuisisi' => 'required|string',
            'tanggal_akuisisi' => 'required|date',
        ]);
        
        $id->update($request->all());

        return response()->json(['Message' => 'Berhasil', $id], 200);
    }

    public function delete(data_surat $id)
    {
        $id->delete();

        return response()->json(['message' => 'Data Dihapus'], 204);
    }
}
