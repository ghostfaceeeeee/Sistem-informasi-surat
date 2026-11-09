<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutgoingLetterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('out_going_letters')->insert([
            [
                'nomor_surat' => '001/SK/FTx/2026',
                'tanggal' => '2026-08-01',
                'penerima' => 'Dekanat Fakultas Teknik',
                'perihal' => 'Undangan Rapat Evaluasi',
                'keterangan' => 'Undangan rapat evaluasi di ruang rapat 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nomor_surat' => '002/SK/FTx/2026',
                'tanggal' => '2026-09-01',
                'penerima' => 'Program Studi TI',
                'perihal' => 'Pemberitahuan Praktikum Web',
                'keterangan' => 'Jadwal pelaksanaan praktikum semester ganjil',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nomor_surat' => '003/SK/FTx/2026',
                'tanggal' => '2026-10-01',
                'penerima' => 'Laboratorium Komputer',
                'perihal' => 'Peminjaman Ruangan Lab',
                'keterangan' => 'Peminjaman lab untuk kegiatan ujian praktikum',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
