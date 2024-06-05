<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::all();
        return view('obat.obat', compact('obat'));
    }

    public function create()
    {
        return view('obat.obat-entry');
    }

    public function store(Request $request)
    {
       $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'photo' => 'required|file|mimes:png,jpg,jpeg|max:2048',
        ]);

        $photo = $request->file('photo');
        $nama_photo = time() . '_' . $photo->getClientOriginalName();
        $tujuan_upload = 'img_categories';
        $photo->move($tujuan_upload, $nama_photo);

        Obat::create([
            'nama_obat' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'photo' => $nama_photo,
        ]);

        return redirect('/obat');
    }

    public function edit($id)
    {
        $obat = Obat::find($id);
        return view('obat.obat-edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'photo' => 'file|mimes:png,jpg,jpeg|max:2048',
        ]);

        $Obat = Obat::find($id);

        if($request->hasFile('photo')){

            File::delete('img_categories/'.$Obat->photo);
            $photo = $request->file('photo');
            $nama_photo = time() . '_' . $photo->getClientOriginalName();
            $tujuan_upload = 'img_categories';
            $photo->move($tujuan_upload, $nama_photo);
            $Obat->photo = $nama_photo;
        }

        $Obat->update([
            'nama_obat' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/obat');
    }

    public function delete($id_obat)
    {
        $obat = Obat::find($id_obat);
        return view('obat.obat-hapus', compact('obat'));
    }

    public function destroy($id_obat)
    {
        $Obat = Obat::find($id_obat);
        File::delete('img_categories/'.$Obat->photo);
        $Obat->delete();
        return redirect('/obat');
    }
    public function cetak()
    {
        $obat = obat::all();
        $pdf = Pdf::loadview('obat.obat-cetak', compact('obat'));
        return $pdf->download('laporan-obat.pdf');
    }


}
