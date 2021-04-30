<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
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
                'code' => 'D001',
                'name' => 'Bukan Gangguan Kecemasan',
                'description' => '<h2><strong>Bukan Gangguan Kecemasan</strong></h2>'
            ],
            [
                'id' => 2,
                'code' => 'D002',
                'name' => 'Serangan panik',
                'description' => '<h2><strong>Serangan Panik</strong></h2>'
            ],
            [
                'id' => 3,
                'code' => 'D003',
                'name' => 'Gangguan panik',
                'description' => '<h2><strong>Gangguan Panik</strong></h2>'
            ],
            [
                'id' => 4,
                'code' => 'D004',
                'name' => 'Agoraphobia dengan gangguan panik',
                'description' => '<h2><strong>Agoraphobia dengan gangguan panik</strong></h2>'
            ],
            [
                'id' => 5,
                'code' => 'D005',
                'name' => 'Agoraphobia tanpa gangguan panik',
                'description' => '<h2><strong>Agoraphobia tanpa gangguan panik</strong></h2>'
            ],
            [
                'id' => 6,
                'code' => 'D006',
                'name' => 'Gangguan kecemasan umum',
                'description' => '<h2><strong>Gangguan kecemasan umum</strong></h2>'
            ],
            [
                'id' => 7,
                'code' => 'D007',
                'name' => 'Gangguan kecemasan sosial',
                'description' => '<h2><strong>Gangguan kecemasan sosial</strong></h2>'
            ],
            [
                'id' => 8,
                'code' => 'D008',
                'name' => 'Separation anxiety disorder',
                'description' => '<h2><strong>Separation anxiety disorder</strong></h2>'
            ],
            [
                'id' => 9,
                'code' => 'D009',
                'name' => 'Specific phobia',
                'description' => '<h2><strong>Specific phobia</strong></h2>'
            ],
        ];

        foreach ($items as $key => $item) {
            Disease::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
