@extends('pages.admin.index')

@section('content')
{{-- Tambah Trix CSS --}}
<link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">

<main class="p-4 sm:ml-64 mt-14">
    <div class="space-y-4">
        <div class="p-4 bg-white rounded-lg shadow-lg flex justify-between items-center">
            <h2 class="text-lg font-semibold">Deskripsi Lengkap Artikel</h2>
            <button data-modal-target="modalEditDeskripsi" data-modal-toggle="modalEditDeskripsi"
                class="bg-yellow-500 rounded-lg px-3 py-1 text-white">
                <i class="fa-solid fa-pen-to-square"></i> Edit Deskripsi
            </button>
        </div>

        <div class="p-4 bg-white rounded-lg shadow">
            <div class="text-gray-800 leading-relaxed">
                {!! $artikel->deskripsi ?? '<p><i>Deskripsi belum tersedia.</i></p>' !!}
            </div>
        </div>
    </div>

    {{-- Modal Edit Deskripsi --}}
    <div id="modalEditDeskripsi" tabindex="-1"
        class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-y-auto h-full bg-black bg-opacity-50">
        <div class="relative w-full max-w-2xl bg-white rounded-lg shadow">
            <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-2 text-sm font-medium">Deskripsi Artikel</label>
                    {{-- Input Hidden + Trix --}}
                    <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi', $artikel->deskripsi) }}">
                    <trix-editor input="deskripsi" class="trix-content bg-white border border-gray-300 rounded"></trix-editor>
                </div>

                {{-- Hidden input agar validasi tidak error --}}
                <input type="hidden" name="nama" value="{{ $artikel->nama }}">
                <input type="hidden" name="deskripsi_singkat" value="{{ $artikel->deskripsi_singkat }}">

                <div class="flex justify-end gap-2">
                    <button type="button" data-modal-hide="modalEditDeskripsi"
                        class="bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>

{{-- Tambah Trix JS --}}
<script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
@endsection
