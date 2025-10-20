@extends('layouts.app')

@section('title', 'Edit Profil Perusahaan - Portal Berita Perusahaan')

@section('header')
    <h1 class="text-3xl font-bold text-gray-900">Edit Profil Perusahaan</h1>
    <p class="mt-2 text-gray-600">Ubah informasi profil perusahaan</p>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-8 py-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Informasi Perusahaan</h2>
        </div>

        <form action="{{ route('company.profile.update') }}" method="POST" class="px-8 py-6">
            @csrf
            @method('PUT')

            <!-- Company Name -->
            <div class="mb-6">
                <label for="comp_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Perusahaan *
                </label>
                <input type="text" 
                       id="comp_name" 
                       name="comp_name" 
                       value="{{ old('comp_name', $profile->comp_name) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('comp_name') border-red-500 @enderror"
                       required>
                @error('comp_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Company Description -->
            <div class="mb-6">
                <label for="comp_description" class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi Perusahaan
                </label>
                <textarea id="comp_description" 
                          name="comp_description" 
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('comp_description') border-red-500 @enderror"
                          placeholder="Deskripsi singkat tentang perusahaan">{{ old('comp_description', $profile->comp_description) }}</textarea>
                @error('comp_description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Vision -->
            <div class="mb-6">
                <label for="vision" class="block text-sm font-medium text-gray-700 mb-2">
                    Visi Perusahaan
                </label>
                <textarea id="vision" 
                          name="vision" 
                          rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('vision') border-red-500 @enderror"
                          placeholder="Visi perusahaan untuk masa depan">{{ old('vision', $profile->vision) }}</textarea>
                @error('vision')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mission -->
            <div class="mb-6">
                <label for="mission" class="block text-sm font-medium text-gray-700 mb-2">
                    Misi Perusahaan
                </label>
                <textarea id="mission" 
                          name="mission" 
                          rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('mission') border-red-500 @enderror"
                          placeholder="Misi dan tujuan perusahaan">{{ old('mission', $profile->mission) }}</textarea>
                @error('mission')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contact Information Section -->
            <div class="border-t border-gray-200 pt-6 mt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Kontak</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Email -->
                    <div>
                        <label for="comp_email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Perusahaan
                        </label>
                        <input type="email" 
                               id="comp_email" 
                               name="comp_email" 
                               value="{{ old('comp_email', $profile->comp_email) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('comp_email') border-red-500 @enderror"
                               placeholder="email@perusahaan.com">
                        @error('comp_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Telephone -->
                    <div>
                        <label for="comp_telephone" class="block text-sm font-medium text-gray-700 mb-2">
                            Telepon Perusahaan
                        </label>
                        <input type="tel" 
                               id="comp_telephone" 
                               name="comp_telephone" 
                               value="{{ old('comp_telephone', $profile->comp_telephone) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('comp_telephone') border-red-500 @enderror"
                               placeholder="+62 21 1234 5678">
                        @error('comp_telephone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="mt-6">
                    <label for="comp_address" class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat Perusahaan
                    </label>
                    <textarea id="comp_address" 
                              name="comp_address" 
                              rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('comp_address') border-red-500 @enderror"
                              placeholder="Alamat lengkap perusahaan">{{ old('comp_address', $profile->comp_address) }}</textarea>
                    @error('comp_address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-8">
                <a href="{{ route('company.profile.show') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                    Batal
                </a>

                <div class="space-x-3">
                    <button type="button" 
                            onclick="confirmReset()"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                        Reset
                    </button>
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Reset Confirmation -->
<script>
function confirmReset() {
    if (confirm('Apakah Anda yakin ingin mereset semua perubahan?')) {
        location.reload();
    }
}
</script>
@endsection
