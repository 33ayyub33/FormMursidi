<?php

namespace App\Http\Controllers;

use App\Models\Irs;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class getIrsController extends Controller
{
    /**
     * Menampilkan data IRS berdasarkan semester dan mahasiswa
     *
     * @param  int  $semester
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIrsBySemester($semester)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User tidak terautentikasi'], 401);
        }
    
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
    
        if (!$mahasiswa) {
            return response()->json(['error' => 'Mahasiswa tidak ditemukan'], 404);
        }
    
        $nim = $mahasiswa->nim;
    
        // Tambahkan log untuk debug
        Log::info('Semester:', ['semester' => $semester]);
        Log::info('Mahasiswa NIM:', ['nim' => $nim]);
    
        $irs = Irs::with(['kelas', 'kelas.mataKuliah'])
            ->where('semester', $semester)
            ->where('mahasiswa_nim', $nim)
            ->get();
            
        if ($irs->isEmpty()) {
            return response()->json([], 200);
        }

        // Menambahkan logging data IRS
        Log::info('IRS Data:', $irs->toArray());
        
        return response()->json($irs->map(function ($item) {
            $kelas = $item->kelas;
            $mataKuliah = $kelas->mataKuliah ?? null; // Pastikan relasi ada
            
            // Log nama mata kuliah untuk debugging
            Log::info('Mata Kuliah:', [
                'kode_mk' => $mataKuliah ? $mataKuliah->kode_mk : 'Tidak Ada',
                'nama_mk' => $mataKuliah ? $mataKuliah->nama_mk : 'Tidak Ada',
            ]);
            Log::info('IRS',[ 'Ruang' => $item ? $item->ruang_kuliah_kode_ruang : 'Tidak ada']);

            return [
                'nama_mk' => $mataKuliah ? $mataKuliah->nama_mk : 'Mata Kuliah Tidak Ditemukan', 
                'kode_mk' => $mataKuliah ? $mataKuliah->kode_mk : 'Kode MK Tidak Ditemukan', 
                'semester' => $item->semester,
                'tahun_akademik' => $item->tahun_akademik,
                'ruang' => $item->ruang_kuliah_kode_ruang,
                'total_sks' => $item->total_sks,
                
            ];
        }));
    }

    /**
     * Export Histori IRS mahasiswa dalam format PDF
     *
     * @param  string  $nim
     * @return \Illuminate\Http\Response
     */
    public function exportIrsHistoryPDF($nim)
    {
        // Ambil data IRS berdasarkan NIM mahasiswa yang sudah disetujui
        $irs = Irs::where('mahasiswa_nim', $nim)
        ->orderBy('semester', 'asc')
        ->get();
        
        // ->where('is_verified', '0')

            // $irs = Irs::with(['kelas', 'kelas.mataKuliah'])
            // ->where('semester', $semester)
            // ->where('mahasiswa_nim', $nim)
            // ->get();

        if ($irs->isEmpty()) {
            return response()->json(['error' => 'Tidak ada data IRS yang disetujui untuk mahasiswa ini'], 404);
        }

        // Generate PDF
        $pdf = Pdf::loadView('irs.history_pdf', compact('irs'));
        return $pdf->download('Histori_IRS_' . $nim . '.pdf');
    }
}
