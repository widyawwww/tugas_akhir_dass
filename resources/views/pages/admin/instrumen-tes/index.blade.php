@extends('pages.admin.index')

@section('content')
<main class="p-4 sm:ml-64 mt-14">
    {{-- Header dan Tombol Tambah --}}
    <div class="p-4 bg-white rounded-lg shadow-lg flex justify-between items-center">
        <p class="text-lg font-semibold">Daftar Instrumen Tes Psikologi</p>
        <button data-modal-target="modalTambahInstrumen" data-modal-toggle="modalTambahInstrumen"
            class="bg-blue-500 rounded-lg px-2 py-1 text-white flex items-center gap-1 hover:bg-blue-600">
            <i class="fa-solid fa-plus"></i> Tambah Instrumen
        </button>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="mt-4 p-4 bg-green-100 border border-green-300 rounded text-green-800">
            {{ session('success') }}
        </div>
    @endif

    {{-- Card Instrumen --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
        @forelse ($instrumenList as $instrumen)
            <div class="bg-white shadow-md rounded-lg p-4 flex flex-col justify-between">
                <img src="{{ $instrumen->gambar ? asset('storage/' . $instrumen->gambar) : 'https://via.placeholder.com/300x200.png?text=Instrumen' }}"
                    class="w-full h-32 object-cover rounded mb-3" alt="gambar">
                <div>
                    <h3 class="text-lg font-semibold mb-2">{{ $instrumen->nama }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $instrumen->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                    <p class="text-gray-600 text-sm mb-3">Tahun: {{ $instrumen->tahun }}</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.instrumen-tes.pertanyaan', $instrumen->id) }}"
                        class="bg-blue-500 py-1 px-2 rounded-lg text-white text-sm flex items-center gap-1 hover:bg-blue-600">
                        <i class="fa-solid fa-file-lines"></i> Soal
                    </a>
                    <a href="{{ route('admin.instrumen-tes.opsi', $instrumen->id) }}"
                        class="bg-green-500 py-1 px-2 rounded-lg text-white text-sm flex items-center gap-1 hover:bg-green-600">
                        <i class="fa-solid fa-check-square"></i> Opsi
                    </a>
                    <a href="{{ route('admin.instrumen-tes.subskala', $instrumen->id) }}"
                        class="bg-orange-500 py-1 px-2 rounded-lg text-white text-sm flex items-center gap-1 hover:bg-orange-600">
                        <i class="fa-solid fa-layer-group"></i> Subskala
                    </a>
                    <form action="{{ route('admin.instrumen-tes.destroy', $instrumen->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus instrumen ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 py-1 px-2 rounded-lg text-white text-sm flex items-center gap-1 hover:bg-red-600">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-500">Belum ada instrumen ditambahkan.</div>
        @endforelse
    </div>

    {{-- Modal Tambah Instrumen --}}
    <div id="modalTambahInstrumen" tabindex="-1"
        class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-y-auto h-full bg-black bg-opacity-50">
        <div class="relative w-full max-w-md bg-white rounded-lg shadow">
            <form action="{{ route('admin.instrumen-tes.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
                @csrf
                <h3 class="text-lg font-semibold mb-4">Tambah Instrumen</h3>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Nama Instrumen</label>
                    <input type="text" name="nama" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Pembuat</label>
                    <input type="text" name="pembuat" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Tahun</label>
                    <input type="number" name="tahun" min="1900" max="2100" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Deskripsi</label>
                    <textarea name="deskripsi" class="w-full border p-2 rounded" rows="4"></textarea>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Gambar</label>
                    <input type="file" name="gambar" class="w-full border p-2 rounded" accept="image/*">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded"
                        data-modal-hide="modalTambahInstrumen">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
