<?php
namespace App\Http\Controllers;
use App\Models\Irs;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

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
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Mendapatkan data mahasiswa berdasarkan user_id
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        // Jika mahasiswa tidak ditemukan, kembalikan response error
        if (!$mahasiswa) {
            return response()->json(['error' => 'Mahasiswa tidak ditemukan'], 404);
        }

        // Ambil NIM mahasiswa
        $nim = $mahasiswa->nim;

        // Ambil data IRS berdasarkan semester dan NIM mahasiswa
        $irs = Irs::with([
                'kelas',
                'kelas.mataKuliah',
                'kelas.mataKuliah.dosenMk',
                'kelas.mataKuliah.dosenMk.dosen'
            ])
            ->where('semester', $semester)
            ->where('mahasiswa_nim', $nim)
            ->get();

        // Jika data IRS tidak ditemukan, kembalikan response kosong
        if ($irs->isEmpty()) {
            return response()->json([], 200);
        }

        // Format data untuk dikirim sebagai JSON
        $data = $irs->map(function ($item) {
            return [
                'semester' => $item->semester,
                'tahun_akademik' => $item->tahun_akademik,
                'ruang' => $item->ruang_kuliah_kode_ruang,
                'total_sks' => $item->total_sks
            ];
        });

        // Mengembalikan response JSON
        return response()->json($data);
    }
}
