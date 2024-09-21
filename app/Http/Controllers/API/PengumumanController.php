<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index(){
        $pengumuman = Pengumuman::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get();

        $response = [];

        foreach ($pengumuman as $item) {
            $response[] = $this->formattedJson($item);
        }
        
        return response()->json($response);
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::where('id', $id)
            ->whereNotNull('published_at')
            ->first();

        if (!$pengumuman) {
            return response()->json([
                'message' => 'Pengumuman tidak ditemukan',
            ], 404);
        }

        $response = $this->formattedJson($pengumuman);

        return response()->json($response);
    }

    public function formattedJson($pengumuman)
    {
        return [
            'id' => $pengumuman->id,
            'judul' => $pengumuman->judul,
            'penulis' => $pengumuman->user,
            'konten' => $pengumuman->isi,
            'published_at' => $pengumuman->published_at,
        ];
    }
}
