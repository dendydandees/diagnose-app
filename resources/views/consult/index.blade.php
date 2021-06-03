<?php
use Illuminate\Support\Facades\DB;

use App\Gejala;
use App\Penyakit;
session_start();
?>

<?php

if(isset($_GET['gejala'])){
// if($request->route('gejala') != ""){
    $gejala = $_GET['gejala'];
    // echo $gejala;
}else{
    $gejala = "S001";

    $rule = array();
    $rulex = array();
    foreach($penyakit as $ker){

        $a=$ker->id;
        $j=$ker->type;






        $rule2 = array();
        $or = DB::select("select * from rules,symptoms where symptoms.id=rules.id_symptom and rules.description='or' and rules.id_disease='$a'");

        $jumlah_or = count($or);
        foreach($or as $o){
            array_push($rule2, $o->code);
        }

        $rulex['or'] = $rule2;

        $rule3 = array();

        $or = DB::select("select * from rules,symptoms where symptoms.id=rules.id_symptom and rules.description='and' and rules.id_disease='$a'");

        $jumlah_or = count($or);
        foreach($or as $o){
            array_push($rule3, $o->code);
        }

        $rulex['and'] = $rule3;
        $rulex['jenis'] = $j;

        $rulex['alternatif'] = $a;
        array_push($rule, $rulex);
    }


    $_SESSION['rule'] = $rule;
}


$pp = App\Models\Symptom::where('code',$gejala)->first();


// $id_user = $request->route('id');


if(isset($_GET['urutan'])){
    $urutan = $_GET['urutan'];
}else{
    $urutan = 0;
}

if(isset($_GET['jenis'])){
    $jenis = $_GET['jenis'];
}else{
    $jenis = "panik_or";
}

if(isset($_GET['ya_panik'])){
    $ya_panik = $_GET['ya_panik'];
}else{
    $ya_panik = 0;
}

if(isset($_GET['ya_cemas'])){
    $ya_cemas = $_GET['ya_cemas'];
}else{
    $ya_cemas = 0;
}
?>

<x-without-sidenav>
  <x-slot name="header">
    <h2 class="font-bold text-2xl text-white leading-tight tracking-wider">
      {{ __('Anxiety Consultation') }}
    </h2>
  </x-slot>

  <section class="py-6 px-3 space-y-6 lg:px-6 md:w-10/12 lg:w-8/12 mx-auto">
    <a href="{{ route('dashboard') }}" class="link text-sm inline-flex flex-row items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span class="ml-2">
        {{ __('Back') }}
        </span>
    </a>

    <form action="{{ route('consult_proses') }}" method="get">
      <div class="bg-white shadow-md rounded-lg px-4 py-10">
        <div class="lg:w-8/12 text-center mx-auto space-y-12">
          <div class="space-y-8">
            <p class="md:w-3/4 mx-auto">
              Pikirkanlah selama 2 minggu terakhir, seberapa sering permasalahan berikut menggangu Anda ?
            </p>

            <input type="hidden" name="inisial" value="<?php echo $gejala ?>">
            <input type="hidden" name="urutan" value="<?php echo $urutan ?>">
            <input type="hidden" name="jenis" value="<?php echo $jenis ?>">
            <input type="hidden" name="ya_panik" value="<?php echo $ya_panik ?>">
            <input type="hidden" name="ya_cemas" value="<?php echo $ya_cemas ?>">

            <div class="space-y-6">
              <p class="text-xl font-bold">
                {{ $pp->name }}
              </p>
              <div class="space-x-4">
                <div class="inline-flex items-center">
                  <input id="no" name="jawaban" type="radio" value="0" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-700" required>
                  <label for="no" class="ml-2 block text-sm font-medium text-gray-700">
                    {{ __('No') }}
                  </label>
                </div>
                <div class="inline-flex items-center">
                  <input id="yes" name="jawaban" type="radio" value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-700" required>
                  <label for="yes" class="ml-2 block text-sm font-medium text-gray-700">
                    {{ __('Yes') }}
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="flex flex-row justify-center items-center">
            <input type="submit" class="btn-primary" value="{{ __('Next') }}">
          </div>
        </div>
      </div>
    </form>
  </section>
</x-without-sidenav>
