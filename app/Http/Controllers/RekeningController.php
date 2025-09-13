<?php
namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $rekenings = Rekening::orderBy('bank_name', 'asc')
                        ->paginate(10); // 10 data per halaman
        return view('admin.rekenings.index', compact('rekenings'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rekenings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'number'    => 'required|string|max:255',
        ]);
        Rekening::create($validated);
        return redirect()->route('admin.rekenings.index')->with('success', 'Rekening berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rekening = Rekening::findOrFail($id);
        return view('admin.rekenings.show', compact('rekening'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rekening = Rekening::findOrFail($id);
        return view('admin.rekenings.edit', compact('rekening'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'number'    => 'required|string|max:255',
        ]);
        $rekening = Rekening::findOrFail($id);
        $rekening->update($validated);
        return redirect()->route('admin.rekenings.index')->with('success', 'Rekening berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rekening = Rekening::findOrFail($id);
        $rekening->delete();
        return redirect()->route('admin.rekenings.index')->with('success', 'Rekening berhasil dihapus.');
    }
}
