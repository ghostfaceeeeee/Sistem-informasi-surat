<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('out_going_letters', 'pengirim')
            && ! Schema::hasColumn('out_going_letters', 'penerima')) {
            Schema::table('out_going_letters', function (Blueprint $table) {
                $table->renameColumn('pengirim', 'penerima');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('out_going_letters', 'penerima')
            && ! Schema::hasColumn('out_going_letters', 'pengirim')) {
            Schema::table('out_going_letters', function (Blueprint $table) {
                $table->renameColumn('penerima', 'pengirim');
            });
        }
    }
};