@extends('layouts.app')

@section('title', 'Profil Perusahaan - Portal Berita Perusahaan')

@section('header')
    <h1 class="text-3xl font-bold text-gray-900">Profil Perusahaan</h1>
    <p class="mt-2 text-gray-600">Informasi lengkap tentang perusahaan</p>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Company Overview -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-8 py-12 text-white text-center">
            <h1 class="text-4xl font-bold mb-4">{{ $profile->comp_name }}</h1>
            @if($profile->comp_description)
                <p class="text-xl text-blue-100">{{ $profile->comp_description }}</p>
            @endif
        </div>
        
        <div class="px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Vision -->
                @if($profile->vision)
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                            </svg>
                            Visi
                        </h2>
                        <div class="bg-blue-50 rounded-lg p-6">
                            <p class="text-gray-700 leading-relaxed">{{ $profile->vision }}</p>
                        </div>
                    </div>
                @endif
                
                <!-- Mission -->
                @if($profile->mission)
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
                            </svg>
                            Misi
                        </h2>
                        <div class="bg-green-50 rounded-lg p-6">
                            <p class="text-gray-700 leading-relaxed">{{ $profile->mission }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
            </svg>
            Informasi Kontak
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @if($profile->comp_email)
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-gray-400 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-900">Email</h3>
                        <p class="text-gray-600">
                            <a href="mailto:{{ $profile->comp_email }}" class="text-blue-600 hover:text-blue-500">
                                {{ $profile->comp_email }}
                            </a>
                        </p>
                    </div>
                </div>
            @endif

            @if($profile->comp_telephone)
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-gray-400 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-900">Telepon</h3>
                        <p class="text-gray-600">
                            <a href="tel:{{ $profile->comp_telephone }}" class="text-blue-600 hover:text-blue-500">
                                {{ $profile->comp_telephone }}
                            </a>
                        </p>
                    </div>
                </div>
            @endif

            @if($profile->comp_address)
                <div class="flex items-start space-x-3 md:col-span-2">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-gray-400 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-900">Alamat</h3>
                        <p class="text-gray-600">{{ $profile->comp_address }}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Edit Button for Admin -->
        @auth
            @if(auth()->user()->role === 'admin')
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('company.profile.edit') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                        Edit Profil Perusahaan
                    </a>
                </div>
            @endif
        @endauth
    </div>

    <!-- Back to Home -->
    <div class="mt-8 text-center">
        <a href="{{ route('home') }}" 
           class="inline-flex items-center text-blue-500 hover:text-blue-700 font-medium">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
