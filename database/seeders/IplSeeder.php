<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Ipl;
use App\Models\DetailTagihanAwal;
use App\Models\DetailTitipanPengelolaan;
use App\Models\DetailIuranPengelolaan;
use App\Models\DetailTitipanAir;
use App\Models\DetailDanaCadangan;
use App\Models\DetailDenda;
use App\Models\DetailTagihanAir;
use App\Models\DetailBiayaAdmin;

class IplSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mendapatkan unit IDs dan status contoh
        $unitIds = DB::table('units')->pluck('id')->toArray();
        $statuses = ['Lunas', 'Belum Lunas'];
        $bulanIpl = 'Juli'; // Sesuaikan dengan kebutuhan bulan IPL
        $startDate = Carbon::now()->startOfMonth(); // Sesuaikan dengan kebutuhan tanggal invoice

        // Mengambil data tarif dari tabel detail_biaya_admins
        $biayaAdmin = DB::table('detail_biaya_admins')->value('biaya_admin'); // Mengambil biaya admin pertama

        foreach ($unitIds as $unitId) {
            // Ambil data detail tagihan air yang terkait dengan unit ini
            $detailTagihanAir = DetailTagihanAir::where('unit_id', $unitId)->first();
            $tagihanAir = $detailTagihanAir ? $detailTagihanAir->tagihan_air : 0;

            // Buat contoh data untuk tabel IPL
            $ipl = Ipl::create([
                'unit_id' => $unitId,
                'tagihan_air_id' => $detailTagihanAir ? $detailTagihanAir->id : null,
                'biaya_admin_id' => DB::table('detail_biaya_admins')->inRandomOrder()->value('id'), // Mengambil biaya admin secara acak
                'nomor_invoice' => 'INV/' . Str::random(5) . '/' . Carbon::now()->format('m/y') . '/' . str_pad(Ipl::count() + 1, 5, '0', STR_PAD_LEFT),
                'bulan_ipl' => $bulanIpl,
                'tanggal_invoice' => $startDate->format('Y-m-d'),
                'jatuh_tempo' => $startDate->copy()->addDays(30)->format('Y-m-d'),
                'total' => 0, // Inisialisasi total dengan 0
                'foto_bukti_pembayaran' => null,
                'status' => $statuses[array_rand($statuses)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Buat contoh data untuk detail tabel terkait dan update foreign key di IPL
            $detailTagihanAwal = DetailTagihanAwal::create([
                'ipl_id' => $ipl->id,
                'jumlah' => rand(100000, 500000)
            ]);
            $ipl->tagihan_awal_id = $detailTagihanAwal->id;

            $detailTitipanPengelolaan = DetailTitipanPengelolaan::create([
                'ipl_id' => $ipl->id,
                'jumlah' => rand(10000, 50000)
            ]);
            $ipl->titipan_pengelolaan_id = $detailTitipanPengelolaan->id;

            $detailIuranPengelolaan = DetailIuranPengelolaan::create([
                'ipl_id' => $ipl->id,
                'jumlah' => rand(5000, 20000)
            ]);
            $ipl->iuran_pengelolaan_id = $detailIuranPengelolaan->id;

            $detailTitipanAir = DetailTitipanAir::create([
                'ipl_id' => $ipl->id,
                'jumlah' => rand(5000, 20000)
            ]);
            $ipl->titipan_air_id = $detailTitipanAir->id;

            $detailDanaCadangan = DetailDanaCadangan::create([
                'ipl_id' => $ipl->id,
                'jumlah' => rand(5000, 20000)
            ]);
            $ipl->dana_cadangan_id = $detailDanaCadangan->id;

            $detailDenda = DetailDenda::create([
                'ipl_id' => $ipl->id,
                'jumlah' => rand(0, 100)
            ]);
            $ipl->denda_id = $detailDenda->id;

            // Hitung total
            $total = $detailTagihanAwal->jumlah + $detailTitipanPengelolaan->jumlah + $detailTitipanAir->jumlah + $detailIuranPengelolaan->jumlah + $detailDanaCadangan->jumlah + $tagihanAir + $biayaAdmin + $detailDenda->jumlah;
            $ipl->total = $total;

            // Simpan perubahan pada model IPL
            $ipl->save();
        }
    }
}
