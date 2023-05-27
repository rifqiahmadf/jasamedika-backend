<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    public function index()
    {
        return response()->json(Kelurahan::all());
    }

    public function show($id)
    {
        $kelurahan = Kelurahan::find($id);

        if (!$kelurahan) {
            return response()->json(['message' => 'Kelurahan not found'], 404);
        }

        return response()->json($kelurahan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama_Kelurahan' => 'required',
            'Nama_Kecamatan' => 'required',
            'Nama_Kota' => 'required',
        ]);

        $kelurahan = new Kelurahan([
            'Nama_Kelurahan' => $request->input('Nama_Kelurahan'),
            'Nama_Kecamatan' => $request->input('Nama_Kecamatan'),
            'Nama_Kota' => $request->input('Nama_Kota'),
        ]);

        $kelurahan->save();

        return response()->json($kelurahan, 201);
    }

    public function update(Request $request, $id)
    {
        $kelurahan = Kelurahan::find($id);

        if (!$kelurahan) {
            return response()->json(['message' => 'Kelurahan not found'], 404);
        }

        $request->validate([
            'Nama_Kelurahan' => 'required',
            'Nama_Kecamatan' => 'required',
            'Nama_Kota' => 'required',
        ]);

        $kelurahan->Nama_Kelurahan = $request->input('Nama_Kelurahan');
        $kelurahan->Nama_Kecamatan = $request->input('Nama_Kecamatan');
        $kelurahan->Nama_Kota = $request->input('Nama_Kota');
        $kelurahan->save();

        return response()->json($kelurahan);
    }

    public function destroy($id)
    {
        $kelurahan = Kelurahan::find($id);

        if (!$kelurahan) {
            return response()->json(['message' => 'Kelurahan not found'], 404);
        }

        $kelurahan->delete();

        return response()->json(['message' => 'Kelurahan deleted']);
    }
}
