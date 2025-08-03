@extends('pages.admin.index')

@section('content')
    <main class="p-4 sm:ml-64 mt-14">
        <div class="p-4 bg-white rounded-lg shadow-lg flex justify-between items-center">
            <h2 class="text-lg font-semibold">Daftar Jenis Tips Kesehatan Mental</h2>
            <button data-modal-target="modalTambahJenis" data-modal-toggle="modalTambahJenis"
                class="bg-blue-500 text-white px-3 py-1 rounded-lg">
                <i class="fa-solid fa-plus"></i> Tambah Jenis Tips
            </button>
        </div>

        <br>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse ($tips as $tips)
                <div class="bg-white shadow-md rounded-lg p-4 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">{{ $tips->nama }}</h3>
                        <p class="text-gray-600 text-sm mb-3">{{ $tips->deskripsi_singkat ?? 'Tidak ada deskripsi' }}</p>
                        @if ($tips->gambar_url)
                            <img src="{{ $tips->gambar_url }}" alt="{{ $tips->nama }}"
                                class="w-full h-32 object-cover rounded mb-3">
                        @else
                            <p class="text-gray-400 italic">Tidak ada gambar</p>
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.tips.show', $tips->id) }}?jenis={{ strtolower($tips->nama) }}"
                            class="bg-blue-500 py-1 px-2 rounded-lg text-white text-sm">
                            Lihat <i class="fa-solid fa-up-right-from-square ms-1"></i>
                        </a>
                        <button type="button" class="bg-yellow-500 py-1 px-2 rounded-lg text-white text-sm"
                            data-modal-target="edit-jenis-{{ $tips->id }}"
                            data-modal-toggle="edit-jenis-{{ $tips->id }}">
                            Edit <i class="fa-solid fa-pen-to-square ms-1"></i>
                        </button>
                        <form action="{{ route('admin.tips.destroy', $tips->id) }}" method="POST" class="form-hapus">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-500 py-1 px-2 rounded-lg text-white text-sm">
                                Hapus <i class="fa-solid fa-trash-can ms-1"></i>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Modal Edit --}}
                <div id="edit-jenis-{{ $tips->id }}" tabindex="-1"
                    class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50">
                    <div class="relative p-4 w-full max-w-md mx-auto mt-20">
                        <div class="bg-white rounded-lg shadow p-4">
                            <form action="{{ route('admin.tips.update', $tips->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <h3 class="text-lg font-semibold mb-2">Edit Jenis Tips</h3>
                                <div class="mb-3">
                                    <label class="block mb-1 text-sm font-medium">Nama</label>
                                    <input type="text" name="nama" value="{{ $tips->nama }}"
                                        class="w-full border p-2 rounded" required>
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1 text-sm font-medium">Deskripsi</label>
                                    <textarea name="deskripsi" class="w-full border p-2 rounded" rows="4">{{ $tips->deskripsi_singkat }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1 text-sm font-medium">Gambar</label>
                                    <input type="file" name="gambar" class="w-full border p-2 rounded">
                                    @if ($tips->gambar_url)
                                        <p class="text-sm text-gray-600 mt-1">Gambar saat ini:</p>
                                        <img src="{{ $tips->gambar_url }}" alt="Gambar"
                                            class="w-20 h-20 object-cover rounded mt-2">
                                    @endif
                                </div>
                                <div class="flex justify-end gap-2">
                                    <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded"
                                        data-modal-hide="edit-jenis-{{ $tips->id }}">Batal</button>
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center col-span-3 text-gray-500">Belum ada jenis tips tersedia.</p>
            @endforelse
        </div>

        {{-- Modal Tambah --}}
        <div id="modalTambahJenis" tabindex="-1" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-md mx-auto mt-20">
                <div class="bg-white rounded-lg shadow p-4">
                    <form action="{{ route('admin.tips.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-lg font-semibold mb-2">Tambah Jenis Tips</h3>
                        <div class="mb-3">
                            <label class="block mb-1 text-sm font-medium">Nama</label>
                            <input type="text" name="nama" class="w-full border p-2 rounded"
                                placeholder="Contoh: Stres" required>
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1 text-sm font-medium">Deskripsi</label>
                            <textarea name="deskripsi" class="w-full border p-2 rounded" placeholder="Deskripsi singkat" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1 text-sm font-medium">Gambar</label>
                            <input type="file" name="gambar" class="w-full border p-2 rounded" accept="image/*">
                        </div>
                        <div class="flex justify-end gap-2">
                            <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded"
                                data-modal-hide="modalTambahJenis">Batal</button>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
