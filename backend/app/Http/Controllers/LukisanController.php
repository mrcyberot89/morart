<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use App\Models\Lukisan; //dimbil adari model

class LukisanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function convertToRupiah($amount)
    {
        return number_format($amount, 0, ',', '.');
    }


    public function index()
    {
        //
        $lukisan = Lukisan::all()->map(function ($lukisan) {
            $lukisan->url_gambar = asset('storage/images/' . $lukisan->gambar);
            $lukisan->harga = $this->convertToRupiah($lukisan->harga);
            return $lukisan;

        });
        return response()->json([
            'lukisan' => $lukisan

        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string|max:255',
            'lebar' => 'required|integer',
            'tinggi' => 'required|integer',
            'harga' => 'required|integer'
        ]);
        $gambar = $request->file('gambar');
        $filename = time() . '.' . $gambar->extension();
        $gambar->move(public_path('storage/images'), $filename);

        Lukisan::create([

            'gambar' => $filename,
            'nama' => $request->nama,
            'lebar' => $request->lebar,
            'tinggi' => $request->tinggi,
            'harga' => $request->harga
        ]);
        return response()->json([
            'message' => 'Data lukisan berhasil disimpan',
            'data' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
