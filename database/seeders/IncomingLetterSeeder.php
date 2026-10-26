<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomingLetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('incoming_letters')->insert([
            [
                'no_surat'   => '001/ABC/2023',
                'tanggal'    => '2023-01-10',
                'pengirim'   => 'John Doe',
                'perihal'    => 'Permohonan Informasi',
                'keterangan' => 'Surat permohonan informasi terkait proyek XYZ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_surat'   => '002/DEF/2023',
                'tanggal'    => '2023-02-15',
                'pengirim'   => 'Jane Smith',
                'perihal'    => 'Undangan Rapat',
                'keterangan' => 'Undangan rapat koordinasi proyek ABC pada tanggal 20 Februari 2023.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_surat'   => '003/GHI/2023',
                'tanggal'    => '2023-03-10',
                'pengirim'   => 'Michael Johnson',
                'perihal'    => 'Laporan Kegiatan',
                'keterangan' => 'Laporan kegiatan bulanan terkait proyek DEF.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}