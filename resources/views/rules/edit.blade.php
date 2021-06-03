<x-app-layout>
  <x-slot name="header">
    <h2 class="font-bold text-2xl text-white leading-tight tracking-wider">
      {{ __('Edit Rule') }}
    </h2>
  </x-slot>

  <section class="py-6 px-3 space-y-6 lg:px-6">
    <div class="flex flex-row">
        <a href="{{ url()->previous() }}" class="link text-sm flex flex-row items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="ml-2">
            {{ __('Back') }}
            </span>
        </a>
    </div>

    <form action="{{ route('rules.update', ['rule' => $disease->id]) }}" method="post" class="form-inline">
        @csrf
        {{ method_field('PUT') }}
        <div class="table-responsive">
          <!-- This example requires Tailwind CSS v2.0+ -->
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" colspan="2">
                          {{ __('Alternative') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          OR/AND
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      @foreach($symptoms as $g)
                      <tr>
                        <td class="px-6 py-4 text-sm w-4/12">
                          <p>{{ $g->code }}</p>
                          <small>{{ $g->name }}</small>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                          <?php
                            $xx = DB::table("rules")->where("id_disease",$disease->id)->where("id_symptom",$g->id)->first();
                          ?>
                            <input type="hidden" name="alternatif" value="<?php echo $disease->id; ?>">
                            <input type="hidden" name="gejala[]" value="<?php echo $g->id; ?>">

                          <?php
                            if(isset($xx) > 0){
                              ?>
                              <select name="nilai[]" class="form-select mt-2 block w-6/12 rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75 capitalize" style="width: 300px" required="required">
                                <option <?php if($xx->value=="0"){echo "selected='selected'";} ?> value="0">Tidak</option>
                                <option <?php if($xx->value=="1"){echo "selected='selected'";} ?> value="1">Ya</option>
                              </select>
                              <?php
                            }else{
                              ?>
                              <select name="nilai[]" class="form-select mt-2 block w-6/12 rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75 capitalize" style="width: 300px" required="required">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                              </select>
                              <?php
                            }
                          ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                          <?php
                            if(isset($xx) > 0){
                              ?>
                              <select class="form-select mt-2 block rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75 capitalize" name="keterangan[]">
                                <option value="">- Pilih -</option>
                                <option <?php if($xx->description=="or"){echo "selected='selected'";} ?> value="or">OR</option>
                                <option <?php if($xx->description=="and"){echo "selected='selected'";} ?> value="and">AND</option>
                              </select>
                              <?php
                            }else{
                              ?>
                              <select class="form-select mt-2 block rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75 capitalize" name="keterangan[]">
                                <option value="">- Pilih -</option>
                                <option value="or">OR</option>
                                <option value="and">AND</option>
                              </select>
                              <?php
                            }
                          ?>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="flex justify-end">
          <input type="submit" name="submit" value="{{ __('Save') }}" class="btn-primary mt-6">
        </div>
    </form>
  </section>
</x-app-layout>
