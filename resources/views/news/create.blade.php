@extends('layouts.app')

@section('title', 'Tulis Berita Baru - Portal Berita Perusahaan')

@section('header')
    <h1 class="text-3xl font-bold text-gray-900">Tulis Berita Baru</h1>
    <p class="mt-2 text-gray-600">Bagikan informasi dan update terbaru kepada seluruh karyawan</p>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('news.index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-700">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            Kembali ke Daftar Berita
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="{{ route('news.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="news_tag" class="block text-sm font-medium text-gray-700 mb-2">
                    Tag Berita <span class="text-red-500">*</span>
                </label>
                <input type="text" name="news_tag" id="news_tag" 
                       value="{{ old('news_tag') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('news_tag') border-red-500 @enderror"
                       placeholder="contoh: pengumuman-libur-2024"
                       required>
                <p class="mt-1 text-sm text-gray-500">Tag unik untuk mengidentifikasi berita (huruf kecil, tanpa spasi)</p>
                @error('news_tag')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Judul Berita <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" id="title" 
                       value="{{ old('title') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                       placeholder="Masukkan judul berita yang menarik"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="body" class="block text-sm font-medium text-gray-700 mb-2">
                    Isi Berita <span class="text-red-500">*</span>
                </label>
                <textarea name="body" id="body" rows="12" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('body') border-red-500 @enderror"
                          placeholder="Tulis isi berita di sini..."
                          required>{{ old('body') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Gunakan paragraf yang jelas dan mudah dibaca</p>
                @error('body')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <input type="hidden" name="author_nip" value="{{ auth()->user()->nip }}">

            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-500">
                    <span class="text-red-500">*</span> Field wajib diisi
                </div>
                
                <div class="flex space-x-3">
                    <a href="{{ route('news.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg">
                        Batal
                    </a>
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg">
                        Publikasikan Berita
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-8 bg-blue-50 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-blue-900 mb-4">Tips Menulis Berita yang Baik</h3>
        <ul class="space-y-2 text-sm text-blue-800">
            <li class="flex items-start">
                <svg class="w-4 h-4 mr-2 mt-0.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Gunakan judul yang jelas dan menarik perhatian
            </li>
            <li class="flex items-start">
                <svg class="w-4 h-4 mr-2 mt-0.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Mulai dengan informasi paling penting di paragraf pertama
            </li>
            <li class="flex items-start">
                <svg class="w-4 h-4 mr-2 mt-0.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Gunakan bahasa yang mudah dipahami oleh semua karyawan
            </li>
            <li class="flex items-start">
                <svg class="w-4 h-4 mr-2 mt-0.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Sertakan detail penting seperti tanggal, waktu, dan lokasi jika relevan
            </li>
            <li class="flex items-start">
                <svg class="w-4 h-4 mr-2 mt-0.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Periksa kembali ejaan dan tata bahasa sebelum mempublikasikan
            </li>
        </ul>
    </div>
</div>

@push('scripts')
    <script>
        document.getElementById('title').addEventListener('input', () => {
            const title = this.value;
            const newsTag = title
                .toLowerCase()
                .replace(/[^a-z0-9\s]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
            
            document.getElementById('news_tag').value = newsTag;
        });

        const bodyTextarea = document.getElementById('body');
        const maxLength = 5000;

        bodyTextarea.addEventListener('input', () => {
            const currentLength = this.value.length;
            const remaining = maxLength - currentLength;
            

            let counter = document.getElementById('body-counter');
            if (!counter) {
                counter = document.createElement('p');
                counter.id = 'body-counter';
                counter.className = 'mt-1 text-sm text-gray-500';
                bodyTextarea.parentNode.appendChild(counter);
            }
            
            counter.textContent = `${currentLength} karakter`;
            
            if (remaining < 100) {
                counter.className = 'mt-1 text-sm text-red-500';
            } else {
                counter.className = 'mt-1 text-sm text-gray-500';
            }
        });
    </script>
@endpush
@endsection
