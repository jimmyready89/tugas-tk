@extends('layouts.app')

@section('title', 'Daftar Berita - Portal Berita Perusahaan')

@section('header')
    <h1 class="text-3xl font-bold text-gray-900">Berita Terkini</h1>
    <p class="mt-2 text-gray-600">Informasi dan update terbaru dari perusahaan</p>
@endsection

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" placeholder="Cari berita..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="flex gap-2">
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kategori</option>
                    <option value="pengumuman">Pengumuman</option>
                    <option value="berita">Berita</option>
                    <option value="acara">Acara</option>
                </select>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
                    Cari
                </button>
            </div>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($news as $article)
            <article class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="h-48 bg-gradient-to-r from-blue-400 to-purple-500 rounded-t-lg flex items-center justify-center">
                    <div class="text-white text-center">
                        <svg class="w-16 h-16 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-sm">{{ $article->news_tag }}</p>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="mr-4">{{ $article->author_nip }}</span>
                        
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ $article->created_at->format('d M Y') }}</span>
                    </div>
                    
                    <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                        {{ $article->title }}
                    </h2>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                        {{ Str::limit(strip_tags($article->body), 150) }}
                    </p>
                    
                    <div class="flex justify-between items-center">
                        <a href="{{ route('news.show', $article->news_id) }}" 
                           class="inline-flex items-center text-blue-500 hover:text-blue-700 font-medium text-sm">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        
                        @auth
                            @if(auth()->user()->nip === $article->author_nip || auth()->user()->role === 'admin')
                                <div class="flex space-x-2">
                                    <a href="{{ route('news.edit', $article->news_id) }}" 
                                       class="text-gray-400 hover:text-yellow-500">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                    <button onclick="deleteNews('{{ $article->news_id }}')" 
                                            class="text-gray-400 hover:text-red-500">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9zM4 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 012 0v3a1 1 0 11-2 0V9zm4 0a1 1 0 012 0v3a1 1 0 11-2 0V9z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full">
                <div class="text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 2v1h12V6H4zm0 3v5h12V9H4z" clip-rule="evenodd"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada berita</h3>
                    <p class="text-gray-500 mb-6">Belum ada berita yang dipublikasikan.</p>
                    @auth
                        <a href="{{ route('news.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                            Tulis Berita Pertama
                        </a>
                    @endauth
                </div>
            </div>
        @endforelse
    </div>

    @if(isset($news) && method_exists($news, 'links'))
        <div class="flex justify-center">
            {{ $news->links() }}
        </div>
    @endif
</div>

@push('scripts')
    <script>
        const deleteNews = (newsId) => {
            if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/news/${newsId}`;
                
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                
                const tokenField = document.createElement('input');
                tokenField.type = 'hidden';
                tokenField.name = '_token';
                tokenField.value = document.querySelector('meta[name="csrf-token"]').content;
                
                form.appendChild(methodField);
                form.appendChild(tokenField);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endpush
@endsection
