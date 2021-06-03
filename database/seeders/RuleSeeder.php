<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    private $disease = 0;
    private $symptoms = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17');
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->rule1();
        $this->rule2();
        $this->rule3();
        $this->rule4();
        $this->rule5();
        $this->rule6();
        $this->rule7();
        $this->rule8();
    }

    public function rule1() {
        $this->disease += 1;
        $keterangan = array('or', 'or', 'or', 'or', 'or', 'or', null, null, null, null, null, null, null, null, null, null, null);
        $nilai = array('1', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

        for ($a = 0; $a < count($this->symptoms); $a++) {
            Rule::Create([
                'id_disease' => $this->disease,
                'id_symptom' => $this->symptoms[$a],
                'description' => $keterangan[$a],
                'value' => $nilai[$a]
            ]);
        }
    }

    public function rule2() {
        $this->disease += 1;
        $keterangan = array('or', 'or', 'or', 'or', 'or', 'or', null, null, null, null, null, 'and', null, null, null, null, null);
        $nilai = array('1', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0');

        for ($a = 0; $a < count($this->symptoms); $a++) {
            Rule::Create([
                'id_disease' => $this->disease,
                'id_symptom' => $this->symptoms[$a],
                'description' => $keterangan[$a],
                'value' => $nilai[$a]
            ]);
        }
    }

    public function rule3() {
        $this->disease += 1;
        $keterangan = array('or', 'or', 'or', 'or', 'or', 'or', null, null, null, null, null, 'and', 'and', 'and', null, null, null);
        $nilai = array('1', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '1', '1', '1', '0', '0', '0');

        for ($a = 0; $a < count($this->symptoms); $a++) {
            Rule::Create([
                'id_disease' => $this->disease,
                'id_symptom' => $this->symptoms[$a],
                'description' => $keterangan[$a],
                'value' => $nilai[$a]
            ]);
        }
    }

    public function rule4() {
        $this->disease += 1;
        $keterangan = array('or', 'or', 'or', 'or', 'or', 'or', null, null, null, null, null, null, 'and', 'and', null, null, null);
        $nilai = array('1', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '0', '0', '0');

        for ($a = 0; $a < count($this->symptoms); $a++) {
            Rule::Create([
                'id_disease' => $this->disease,
                'id_symptom' => $this->symptoms[$a],
                'description' => $keterangan[$a],
                'value' => $nilai[$a]
            ]);
        }
    }

    public function rule5() {
        $this->disease += 1;
        $keterangan = array(null, null, null, null, null, null, 'or', 'or', 'or', 'or', 'or', null, null, null, null, null, null);
        $nilai = array('0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0');

        for ($a = 0; $a < count($this->symptoms); $a++) {
            Rule::Create([
                'id_disease' => $this->disease,
                'id_symptom' => $this->symptoms[$a],
                'description' => $keterangan[$a],
                'value' => $nilai[$a]
            ]);
        }
    }

    public function rule6() {
        $this->disease += 1;
        $keterangan = array(null, null, null, null, null, null, 'or', 'or', 'or', 'or', 'or', null, 'and', null, 'and', null, null);
        $nilai = array('0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0');

        for ($a = 0; $a < count($this->symptoms); $a++) {
            Rule::Create([
                'id_disease' => $this->disease,
                'id_symptom' => $this->symptoms[$a],
                'description' => $keterangan[$a],
                'value' => $nilai[$a]
            ]);
        }
    }

    public function rule7() {
        $this->disease += 1;
        $keterangan = array(null, null, null, null, null, null, 'or', 'or', 'or', 'or', 'or', null, null, null, null, 'and', null);
        $nilai = array('0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '0', '0', '0', '0', '1', '0');

        for ($a = 0; $a < count($this->symptoms); $a++) {
            Rule::Create([
                'id_disease' => $this->disease,
                'id_symptom' => $this->symptoms[$a],
                'description' => $keterangan[$a],
                'value' => $nilai[$a]
            ]);
        }
    }

    public function rule8() {
        $this->disease += 1;
        $keterangan = array(null, null, null, null, null, null, 'or', 'or', 'or', 'or', 'or', null, null, null, null, null, 'and');
        $nilai = array('0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '1');

        for ($a = 0; $a < count($this->symptoms); $a++) {
            Rule::Create([
                'id_disease' => $this->disease,
                'id_symptom' => $this->symptoms[$a],
                'description' => $keterangan[$a],
                'value' => $nilai[$a]
            ]);
        }
    }
}
