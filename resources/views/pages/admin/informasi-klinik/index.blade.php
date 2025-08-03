@extends('layouts.admin')

@section('content')
<main>
    <div class="p-4 sm:ml-64">
        <div class="mt-14 space-y-6">
            <div class="p-4 bg-white rounded-lg shadow-lg">
                <p class="text-xl font-semibold mb-4">Informasi Klinik</p>

                @if (session('success'))
                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ $informasi ? route('admin.informasi.update', $informasi->id) : route('admin.informasi.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if($informasi)
                        @method('PUT')
                    @endif

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Klinik</label>
                        <input type="text" name="nama" value="{{ old('nama', $informasi->nama ?? '') }}" class="w-full border rounded p-2">
                        @error('nama')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $informasi->email ?? '') }}" class="w-full border rounded p-2">
                        @error('email')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Telepon --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $informasi->telepon ?? '') }}" class="w-full border rounded p-2">
                        @error('telepon')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">Alamat</label>
                        <textarea name="alamat" class="w-full border rounded p-2">{{ old('alamat', $informasi->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tentang --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">Tentang Klinik</label>
                        <textarea name="tentang" class="w-full border rounded p-2">{{ old('tentang', $informasi->tentang ?? '') }}</textarea>
                        @error('tentang')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Visi --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">Visi</label>
                        <textarea name="visi" class="w-full border rounded p-2">{{ old('visi', $informasi->visi ?? '') }}</textarea>
                        @error('visi')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Misi --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">Misi</label>
                        <textarea name="misi" class="w-full border rounded p-2">{{ old('misi', $informasi->misi ?? '') }}</textarea>
                        @error('misi')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Instagram --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">Instagram</label>
                        <input type="text" name="instagram" value="{{ old('instagram', $informasi->instagram ?? '') }}" class="w-full border rounded p-2">
                        @error('instagram')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- TikTok --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">TikTok</label>
                        <input type="text" name="tiktok" value="{{ old('tiktok', $informasi->tiktok ?? '') }}" class="w-full border rounded p-2">
                        @error('tiktok')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Upload Gambar --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">Gambar (opsional)</label>
                        <input type="file" name="gambar" class="w-full">
                        @error('gambar')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                        @if($informasi && $informasi->gambar_url)
                            <img src="{{ $informasi->gambar_url }}" alt="Gambar Klinik" class="mt-2 w-40 rounded">
                        @else
                            <p class="text-gray-500 text-sm mt-2">Tidak ada gambar tersedia</p>
                        @endif
                    </div>

                    {{-- Upload Logo --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">Logo (opsional)</label>
                        <input type="file" name="logo" class="w-full">
                        @error('logo')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                        @if($informasi && $informasi->logo_url)
                            <img src="{{ $informasi->logo_url }}" alt="Logo Klinik" class="mt-2 w-40 rounded">
                        @else
                            <p class="text-gray-500 text-sm mt-2">Tidak ada logo tersedia</p>
                        @endif
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        {{ $informasi ? 'Perbarui Informasi' : 'Simpan Informasi' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection