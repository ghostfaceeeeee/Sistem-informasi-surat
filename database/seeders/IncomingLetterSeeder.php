<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomingLetterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('incoming_letters')->insert([
            [
                'nomor_surat' => '001/FTx/2026',
                'tanggal' => '2026-08-01',
                'pengirim' => 'Fakultas Teknik',
                'perihal' => 'Undangan Rapat Koordinasi',
                'keterangan' => 'Undangan rapat di Ruang Pertemuan 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nomor_surat' => '002/FTx/2026',
                'tanggal' => '2026-09-01',
                'pengirim' => 'Teknologi Informasi',
                'perihal' => 'Undangan Sukses Pelaksanaan',
                'keterangan' => 'Undangan pelaksanaan kegiatan praktikum bersama',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nomor_surat' => '003/FTx/2026',
                'tanggal' => '2026-10-01',
                'pengirim' => 'Teknik Elektro',
                'perihal' => 'Undangan Seminar Akademik',
                'keterangan' => 'Undangan seminar nasional akademik elektro',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
