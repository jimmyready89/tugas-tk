@extends('layouts.app')

@section('title', 'Portal Berita Perusahaan')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-purple-700 text-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Portal Berita Perusahaan
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-100">
                Tetap terinformasi dengan berita dan pengumuman terbaru dari perusahaan
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('news.index') }}" 
                   class="bg-white text-blue-600 hover:bg-blue-50 font-bold py-3 px-8 rounded-lg text-lg transition duration-300">
                    Lihat Semua Berita
                </a>
                @auth
                    <a href="{{ route('news.create') }}" 
                       class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-300">
                        Tulis Berita
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>

<!-- Latest News Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Berita Terbaru</h2>
            <p class="text-lg text-gray-600">Informasi dan update terkini dari perusahaan</p>
        </div>

        @if($latestNews->count() > 0)
            <!-- Featured News (First News) -->
            @php $featuredNews = $latestNews->first(); @endphp
            <div class="mb-12">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="md:flex">
                        <div class="md:w-1/3">
                            <div class="h-64 bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center">
                                <div class="text-white text-center">
                                    <svg class="w-20 h-20 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-sm">{{ $featuredNews->news_tag }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="md:w-2/3 p-8">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold mr-4">
                                    FEATURED
                                </span>
                                <span>{{ $featuredNews->created_at->format('d F Y') }}</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $featuredNews->title }}</h3>
                            <p class="text-gray-600 mb-6">
                                {{ Str::limit(strip_tags($featuredNews->body), 200) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>{{ $featuredNews->author_nip }}</span>
                                </div>
                                <a href="{{ route('news.show', $featuredNews->news_id) }}" 
                                   class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Other Latest News -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($latestNews->skip(1) as $article)
                    <article class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <!-- News Image Placeholder -->
                        <div class="h-40 bg-gradient-to-r from-blue-400 to-purple-500 rounded-t-lg flex items-center justify-center">
                            <div class="text-white text-center">
                                <svg class="w-12 h-12 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-xs">{{ $article->news_tag }}</p>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <!-- News Meta -->
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                            </div>
                            
                            <!-- News Title -->
                            <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                                {{ $article->title }}
                            </h3>
                            
                            <!-- News Excerpt -->
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($article->body), 100) }}
                            </p>
                            
                            <!-- Read More Button -->
                            <a href="{{ route('news.show', $article->news_id) }}" 
                               class="inline-flex items-center text-blue-500 hover:text-blue-700 font-medium text-sm">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <!-- No News State -->
            <div class="text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 2v1h12V6H4zm0 3v5h12V9H4z" clip-rule="evenodd"></path>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada berita</h3>
                <p class="text-gray-500 mb-6">Portal berita masih kosong. Jadilah yang pertama menulis berita!</p>
                @auth
                    <a href="{{ route('news.create') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                        Tulis Berita Pertama
                    </a>
                @endauth
            </div>
        @endif

        <!-- View All News Button -->
        @if($latestNews->count() > 0)
            <div class="text-center mt-12">
                <a href="{{ route('news.index') }}" 
                   class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-300">
                    Lihat Semua Berita
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Company Profile Section -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Tentang Perusahaan</h2>
                @if($companyProfile)
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">{{ $companyProfile->comp_name }}</h3>
                    <p class="text-gray-600 mb-6">
                        {{ $companyProfile->comp_description ?? 'Deskripsi perusahaan akan ditampilkan di sini.' }}
                    </p>
                    <div class="space-y-4">
                        @if($companyProfile->vision)
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-2">Visi</h4>
                                <p class="text-gray-600">{{ $companyProfile->vision }}</p>
                            </div>
                        @endif
                        @if($companyProfile->mission)
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-2">Misi</h4>
                                <p class="text-gray-600">{{ $companyProfile->mission }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('company.profile.show') }}" 
                           class="text-blue-500 hover:text-blue-700 font-medium">
                            Selengkapnya →
                        </a>
                    </div>
                @else
                    <p class="text-gray-600 mb-6">
                        Informasi profil perusahaan akan ditampilkan di sini setelah dikonfigurasi.
                    </p>
                @endif
            </div>
            <div class="mt-8 lg:mt-0">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-8 text-white text-center">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-bold mb-2">Portal Terpercaya</h3>
                    <p class="text-blue-100">
                        Sumber informasi resmi dan terpercaya untuk semua karyawan perusahaan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
@endsection
