<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengumumanController extends Controller
{
    public function index()
    {
        // $pengumuman = Pengumuman::all()->map(function($p){
        //     $p->formatted_date = Carbon::parse($p->created_at)->format('d-m-Y H:i:s');
        //     return $p;
        // });

        $pengumuman = Pengumuman::all();
        
        return view('koor.pengumuman.pengumuman', compact('pengumuman'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'sender' => 'required|string',
            'isi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Pengumuman::create([
            'judul' => $request->judul,
            'user' => $request->sender,
            'isi' => $request->isi,
            'published_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pengumuman = Pengumuman::findOrFail($id);

        $pengumuman->update([
            'judul' => $request->input('judul'),
            'isi' => $request->input('isi'),
        ]);

        return redirect()->back()->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::where('id', $id)->first();
        return response()->json([
            'pengumuman' => $pengumuman
        ]);
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus.');
    }
}
