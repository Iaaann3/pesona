<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class UserKegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::latest()->paginate(5);
        return view('users.kegiatan.index', compact('kegiatan'));
    }

        public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('users.kegiatan.show', compact('kegiatan'));
    }
}
