@extends('layouts.app')

@section('title', 'Edit Berita - Portal Berita Perusahaan')

@section('header')
    <h1 class="text-3xl font-bold text-gray-900">Edit Berita</h1>
    <p class="mt-2 text-gray-600">Perbarui informasi berita</p>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('news.show', $news->news_id) }}" class="inline-flex items-center text-blue-500 hover:text-blue-700">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            Kembali ke Berita
        </a>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="{{ route('news.update', $news->news_id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- News Tag -->
            <div>
                <label for="news_tag" class="block text-sm font-medium text-gray-700 mb-2">
                    Tag Berita <span class="text-red-500">*</span>
                </label>
                <input type="text" name="news_tag" id="news_tag" 
                       value="{{ old('news_tag', $news->news_tag) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('news_tag') border-red-500 @enderror"
                       placeholder="contoh: pengumuman-libur-2024"
                       required>
                <p class="mt-1 text-sm text-gray-500">Tag unik untuk mengidentifikasi berita (huruf kecil, tanpa spasi)</p>
                @error('news_tag')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Judul Berita <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" id="title" 
                       value="{{ old('title', $news->title) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                       placeholder="Masukkan judul berita yang menarik"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Body -->
            <div>
                <label for="body" class="block text-sm font-medium text-gray-700 mb-2">
                    Isi Berita <span class="text-red-500">*</span>
                </label>
                <textarea name="body" id="body" rows="12" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('body') border-red-500 @enderror"
                          placeholder="Tulis isi berita di sini..."
                          required>{{ old('body', $news->body) }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Gunakan paragraf yang jelas dan mudah dibaca</p>
                @error('body')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Author NIP (Read-only) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Penulis
                </label>
                <input type="text" value="{{ $news->author_nip }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50"
                       readonly>
                <p class="mt-1 text-sm text-gray-500">Penulis tidak dapat diubah</p>
            </div>

            <!-- Creation Info -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Informasi Berita</h4>
                <div class="text-sm text-gray-600 space-y-1">
                    <p>Dibuat: {{ $news->created_at->format('d F Y, H:i') }}</p>
                    @if($news->updated_at != $news->created_at)
                        <p>Terakhir diperbarui: {{ $news->updated_at->format('d F Y, H:i') }}</p>
                    @endif
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-500">
                    <span class="text-red-500">*</span> Field wajib diisi
                </div>
                
                <div class="flex space-x-3">
                    <a href="{{ route('news.show', $news->news_id) }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg">
                        Batal
                    </a>
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Edit History (if needed) -->
    <div class="mt-8 bg-yellow-50 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-yellow-900 mb-4">Catatan Pengeditan</h3>
        <ul class="space-y-2 text-sm text-yellow-800">
            <li class="flex items-start">
                <svg class="w-4 h-4 mr-2 mt-0.5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                Perubahan akan memperbarui waktu "last modified" berita
            </li>
            <li class="flex items-start">
                <svg class="w-4 h-4 mr-2 mt-0.5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                Jika mengubah tag berita, URL berita akan berubah
            </li>
            <li class="flex items-start">
                <svg class="w-4 h-4 mr-2 mt-0.5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                Pastikan semua informasi sudah benar sebelum menyimpan
            </li>
        </ul>
    </div>
</div>

@push('scripts')
<script>
// Character counter for body
const bodyTextarea = document.getElementById('body');
const maxLength = 5000;

function updateCharacterCounter() {
    const currentLength = bodyTextarea.value.length;
    const remaining = maxLength - currentLength;
    
    // Create or update character counter
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
}

// Initialize counter and add event listener
updateCharacterCounter();
bodyTextarea.addEventListener('input', updateCharacterCounter);

// Confirm before leaving if form has changes
let formChanged = false;
const form = document.querySelector('form');
const originalData = new FormData(form);

form.addEventListener('change', function() {
    formChanged = true;
});

window.addEventListener('beforeunload', function(e) {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// Don't show warning when submitting
form.addEventListener('submit', function() {
    formChanged = false;
});
</script>
@endpush
@endsection
