<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPengukuran;
use Illuminate\Http\Request;

class JadwalPengukuranController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPengukuran::orderBy('tanggal', 'desc')->get();
        return view('admin.jadwal-pengukuran.index', compact('jadwals'));
    }

    public function create()
    {
        return view('admin.jadwal-pengukuran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'pelanggan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:pending,selesai,batal',
        ]);

        JadwalPengukuran::create($request->all());

        return redirect()->route('jadwal-pengukuran.index')->with('success', 'Jadwal pengukuran berhasil ditambahkan.');
    }

    public function edit(JadwalPengukuran $jadwal)
    {
        return view('jadwal-pengukuran.edit', compact('jadwal'));
    }

    public function update(Request $request, JadwalPengukuran $jadwal)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'pelanggan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:pending,selesai,batal',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal-pengukuran.index')->with('success', 'Jadwal pengukuran berhasil diperbarui.');
    }

    public function destroy(JadwalPengukuran $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal-pengukuran.index')->with('success', 'Jadwal pengukuran berhasil dihapus.');
    }
}
