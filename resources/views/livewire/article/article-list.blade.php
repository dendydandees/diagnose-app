<section class="space-y-6">
    @hasanyrole('admin|expert')
        <div class="flex flex-row">
            <a href="{{ route('articles.index') }}" class="link text-sm flex flex-row items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="ml-2">
                {{ __('Back') }}
                </span>
            </a>
        </div>
    @endhasanyrole

    <div class="bg-white shadow-md p-4 rounded-lg">
        <div class="grid gap-y-16">
            <a href="#" class="group grid grid-cols-2 gap-x-6 rounded-md hover:bg-purple-100 transform hover:scale-105 hover:shadow-sm transition-all items-center">
                <img src="https://picsum.photos/400/500" alt="" class="w-full h-56 rounded-md object-cover" style="filter: contrast(0.7)">
                <div>
                    <h5 class="group-hover:text-purple-700 text-xl font-bold leading-normal tracking-wide line-clamp-2">
                        Inilah Hubungan Kesehatan Mental Orang Tua Terhadap Anak
                    </h5>
                    <p class="mt-4 text-base line-clamp-5">Halodoc, Jakarta - Mengasuh anak memang bukanlah hal yang mudah. Banyak yang harus diperhatikan orangtua agar anak mampu menjalani proses tumbuh kembang sesuai dengan usianya. Dalam mengasuh anak, bukan saja kesehatan mental anak yang harus diperhatikan lebih dulu. Namun, hal yang cukup penting adalah menjaga kesehatan mental orangtua tetap sehat dan optimal.</p>
                </div>
            </a>

            <div class="grid grid-cols-4 gap-x-4 gap-y-6">
                @for ($i = 0; $i < 5; $i++)
                    <a href="#" class="group rounded-md hover:bg-purple-100 transform hover:scale-105 hover:shadow-sm transition-all">
                        <img src="https://picsum.photos/200/300" alt="" class="w-full h-40 rounded-md object-cover">
                        <div class="p-2">
                            <h5 class="group-hover:text-purple-700 text-lg font-bold leading-normal tracking-wide line-clamp-2">
                                Inilah Hubungan Kesehatan Mental Orang Tua Terhadap Anak
                            </h5>
                            <p class="mt-4 text-base line-clamp-3">Halodoc, Jakarta - Mengasuh anak memang bukanlah hal yang mudah. Banyak yang harus diperhatikan orangtua agar anak mampu menjalani proses tumbuh kembang sesuai dengan usianya. Dalam mengasuh anak, bukan saja kesehatan mental anak yang harus diperhatikan lebih dulu. Namun, hal yang cukup penting adalah menjaga kesehatan mental orangtua tetap sehat dan optimal.</p>
                        </div>
                    </a>
                @endfor
            </div>
        </div>
    </div>
</section>
