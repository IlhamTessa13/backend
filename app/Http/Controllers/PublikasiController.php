<?php

namespace App\Http\Controllers;
use App\Models\Publikasi;
use Illuminate\Http\Request;
class PublikasiController extends Controller
{
public function index()
{
return Publikasi::all();
}
public function store(Request $request)
{
    $validated = $request->validate([
    'title' => 'required|string|max:255',
    'releaseDate' => 'required|date',
    'description' => 'nullable|string',
    'coverUrl' => 'nullable|url',
    ]);
    $publikasi = Publikasi::create($validated);
    return response()->json($publikasi, 201);
}
public function show($id)
{
    $Publikasi = Publikasi::find($id);

    if(!$Publikasi){
        return response()->json(['error' => 'Publikasi tidak ditemukan'],404);
    }

    return response()->json($Publikasi, 200);
}

public function delete($id)
{
    $Publikasi = Publikasi::find($id);

    if(!$Publikasi){
        return response()->json(['error' => 'Publikasi tidak ditemukan'],404);
    }
    $Publikasi->delete();
    return response()->json(['Publikasi berhasil di hapus'], 200);
}

public function update(Request $request, $id)
{
    $publikasi = Publikasi::find($id);

    if (!$publikasi) {
        return response()->json(['error' => 'Publikasi not found'], 404);
    }

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'releaseDate' => 'sometimes|required|date',
        'description' => 'nullable|string',
        'coverUrl' => 'nullable|url',
    ]);

    $publikasi->update($validated);
    return response()->json($publikasi, 200);
}

}

