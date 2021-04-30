<?php

namespace Database\Seeders;

use App\Models\Symptom;
use Illuminate\Database\Seeder;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'id' => 1,
                "code" => "S001",
                'name' => 'Berkeringat dingin atau berkeringat berlebihan'
            ],
            [
                'id' => 2,
                "code" => "S002",
                'name' => 'Tangan atau anggota tubuh bergetar'
            ],
            [
                'id' => 3,
                "code" => "S003",
                'name' => 'Pusing, sakit di bagian kepala hingga terasa ingin pingsan'
            ],
            [
                'id' => 4,
                "code" => "S004",
                'name' => 'Sesak nafas, nyeri di bagian dada'
            ],
            [
                'id' => 5,
                "code" => "S005",
                'name' => 'Jantung berdetak kencang'
            ],
            [
                'id' => 6,
                "code" => "S006",
                'name' => 'Mual, nyeri di bagian perut'
            ],
            [
                'id' => 7,
                "code" => "S007",
                'name' => 'Gugup, cemas, dan gelisah'
            ],
            [
                'id' => 8,
                "code" => "S008",
                'name' => 'Lemas dan mudah lelah'
            ],
            [
                'id' => 9,
                "code" => "S009",
                'name' => 'Otot tegang atau berasa nyeri'
            ],
            [
                'id' => 10,
                "code" => "S010",
                'name' => 'Sulit berkonsentrasi atau fokus'
            ],
            [
                'id' => 11,
                "code" => "S011",
                'name' => 'Gangguan Tidur'
            ],
            [
                'id' => 12,
                "code" => "S012",
                'name' => 'Terjadi berulang-ulang +- dalam 1 Bulan'
            ],
            [
                'id' => 13,
                "code" => "S013",
                'name' => 'Panik, takut, dan menghindar ketika berada di tempat umum atau di tengah keramaian'
            ],
            [
                'id' => 14,
                "code" => "S014",
                'name' => 'Panik, takut, menghindar ketika berada di tempat yang membuat orang tersebut merasa terjebak, seperti di dalam bus atau di dalam lift. '
            ],
            [
                'id' => 15,
                "code" => "S015",
                'name' => 'Menghindari interaksi sosial karena takut akan diperhatikan, dipermalukan, atau memalukan orang lain '
            ],
            [
                'id' => 16,
                "code" => "S016",
                'name' => 'Khawatir atau cemas karena meyakini bahwa akan ada suatu hal buruk (bencana, penyakit, kematian) yang terjadi akan memisahkan dirinya dari sesosok yang akrab dengannya (orang tua, saudara, teman) '
            ],
            [
                'id' => 17,
                "code" => "S017",
                'name' => 'Panik, takut dan menghindari akan objek, benda, atau situasi tertentu (laba-laba, darah, ruang tertutup, ketinggian, kegelapan) '
            ],
        ];

        foreach ($items as $key => $item) {
            Symptom::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
