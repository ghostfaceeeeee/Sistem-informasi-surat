<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutgoingLetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('out_going_letters')->insert([
            [
                'nomor_surat' => '001/FTx/2026',
                'tanggal' => '2026-08-1',
                'penerima' => 'Teknik',
                'perihal' => 'undangan rapat',
                'keterangan' => 'undangan rapat di ruang 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nomor_surat' => '002/FTx/2026',
                'tanggal' => '2026-09-1',
                'penerima' => 'Informasi',
                'perihal' => 'undangan sukses',
                'keterangan' => 'undangan sukses dalam pelaksanaan kegiatan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nomor_surat' => '003/FTx/2026',
                'tanggal' => '2026-10-1',
                'penerima' => 'elektro',
                'perihal' => 'undangan Akademik',
                'keterangan' => 'undangan akademik untuk kegiatan seminar',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
