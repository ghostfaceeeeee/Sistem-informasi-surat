<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Undangan', 'Pemberitahuan', 'Permohonan'] as $nama) {
            DB::table('categories')->updateOrInsert(
                ['nama' => $nama],
                ['updated_at' => now(), 'created_at' => now()]
            );
        }
    }
}
