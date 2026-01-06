<?php

namespace App\Services;

class BpsService
{
    private string $apiKey;
    private string $domain = '0000';
    private string $baseUrl = 'https://webapi.bps.go.id/v1/api/list/model/data';

    private array $indikator = [
        'penduduk_total' => [
            'var_id' => 1975,
            'periode' => '125' // kode periode BPS
        ],
        'penduduk_lk' => [
            'var_id' => 1976,
            'periode' => '125'
        ],
        'penduduk_pr' => [
            'var_id' => 1977,
            'periode' => '125'
        ],
        'wus' => [
            'var_id' => 1978,
            'periode' => '125'
        ],
        'tfr' => [
            'var_id' => 1979,
            'periode' => '125'
        ],
    ];


    public function __construct()
    {
        $this->apiKey = env('BPS_API_KEY');
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    public function get(string $kode, string $tahun = ''): array
    {
        if (!isset($this->indikator[$kode])) {
            return [];
        }

        $cfg = $this->indikator[$kode];
        $periode = !empty($tahun) ? $tahun : $cfg['periode'];

        $url = "https://webapi.bps.go.id/v1/api/list/model/data"
            . "/lang/ind"
            . "/domain/{$this->domain}"
            . "/var/{$cfg['var_id']}"
            . "/th/{$periode}"
            . "/key/{$this->apiKey}/";

        $client = \Config\Services::curlrequest(['timeout' => 10]);
        $res = $client->get($url);

        return json_decode($res->getBody(), true) ?? [];
    }


    public function extract(array $response, string $kode = ''): array
    {
        $dataContent = $response['datacontent'] ?? [];
        
        if (empty($dataContent)) {
            return [];
        }

        // Ambil key pertama dari datacontent
        $key = array_key_first($dataContent);
        $nilai = $dataContent[$key] ?? null;

        // Ambil metadata dari var
        $metadata = [];
        if (!empty($kode) && !empty($response['var'])) {
            foreach ($response['var'] as $var) {
                if (isset($this->indikator[$kode]) && $var['val'] == $this->indikator[$kode]['var_id']) {
                    $metadata = [
                        'label' => $var['label'] ?? '',
                        'unit' => $var['unit'] ?? '',
                        'nilai' => $nilai
                    ];
                    break;
                }
            }
        }

        return $metadata ?: ['nilai' => $nilai];
    }
}
