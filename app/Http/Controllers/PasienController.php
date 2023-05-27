<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::with('kelurahan')->get();
        return response()->json($pasiens);
    }

    public function show($id)
    {
        $pasien = Pasien::with('kelurahan')->find($id);
        if (!$pasien) {
            return response()->json(['message' => 'Pasien not found'], 404);
        }
        return response()->json($pasien);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama_Pasien' => 'required',
            'Alamat' => 'required',
            'No_Telepon' => 'required',
            'RT' => 'required',
            'RW' => 'required',
            'kelurahan_id' => 'required|exists:kelurahans,id',
            'Tanggal_Lahir' => 'required|date',
            'Jenis_Kelamin' => 'required',
        ]);

        $idPasien = $this->generatePasienId();

        $pasien = new Pasien();
        $pasien->ID_Pasien = $idPasien;
        $pasien->Nama_Pasien = $request->input('Nama_Pasien');
        $pasien->Alamat = $request->input('Alamat');
        $pasien->No_Telepon = $request->input('No_Telepon');
        $pasien->RT = $request->input('RT');
        $pasien->RW = $request->input('RW');
        $pasien->kelurahan_id = $request->input('kelurahan_id');
        $pasien->Tanggal_Lahir = $request->input('Tanggal_Lahir');
        $pasien->Jenis_Kelamin = $request->input('Jenis_Kelamin');
        $pasien->save();

        return response()->json($pasien, 201);
    }

    private function generatePasienId()
    {
        $latestPasien = Pasien::latest()->first();
        $lastId = $latestPasien ? (int)substr($latestPasien->ID_Pasien, 4) : 0;
        $newId = $lastId + 1;
        $idPasien = sprintf('%06d', $newId);
        $year = date('y');
        $month = date('m');
        $formattedId = $year . $month . $idPasien;
        return $formattedId;
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::find($id);
        if (!$pasien) {
            return response()->json(['message' => 'Pasien not found'], 404);
        }

        $request->validate([
            'Nama_Pasien' => 'required',
            'Alamat' => 'required',
            'No_Telepon' => 'required',
            'RT' => 'required',
            'RW' => 'required',
            'kelurahan_id' => 'required|exists:kelurahans,id',
            'Tanggal_Lahir' => 'required|date',
            'Jenis_Kelamin' => 'required',
        ]);

        $pasien->Nama_Pasien = $request->input('Nama_Pasien');
        $pasien->Alamat = $request->input('Alamat');
        $pasien->No_Telepon = $request->input('No_Telepon');
        $pasien->RT = $request->input('RT');
        $pasien->RW = $request->input('RW');
        $pasien->kelurahan_id = $request->input('kelurahan_id');
        $pasien->Tanggal_Lahir = $request->input('Tanggal_Lahir');
        $pasien->Jenis_Kelamin = $request->input('Jenis_Kelamin');
        $pasien->save();

        return response()->json($pasien);
    }

    public function destroy($id)
    {
        $pasien = Pasien::find($id);
        if (!$pasien) {
            return response()->json(['message' => 'Pasien not found'], 404);
        }

        $pasien->delete();

        return response()->json(['message' => 'Pasien deleted']);
    }
}
