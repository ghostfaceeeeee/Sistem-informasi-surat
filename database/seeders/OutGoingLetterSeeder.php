<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutGoingLetterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('outgoing_letters')->truncate();

        DB::table('outgoing_letters')->insert([
            [
                'no_surat'   => '001/KLR/2023',
                'tanggal'    => '2023-01-10',
                'penerima'   => 'Budi Santoso',
                'perihal'    => 'Permohonan Data',
                'keterangan' => 'Surat permohonan data kegiatan mahasiswa.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_surat'   => '002/KLR/2023',
                'tanggal'    => '2023-02-15',
                'penerima'   => 'Siti Rahmawati',
                'perihal'    => 'Undangan Rapat',
                'keterangan' => 'Undangan rapat koordinasi proyek ABC pada tanggal 20 Februari 2023.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_surat'   => '003/KLR/2023',
                'tanggal'    => '2023-03-10',
                'penerima'   => 'Ahmad Fauzi',
                'perihal'    => 'Undangan Sosialisasi',
                'keterangan' => 'Undangan sosialisasi program pengabdian masyarakat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}