<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\IRS;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;


class PembimbingController extends Controller
{
    // Menampilkan daftar mahasiswa perwalian
    public function index()
    {
        // Ambil semua mahasiswa dan IRS
        $mahasiswa = Mahasiswa::all();
        $irs = IRS::all();

        return view('PerwalianPaka.perwalianpaka', compact('mahasiswa', 'irs'));
    }

    // Cetak PDF histori IRS mahasiswa
    public function cetakHistoriIRS($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        $irs = IRS::where('mahasiswa_nim', $nim)->get();

        $pdf = PDF::loadView('pembimbing.pdf', compact('mahasiswa', 'irs'));
        return $pdf->download("Histori_IRS_{$mahasiswa->nim}.pdf");
    }
}
