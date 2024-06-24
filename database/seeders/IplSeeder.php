<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IplSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unitIds = DB::table('units')->pluck('id')->toArray();
        $tarifIds = DB::table('tarifs')->pluck('id')->toArray();
        $statuses = ['Lunas', 'Belum Lunas'];
        $bulanIpl = 'Januari'; // Sesuaikan dengan kebutuhan bulan IPL
        $startDate = Carbon::now()->startOfMonth()->subMonths(1); // Sesuaikan dengan kebutuhan tanggal invoice

        $ipls = [];

        foreach ($unitIds as $unitId) {
            foreach ($tarifIds as $tarifId) {
                // Ambil informasi tarif
                $tarif = DB::table('tarifs')->where('id', $tarifId)->first();
                $hargaAir = $tarif->harga_air;
                $biayaAdmin = $tarif->biaya_admin;

                // Misalnya nilai meter_air_awal dan meter_air_akhir diambil secara random
                $meterAirAwal = rand(100, 1000);
                $meterAirAkhir = rand(1000, 2000);

                // Hitung pemakaian air
                $pemakaianAir = $meterAirAkhir - $meterAirAwal;
                if ($pemakaianAir < 0) {
                    $pemakaianAir = 0;
                }

                // Hitung tagihan air
                $tagihanAir = $hargaAir * $pemakaianAir;

                // Hitung total
                $totalTagihanBelumDibayar = rand(100000, 500000); // Nilai random untuk contoh
                $titipanPengelolaan = rand(10000, 50000); // Nilai random untuk contoh
                $titipanAir = rand(5000, 20000); // Nilai random untuk contoh
                $iuranPengelolaan = rand(5000, 20000);
                $danaCadangan = rand(5000, 20000);
                $denda = rand(0, 100); // Nilai random untuk contoh

                $total = $totalTagihanBelumDibayar +
                         $titipanPengelolaan +
                         $titipanAir +
                         $iuranPengelolaan +
                         $danaCadangan +
                         $tagihanAir +
                         $biayaAdmin +
                         $denda;

                // Ambil kepenghunian_id secara acak dari tabel kepenghunians
                $kepenghunianId = DB::table('kepenghunians')->inRandomOrder()->value('id');

                $ipls[] = [
                    'nomor_invoice' => 'IPL/' . Carbon::now()->format('m/y') . '/' . str_pad(count($ipls) + 1, 5, '0', STR_PAD_LEFT),
                    'bulan_ipl' => $bulanIpl,
                    'tanggal_invoice' => $startDate->format('Y-m-d'),
                    'jatuh_tempo' => $startDate->addDays(10)->format('Y-m-d'),
                    'unit_id' => $unitId,
                    'kepenghunian_id' => $kepenghunianId, // Sesuaikan dengan id yang valid dari kepenghunians
                    'total_tagihan_belum_dibayar' => $totalTagihanBelumDibayar,
                    'titipan_pengelolaan' => $titipanPengelolaan,
                    'titipan_air' => $titipanAir,
                    'iuran_pengelolaan' => $iuranPengelolaan,
                    'dana_cadangan' => $danaCadangan,
                    'meter_air_awal' => $meterAirAwal,
                    'meter_air_akhir' => $meterAirAkhir,
                    'tarif_id' => $tarifId,
                    'pemakaian_air' => $pemakaianAir,
                    'tagihan_air' => $tagihanAir,
                    'denda' => $denda,
                    'total' => $total,
                    'foto_bukti_pembayaran' => null, // Sesuaikan dengan logic aplikasi Anda
                    'status' => $statuses[array_rand($statuses)],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        DB::table('ipls')->insert($ipls);
    }
}

