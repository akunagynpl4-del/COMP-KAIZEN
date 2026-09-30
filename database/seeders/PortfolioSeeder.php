<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'Pernikahan Mewah di Ballroom Grand Hyatt', 'event_type' => 'Pernikahan', 'event_date' => '2026-03-15', 'is_featured' => true,
             'description' => 'Dekorasi pernikahan bertema white elegance dengan sentuhan bunga segar mawar putih dan peach. Melayani 500 tamu undangan dengan setup tenda, lighting premium, dan sound system profesional.'],
            ['title' => 'Ulang Tahun ke-17 Nadya di Kafe Rooftop', 'event_type' => 'Ulang Tahun', 'event_date' => '2026-05-20', 'is_featured' => true,
             'description' => 'Pesta ulang tahun bertema pink boho dengan dekorasi balon, backdrop foto interaktif, dan pencahayaan fairy light yang memukau.'],
            ['title' => 'Reuni Akbar Alumni SMA Nusantara', 'event_type' => 'Reuni', 'event_date' => '2026-02-10', 'is_featured' => false,
             'description' => 'Penanganan reuni 300 alumni dengan tenda roder besar, kursi, meja, sound system, dan dekorasi bertema nostalgia.'],
            ['title' => 'Sunatan Massal di Lapangan RW 05', 'event_type' => 'Sunatan', 'event_date' => '2026-04-12', 'is_featured' => true,
             'description' => 'Tenda besar 20x40m untuk sunatan massal 50 anak. Dilengkapi kursi, meja registrasi, dan sound system untuk sambutan.'],
            ['title' => 'Launching Produk Kosmetik BeautyFirst', 'event_type' => 'Corporate Event', 'event_date' => '2026-06-08', 'is_featured' => false,
             'description' => 'Event peluncuran produk dengan setup stage profesional, LED backdrop, tata cahaya moving head, dan sound system bertenaga tinggi.'],
            ['title' => 'Wisuda Angkatan 2026 Universitas Maju', 'event_type' => 'Wisuda', 'event_date' => '2026-07-22', 'is_featured' => true,
             'description' => 'Dekorasi wisuda untuk 800 wisudawan dengan tenda besar, kursi Tiffany, panggung, dan sound system lengkap.'],
        ];

        foreach ($items as $i => $item) {
            Portfolio::updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'title'       => $item['title'],
                    'type'        => 'event',
                    'event_date'  => $item['event_date'],
                    'description' => $item['description'],
                    'is_featured' => $item['is_featured'],
                    'order'       => $i + 1,
                ],
            );
        }
    }
}
