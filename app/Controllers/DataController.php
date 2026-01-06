<?php

namespace App\Controllers;

use App\Services\BpsService;

class DataController extends BaseController
{
    public function index()
    {
        // Test data dari API Anda
        $data = [
            'layer2' => [
                'Total Penduduk' => '284438.8 Ribu Jiwa',
                'Penduduk Laki-laki' => 'Menunggu data',
                'Penduduk Perempuan' => 'Menunggu data',
                'WUS (15–49)' => 'Menunggu data',
            ],
            'layer4' => [
                'TFR' => 'Menunggu data',
            ]
        ];

        return view('data', [
            'title' => 'Data DP3AP2KB Kab. Tanah Laut',
            'data' => $data
        ]);
    }

    private function getIndicatorData(BpsService $bps, string $kode, string $tahun)
    {
        try {
            $res = $bps->get($kode, $tahun);

            // Debug: log response
            log_message('info', 'BPS Response for ' . $kode . ': ' . json_encode($res));

            if (empty($res)) {
                return 'API Error - No response';
            }

            if (($res['data-availability'] ?? '') === 'available') {
                $data = $bps->extract($res, $kode);
                $nilai = $data['nilai'] ?? '-';
                $unit = $data['unit'] ?? '';

                if ($unit && $nilai !== '-') {
                    return $nilai . ' ' . $unit;
                }
                return $nilai;
            } else {
                return 'Data tidak tersedia';
            }
        } catch (\Exception $e) {
            log_message('error', 'BPS Error: ' . $e->getMessage());
            return 'Error: ' . $e->getMessage();
        }
    }

    private function lastValue(BpsService $bps, string $kode, string $tahun)
    {
        $res = $bps->get($kode, $tahun);

        if (($res['data-availability'] ?? '') === 'available') {
            $rows = $bps->extract($res);
            $nilai = $rows[0]['nilai'] ?? '-';
        } else {
            $nilai = 'Tidak tersedia';
        }

        return $nilai;
    }
}
