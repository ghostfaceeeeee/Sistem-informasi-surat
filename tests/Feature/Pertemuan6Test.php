<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\incomingLetter;
use App\Models\OutGoingLetter;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class Pertemuan6Test extends TestCase
{
    use RefreshDatabase;
    protected User $petugas;
    protected User $pembaca;
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        $this->petugas = User::firstOrCreate(
            ['email' => 'petugas_test@example.com'],
            ['name' => 'Petugas Test', 'password' => bcrypt('password'), 'role' => 'petugas']
        );
        $this->petugas->role = 'petugas';
        $this->petugas->save();

        $this->pembaca = User::firstOrCreate(
            ['email' => 'pembaca_test@example.com'],
            ['name' => 'Pembaca Test', 'password' => bcrypt('password'), 'role' => 'pembaca']
        );
        $this->pembaca->role = 'pembaca';
        $this->pembaca->save();

        $this->category = Category::firstOrCreate(
            ['nama' => 'Undangan'],
            ['created_at' => now(), 'updated_at' => now()]
        );
    }

    /** Skenario 1: Login petugas; tambah surat dengan kategori -> Data dan category_id tersimpan */
    public function test_01_petugas_can_create_surat_masuk_with_category(): void
    {
        $response = $this->actingAs($this->petugas)->post(route('surat-masuk.store'), [
            'nomor_surat' => '001/SM/TEST/2026',
            'tanggal' => '2026-11-23',
            'pengirim' => 'Dinas Pendidikan',
            'perihal' => 'Undangan Rapat',
            'keterangan' => 'Keterangan uji',
            'category_id' => $this->category->id,
        ]);

        $response->assertRedirect(route('surat-masuk.index'));
        $this->assertDatabaseHas('incoming_letters', [
            'nomor_surat' => '001/SM/TEST/2026',
            'category_id' => $this->category->id,
        ]);
    }

    /** Skenario 2: Tambah surat tanpa kategori -> Tetap tersimpan (nullable) */
    public function test_02_petugas_can_create_surat_without_category(): void
    {
        $response = $this->actingAs($this->petugas)->post(route('surat-masuk.store'), [
            'nomor_surat' => '002/SM/TEST/2026',
            'tanggal' => '2026-11-23',
            'pengirim' => 'Kementerian',
            'perihal' => 'Pemberitahuan Umum',
            'category_id' => '',
        ]);

        $response->assertRedirect(route('surat-masuk.index'));
        $this->assertDatabaseHas('incoming_letters', [
            'nomor_surat' => '002/SM/TEST/2026',
            'category_id' => null,
        ]);
    }

    /** Skenario 3: Unggah PDF <= 2 MB -> File tersimpan dan tautan muncul */
    public function test_03_petugas_can_upload_valid_pdf_lampiran(): void
    {
        $file = UploadedFile::fake()->create('dokumen.pdf', 1024, 'application/pdf');

        $response = $this->actingAs($this->petugas)->post(route('surat-masuk.store'), [
            'nomor_surat' => '003/SM/PDF/2026',
            'tanggal' => '2026-11-23',
            'pengirim' => 'Sekretariat',
            'perihal' => 'Lampiran PDF',
            'category_id' => $this->category->id,
            'lampiran' => $file,
        ]);

        $response->assertRedirect(route('surat-masuk.index'));

        $surat = incomingLetter::where('nomor_surat', '003/SM/PDF/2026')->first();
        $this->assertNotNull($surat->lampiran);
        Storage::disk('public')->assertExists($surat->lampiran);

        $showResponse = $this->actingAs($this->petugas)->get(route('surat-masuk.show', $surat->id));
        $showResponse->assertStatus(200);
        $showResponse->assertSee('Lihat lampiran');
    }

    /** Skenario 4: Unggah file .exe atau > 2 MB -> Validasi gagal */
    public function test_04_upload_invalid_file_fails_validation(): void
    {
        $exeFile = UploadedFile::fake()->create('virus.exe', 500);

        $response = $this->actingAs($this->petugas)->post(route('surat-masuk.store'), [
            'nomor_surat' => '004/SM/BAD/2026',
            'tanggal' => '2026-11-23',
            'pengirim' => 'Pengirim Jahat',
            'perihal' => 'Uji File Salah',
            'lampiran' => $exeFile,
        ]);

        $response->assertSessionHasErrors('lampiran');

        $largeFile = UploadedFile::fake()->create('besar.pdf', 3000, 'application/pdf');

        $response2 = $this->actingAs($this->petugas)->post(route('surat-masuk.store'), [
            'nomor_surat' => '005/SM/OVER/2026',
            'tanggal' => '2026-11-23',
            'pengirim' => 'Pengirim Besar',
            'perihal' => 'Uji File Terlalu Besar',
            'lampiran' => $largeFile,
        ]);

        $response2->assertSessionHasErrors('lampiran');
    }

    /** Skenario 5: Cari berdasarkan pengirim/perihal -> Hasil sesuai kata kunci */
    public function test_05_search_filter_returns_expected_results(): void
    {
        incomingLetter::create([
            'nomor_surat' => 'UNIQ-SEARCH-01',
            'tanggal' => '2026-11-23',
            'pengirim' => 'Badan Riset Khusus',
            'perihal' => 'Pengumuman Riset Unik',
            'category_id' => $this->category->id,
        ]);

        $response = $this->actingAs($this->pembaca)->get(route('surat-masuk.index', ['q' => 'Riset Khusus']));
        $response->assertStatus(200);
        $response->assertSee('UNIQ-SEARCH-01');

        $responseEmpty = $this->actingAs($this->pembaca)->get(route('surat-masuk.index', ['q' => 'TidakAdaStringIni123']));
        $responseEmpty->assertStatus(200);
        $responseEmpty->assertDontSee('UNIQ-SEARCH-01');
    }

    /** Skenario 6: Filter kategori dan pagination -> withQueryString */
    public function test_06_filter_category_and_pagination_query_string(): void
    {
        $response = $this->actingAs($this->pembaca)->get(route('surat-masuk.index', [
            'category_id' => $this->category->id,
            'page' => 1,
        ]));

        $response->assertStatus(200);
        $response->assertSee($this->category->nama);
    }

    /** Skenario 7: Edit kategori dan ganti lampiran -> Perubahan tersimpan */
    public function test_07_edit_category_and_replace_lampiran(): void
    {
        $oldFile = UploadedFile::fake()->create('lama.pdf', 500, 'application/pdf');
        $newCat = Category::firstOrCreate(['nama' => 'Pemberitahuan']);

        $surat = incomingLetter::create([
            'nomor_surat' => 'EDIT-01',
            'tanggal' => '2026-11-23',
            'pengirim' => 'Pengirim Awal',
            'perihal' => 'Perihal Awal',
            'category_id' => $this->category->id,
            'lampiran' => $oldFile->store('lampiran-surat', 'public'),
        ]);

        $oldFilePath = $surat->lampiran;
        Storage::disk('public')->assertExists($oldFilePath);

        $newFile = UploadedFile::fake()->create('baru.pdf', 600, 'application/pdf');

        $response = $this->actingAs($this->petugas)->put(route('surat-masuk.update', $surat->id), [
            'nomor_surat' => 'EDIT-01-REVISED',
            'tanggal' => '2026-11-23',
            'pengirim' => 'Pengirim Baru',
            'perihal' => 'Perihal Baru',
            'category_id' => $newCat->id,
            'lampiran' => $newFile,
        ]);

        $response->assertRedirect(route('surat-masuk.index'));
        $surat->refresh();

        $this->assertEquals($newCat->id, $surat->category_id);
        $this->assertEquals('EDIT-01-REVISED', $surat->nomor_surat);
        Storage::disk('public')->assertExists($surat->lampiran);
        Storage::disk('public')->assertMissing($oldFilePath);
    }

    /** Skenario 8: Hapus surat berlampiran -> Record dan file terkait terhapus */
    public function test_08_destroy_deletes_record_and_lampiran(): void
    {
        $file = UploadedFile::fake()->create('hapus.pdf', 500, 'application/pdf');
        $surat = incomingLetter::create([
            'nomor_surat' => 'DELETE-ME',
            'tanggal' => '2026-11-23',
            'pengirim' => 'Hapus Pengirim',
            'perihal' => 'Hapus Perihal',
            'lampiran' => $file->store('lampiran-surat', 'public'),
        ]);

        $filePath = $surat->lampiran;
        Storage::disk('public')->assertExists($filePath);

        $response = $this->actingAs($this->petugas)->delete(route('surat-masuk.destroy', $surat->id));
        $response->assertRedirect(route('surat-masuk.index'));

        $this->assertDatabaseMissing('incoming_letters', ['id' => $surat->id]);
        Storage::disk('public')->assertMissing($filePath);
    }

    /** Skenario 9: Login pembaca; buka daftar/detail -> Bisa melihat data */
    public function test_09_pembaca_can_view_index_and_detail(): void
    {
        $surat = incomingLetter::create([
            'nomor_surat' => 'PEMBACA-VIEW',
            'tanggal' => '2026-11-23',
            'pengirim' => 'Pengirim Pembaca',
            'perihal' => 'Perihal Pembaca',
            'category_id' => $this->category->id,
        ]);

        $indexRes = $this->actingAs($this->pembaca)->get(route('surat-masuk.index'));
        $indexRes->assertStatus(200);
        $indexRes->assertSee('PEMBACA-VIEW');

        $showRes = $this->actingAs($this->pembaca)->get(route('surat-masuk.show', $surat->id));
        $showRes->assertStatus(200);
        $showRes->assertSee('PEMBACA-VIEW');
    }

    /** Skenario 10: Pembaca akses URL create/edit langsung -> Ditolak 403 */
    public function test_10_pembaca_cannot_access_create_or_edit(): void
    {
        $surat = incomingLetter::create([
            'nomor_surat' => 'FORBIDDEN-01',
            'tanggal' => '2026-11-23',
            'pengirim' => 'Pengirim X',
            'perihal' => 'Perihal X',
        ]);

        $createRes = $this->actingAs($this->pembaca)->get(route('surat-masuk.create'));
        $createRes->assertStatus(403);

        $editRes = $this->actingAs($this->pembaca)->get(route('surat-masuk.edit', $surat->id));
        $editRes->assertStatus(403);
    }

    /** Skenario 11: Tamu tanpa login membuka surat -> Diarahkan ke login */
    public function test_11_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('surat-masuk.index'));
        $response->assertRedirect(route('login'));
    }

    /** Skenario 12: Surat lama tanpa kategori -> Tetap tampil tanpa error */
    public function test_12_surat_without_category_renders_safely(): void
    {
        $surat = incomingLetter::create([
            'nomor_surat' => 'NO-CAT-01',
            'tanggal' => '2026-11-23',
            'pengirim' => 'Pengirim Lama',
            'perihal' => 'Surat Lama Tanpa Kategori',
            'category_id' => null,
        ]);

        $response = $this->actingAs($this->pembaca)->get(route('surat-masuk.show', $surat->id));
        $response->assertStatus(200);
        $response->assertSee('Tanpa kategori');
    }

    /** Latihan Mandiri: Surat Keluar fitur relasi kategori, lampiran, pencarian, dan role access */
    public function test_13_surat_keluar_crud_category_and_lampiran(): void
    {
        $file = UploadedFile::fake()->create('surat_keluar.pdf', 500, 'application/pdf');

        // Create
        $response = $this->actingAs($this->petugas)->post(route('surat-keluar.store'), [
            'nomor_surat' => 'SK-001/TEST/2026',
            'tanggal' => '2026-11-23',
            'penerima' => 'Universitas Indonesia',
            'perihal' => 'Permohonan Kerjasama',
            'category_id' => $this->category->id,
            'lampiran' => $file,
        ]);

        $response->assertRedirect(route('surat-keluar.index'));

        $sk = OutGoingLetter::where('nomor_surat', 'SK-001/TEST/2026')->first();
        $this->assertNotNull($sk);
        $this->assertEquals($this->category->id, $sk->category_id);
        $this->assertNotNull($sk->lampiran);
        Storage::disk('public')->assertExists($sk->lampiran);

        // Pembaca can view
        $viewRes = $this->actingAs($this->pembaca)->get(route('surat-keluar.show', $sk->id));
        $viewRes->assertStatus(200);
        $viewRes->assertSee('SK-001/TEST/2026');
        $viewRes->assertSee('Universitas Indonesia');
        $viewRes->assertSee($this->category->nama);

        // Pembaca cannot edit
        $editRes = $this->actingAs($this->pembaca)->get(route('surat-keluar.edit', $sk->id));
        $editRes->assertStatus(403);
    }

    /** Skenario 14: Petugas hapus lampiran surat masuk -> File terhapus, record tetap ada */
    public function test_14_petugas_can_delete_lampiran_surat_masuk(): void
    {
        $file = UploadedFile::fake()->create('hapus_lampiran.pdf', 500, 'application/pdf');
        $surat = incomingLetter::create([
            'nomor_surat' => 'DEL-LAMP-01',
            'tanggal' => '2026-11-23',
            'pengirim' => 'Pengirim Lampiran',
            'perihal' => 'Perihal Lampiran',
            'lampiran' => $file->store('lampiran-surat', 'public'),
        ]);

        $filePath = $surat->lampiran;
        Storage::disk('public')->assertExists($filePath);

        $response = $this->actingAs($this->petugas)
            ->delete(route('surat-masuk.delete-lampiran', $surat->id));

        $response->assertRedirect(route('surat-masuk.edit', $surat->id));
        $surat->refresh();

        $this->assertNull($surat->lampiran);
        Storage::disk('public')->assertMissing($filePath);
        $this->assertDatabaseHas('incoming_letters', ['id' => $surat->id, 'nomor_surat' => 'DEL-LAMP-01']);
    }

    /** Skenario 15: Petugas hapus lampiran surat keluar -> File terhapus, record tetap ada */
    public function test_15_petugas_can_delete_lampiran_surat_keluar(): void
    {
        $file = UploadedFile::fake()->create('hapus_lampiran_sk.pdf', 500, 'application/pdf');
        $surat = OutGoingLetter::create([
            'nomor_surat' => 'SK-DEL-LAMP-01',
            'tanggal' => '2026-11-23',
            'penerima' => 'Penerima Lampiran',
            'perihal' => 'Perihal SK Lampiran',
            'lampiran' => $file->store('lampiran-surat', 'public'),
        ]);

        $filePath = $surat->lampiran;
        Storage::disk('public')->assertExists($filePath);

        $response = $this->actingAs($this->petugas)
            ->delete(route('surat-keluar.delete-lampiran', $surat->id));

        $response->assertRedirect(route('surat-keluar.edit', $surat->id));
        $surat->refresh();

        $this->assertNull($surat->lampiran);
        Storage::disk('public')->assertMissing($filePath);
        $this->assertDatabaseHas('out_going_letters', ['id' => $surat->id, 'nomor_surat' => 'SK-DEL-LAMP-01']);
    }

    /** Skenario 16: Pembaca tidak bisa hapus lampiran -> 403 Forbidden */
    public function test_16_pembaca_cannot_delete_lampiran(): void
    {
        $file = UploadedFile::fake()->create('forbidden_lampiran.pdf', 500, 'application/pdf');
        $surat = incomingLetter::create([
            'nomor_surat' => 'FORBIDDEN-LAMP-01',
            'tanggal' => '2026-11-23',
            'pengirim' => 'Pengirim Forbidden',
            'perihal' => 'Perihal Forbidden',
            'lampiran' => $file->store('lampiran-surat', 'public'),
        ]);

        $response = $this->actingAs($this->pembaca)
            ->delete(route('surat-masuk.delete-lampiran', $surat->id));

        $response->assertStatus(403);
        $surat->refresh();
        $this->assertNotNull($surat->lampiran);
        Storage::disk('public')->assertExists($surat->lampiran);
    }
}
