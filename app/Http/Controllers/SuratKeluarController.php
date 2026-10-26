<?php

namespace App\Http\Controllers;

class SuratKeluarController extends Controller
{
    private function dataSurat(): array
    {
        return [
            1 => [
                'nomor_surat' => '001/FT/X/2026',
                'tanggal' => '04-10-2026',
                'tujuan' => 'BAA',
                'perihal' => 'Pemberitahuan Akademik',
            ],
            2 => [
                'nomor_surat' => '002/FT/X/2026',
                'tanggal' => '05-10-2026',
                'tujuan' => 'Dekanat',
                'perihal' => 'Undangan Rapat',
            ],
            3 => [
                'nomor_surat' => '003/FT/X/2026',
                'tanggal' => '06-10-2026',
                'tujuan' => 'LPPM',
                'perihal' => 'Undangan Sosialisasi',
            ],
        ];
    }

    public function index()
    {
        $suratKeluar = $this->dataSurat();

        return view('surat-keluar.index', [
            'suratKeluar' => $suratKeluar,
        ]);
    }

    public function show($id)
    {
        $suratKeluar = $this->dataSurat();

        if (!array_key_exists((int) $id, $suratKeluar)) {
            abort(404, 'Surat keluar tidak ditemukan.');
        }

        $surat = $suratKeluar[(int) $id];

        return view('surat-keluar.show', [
            'surat' => $surat,
            'id' => (int) $id,
        ]);
    }
}
