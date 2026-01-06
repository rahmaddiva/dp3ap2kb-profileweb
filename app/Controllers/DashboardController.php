<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\BpsService;
use App\Models\BeritaModel;
use App\Models\ArtikelModel;
use App\Models\PengumumanModel;
use App\Models\MediaModel;
use App\Models\MediaFilesModel;
use App\Models\PegawaiModel;
use App\Models\InstagramPostModel;

class DashboardController extends BaseController
{

    protected $beritaModel;
    protected $artikelModel;

    protected $pengumumanModel;

    protected $mediaModel;
    protected $mediaFilesModel;

    protected $pegawaiModel;

    protected $instagramPostModel;


    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->artikelModel = new ArtikelModel();
        $this->pengumumanModel = new PengumumanModel();
        $this->mediaModel = new MediaModel();
        $this->mediaFilesModel = new MediaFilesModel();
        $this->pegawaiModel = new PegawaiModel();
        $this->instagramPostModel = new InstagramPostModel();
    }

    private function normalizeBps(array $kelahiran, array $kematian): array
    {
        $map = [];

        foreach ($kelahiran['data']['data'] ?? [] as $row) {
            $map[$row['tahun']]['tfr'] = (float) $row['nilai'];
        }

        foreach ($kematian['data']['data'] ?? [] as $row) {
            $map[$row['tahun']]['imr'] = (float) $row['nilai'];
        }

        ksort($map); // urut tahun naik

        return [
            'labels' => array_keys($map),
            'tfr' => array_column($map, 'tfr'),
            'imr' => array_column($map, 'imr'),
        ];
    }


    public function index()
    {
        $title = [
            "data" => "Dashboard",
        ];
        return view("dashboard/index", $title);
    }

    public function landingpage()
    {
        // Fetch latest published beritas for use on the landing page
        $perPage = 10;
        $beritas = $this->beritaModel
            ->where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->findAll($perPage);

        $data = [
            'data' => 'Landing Page',
            'beritas' => $beritas,
            'berita_terbaru' => $this->beritaModel->getBeritaTerbaru(6),
        ];

        return view('landingpage', $data);
    }

    public function pejabat()
    {
        $title = [
            "title" => "Pegawai DP3AP2KB Kab. Tanah Laut",
            "pegawai" => $this->pegawaiModel->findAll(),
            "options" => [
                'Kepala Dinas',
                'Sekretaris',
                'Sub Bagian Perencanaan dan Keuangan',
                'Sub Bagian Umum dan Kepegawaian',
                'Kepala Bidang Keluarga Berencana dan Keluarga Sejahtera',
                'Kepala Bidang Pengendalian Penduduk Data dan Informasi',
                'Kepala Bidang Pemberdayaan Perempuan dan Perlindungan Anak',
                'Kepala UPTD PPA',
                'Jabatan Fungsional Lainnya',
                'Pegawai Outsorcing'
            ],

        ];
        return view("pegawai", $title);
    }

    public function postingan()
    {
        $perPage = 6; // show up to 6 posts per page (optimal 3–6)
        $posts = $this->instagramPostModel
            ->where('is_active', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);

        $data = [
            'title' => 'Reels DP3AP2KB Kab. Tanah Laut',
            'instagram_posts' => $posts,
            'pager' => $this->instagramPostModel->pager,
        ];

        return view('postingan', $data);
    }



    public function visi_misi()
    {
        $title = [
            "title" => "Visi & Misi DP3AP2KB Kab. Tanah Laut",
        ];
        return view("visi_misi", $title);
    }

    public function tugas_pokok()
    {
        $title = [
            "title" => "Tugas Pokok DP3AP2KB Kab. Tanah Laut",
        ];
        return view("tugas_pokok", $title);
    }

    public function dasar_hukum()
    {
        $title = [
            "title" => "Dasar Hukum DP3AP2KB Kab. Tanah Laut",
        ];
        return view("dasar_hukum", $title);
    }

    public function faq()
    {
        $title = [
            "title" => "FAQ DP3AP2KB Kab. Tanah Laut",
        ];
        return view("faq", $title);
    }

    public function data_bps()
    {
        $bps = new BpsService();

        $chart = $this->normalizeBps(
            $bps->kelahiran(),
            $bps->kematian()
        );

        return view('data', [
            'title' => 'Data DP3AP2KB Kab. Tanah Laut',
            'chart' => $chart
        ]);
    }

    
    public function berita()
    {
        $perPage = 10;
        $beritas = $this->beritaModel
            ->where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);

        $data = [
            'title' => 'Berita DP3AP2KB Kab. Tanah Laut',
            'beritas' => $beritas,
            'berita_terbaru' => $this->beritaModel->getBeritaTerbaru(),
            'pager' => $this->beritaModel->pager,
        ];

        return view('berita', $data);
    }

    public function pengumuman()
    {

        $perPage = 10;
        $pengumumans = $this->pengumumanModel
            ->where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);

        $data = [
            'title' => 'Pengumuman DP3AP2KB Kab. Tanah Laut',
            'pengumumans' => $pengumumans,
            'pager' => $this->pengumumanModel->pager,
        ];

        return view('pengumuman', $data);
    }

    public function artikel()
    {
        $perPage = 10;
        $artikels = $this->artikelModel
            ->where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);

        $data = [
            'title' => 'Artikel DP3AP2KB Kab. Tanah Laut',
            'artikels' => $artikels,
            'pager' => $this->artikelModel->pager,
        ];

        return view('artikel', $data);
    }

    public function foto()
    {
        // Paginate galleries (media items) with kategori = 'foto' and status published
        $perPage = 10;
        $galleries = $this->mediaModel
            ->where('kategori', 'foto')
            ->where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);

        $pager = $this->mediaModel->pager;

        $fotos = [];
        if (!empty($galleries)) {
            foreach ($galleries as $g) {
                $files = $this->mediaFilesModel->where('media_id', $g['id_media'])->orderBy('order', 'ASC')->findAll();
                $fotos[] = [
                    'gallery' => $g,
                    'files' => $files,
                ];
            }
        }

        $data = [
            'title' => 'Foto DP3AP2KB Kab. Tanah Laut',
            'fotos' => $fotos,
            'pager' => $pager,
        ];

        return view('foto', $data);
    }

    public function infografis()
    {
        $perPage = 10;
        $pageItems = $this->mediaModel
            ->where('kategori', 'infografis')
            ->where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);

        // Attach media_files for each item on the current page
        $infografiss = [];
        if (!empty($pageItems)) {
            foreach ($pageItems as $it) {
                $files = $this->mediaFilesModel->where('media_id', $it['id_media'])->orderBy('order', 'ASC')->findAll();
                $infografiss[] = [
                    'item' => $it,
                    'files' => $files,
                ];
            }
        }

        $data = [
            'title' => 'Infografis DP3AP2KB Kab. Tanah Laut',
            'infografiss' => $infografiss,
            'pager' => $this->mediaModel->pager,
        ];

        return view('infografis', $data);
    }






    public function artikel_detail($slug = null)
    {
        if (empty($slug)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan.');
        }

        $artikel = $this->artikelModel->where('slug', $slug)->first();
        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Artikel dengan slug '{$slug}' tidak ditemukan.");
        }

        $data = [
            'title' => $artikel['title'] ?? 'Detail Artikel',
            'artikel' => $artikel,
            // fetch 5 other published articles (exclude current)
            'other_artikels' => $this->artikelModel
                ->where('status', 'published')
                ->where('slug !=', $slug)
                ->orderBy('created_at', 'DESC')
                ->findAll(5),
        ];

        return view('artikel/detail_public', $data);
    }

    public function berita_detail($slug = null)
    {
        if (empty($slug)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Berita tidak ditemukan.');
        }

        $berita = $this->beritaModel->where('slug', $slug)->first();
        if (!$berita) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Berita dengan slug '{$slug}' tidak ditemukan.");
        }

        $data = [
            'title' => $berita['title'] ?? 'Detail Berita',
            'berita' => $berita,
            'other_beritas' => $this->beritaModel
                ->where('status', 'published')
                ->where('slug !=', $slug)
                ->orderBy('created_at', 'DESC')
                ->findAll(5),
        ];

        return view('berita/detail_public', $data);
    }

    public function pengumuman_detail($slug = null)
    {
        if (empty($slug)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengumuman tidak ditemukan.');
        }

        $pengumuman = $this->pengumumanModel->where('slug', $slug)->first();
        if (!$pengumuman) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Pengumuman dengan slug '{$slug}' tidak ditemukan.");
        }

        $data = [
            'title' => $pengumuman['title'] ?? 'Detail Pengumuman',
            'pengumuman' => $pengumuman,
            // fetch 5 other published pengumumans (exclude current)
            'other_pengumumans' => $this->pengumumanModel
                ->where('status', 'published')
                ->where('slug !=', $slug)
                ->orderBy('created_at', 'DESC')
                ->findAll(5),
        ];

        return view('pengumuman/detail_public', $data);
    }

    public function infografis_detail($slug = null)
    {
        if (empty($slug)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Infografis tidak ditemukan.');
        }

        $infografis = $this->mediaModel->where('slug', $slug)->first();
        if (!$infografis) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Infografis dengan slug '{$slug}' tidak ditemukan.");
        }

        $files = $this->mediaFilesModel->where('media_id', $infografis['id_media'])->orderBy('order', 'ASC')->findAll();

        $data = [
            'title' => $infografis['title'] ?? 'Detail Infografis',
            'infografis' => $infografis,
            'files' => $files,
            'other_infografiss' => $this->mediaModel
                ->where('kategori', 'infografis')
                ->where('status', 'published')
                ->where('slug !=', $slug)
                ->orderBy('created_at', 'DESC')
                ->findAll(5),
        ];

        return view('infografis/detail_public', $data);
    }
}
