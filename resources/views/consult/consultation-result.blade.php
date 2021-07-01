<x-without-sidenav>
  <x-slot name="header">
    <h2 class="font-bold text-2xl text-white leading-tight tracking-wider">
      {{ __('Consultation Result') }}
    </h2>
  </x-slot>

  <div class="py-6 px-3 space-y-6 lg:px-6">
    <a href="{{ route('dashboard') }}" class="link text-sm inline-flex flex-row items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span class="ml-2">
        {{ __('Back') }}
        </span>
    </a>

    <section class="flex space-x-6">
      <div class="w-6/12 bg-white shadow-md rounded-lg px-4 py-6 space-y-8">
        <div class="space-y-2 font-bold">
          <p>{{ $user->name }}</p>
          <p>{{ $user->userProfile->age }} {{ __("Years old") }}</p>
          <p>{{ $user->userProfile->gender == 'male' ? 'Laki - Laki' : 'Perempuan' }}</p>
        </div>

        @if ($user_history->result != "0" && $user_history->result !== "")
          @php
              $disease = App\Models\Disease::where('id',$user_history->result)->first();
          @endphp

          <div class="space-y-6">
            <p>
              Dari hasil konsultasi berdasarkan dari gejala yang Anda alami, kecemasan Anda sama dengan gejala <b>{{ $disease->name }}</b> sehingga diperlukan konsultasi lebih lanjut kepada psikiater atau psikolog.
            </p>
            <p>
              Untuk informasi lebih lanjut Anda dapat menghubungi <b>Direktorat Pencegahan dan Pengendalian Masalah Kesehatan Mental dan Obat</b> di <b>119</b> atau <b>Personal Growth</b> di <b>+62 821 5890 3862</b>.
            </p>
          </div>

          <div class="space-y-4">
            <p class="font-bold">Riwayat Gejala</p>
            <ul>
                @foreach ($user_input as $key => $item)
                <li class="{{ $item['value'] == '0' ? 'line-through' : 'font-bold' }}">
                  <b>{{ $loop->iteration }}.</b> {{ $item['name'] }} - {{ $item['value'] == '0' ? 'Tidak' : 'Ya' }}
                </li>
                @endforeach
              </ul>
          </div>
        @else
        <div class="space-y-6">
          <p>
            Tidak ditemukannya indikasi mengenai gangguan kecemasan, sehingga tidak diperlukannya konsultasi lebih lanjut kepada psikiater atau psikolog. Jika Anda ingin mengetahui lebih lanjut seputar informasi gangguan kecemasan atau informasi kesehatan mental, Anda dapat membaca beberapa artikel <a href="{{ route('articles.list') }}" class="link font-bold">di sini</a>
          </p>

          <p>
            Untuk informasi lebih lanjut Anda dapat menghubungi <b>Direktorat Pencegahan dan Pengendalian Masalah Kesehatan Mental dan Obat</b> di <b>119</b> atau <b>Personal Growth</b> di <b>+62 821 5890 3862</b>.
          </p>
        </div>

        <div class="space-y-4">
          <p class="font-bold">Riwayat Gejala</p>
          <ul>
          @foreach ($user_input as $key => $item)
            <li class="{{ $item['value'] == '0' ? 'line-through' : 'font-bold' }}">
              <b>{{ $loop->iteration }}.</b> {{ $item['name'] }} - {{ $item['value'] == '0' ? 'Tidak' : 'Ya' }}
            </li>
          @endforeach
          </ul>
        </div>
        @endif
      </div>

      @if ($user_history->result != "0" && $user_history->result !== "")
        @php
            $disease = App\Models\Disease::where('id',$user_history->result)->first();
        @endphp
        <div class="w-6/12 bg-white shadow-md rounded-lg px-4 py-6 space-y-6">
          <h3 class="text-xl font-bold">
            {{ $disease->name }}
          </h3>
          <div>
            {!! $disease->description !!}
          </div>
        </div>
      @endif
    </section>
  </div>

</x-without-sidenav>
