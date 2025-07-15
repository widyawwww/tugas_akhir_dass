@extends('pages.admin.index')

@section('content')
<main class="p-4 sm:ml-64 mt-14">
    <div class="space-y-4">
        <!-- Header -->
        <div class="p-4 bg-white rounded-lg shadow-lg flex justify-between items-center">
            <h2 class="text-lg font-semibold">Tips untuk: {{ $tips->nama }}</h2>
            <button data-modal-target="modalTambahTips" data-modal-toggle="modalTambahTips"
                class="bg-blue-500 rounded-lg px-2 py-1 text-white">
                <i class="fa-solid fa-plus"></i> Tambah Tips
            </button>
        </div>

        <!-- Tabel Tips -->
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="w-full bg-white rounded-lg shadow-lg">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-600 text-sm font-semibold">
                        <th class="p-3">No</th>
                        <th class="p-3">Daftar Tips</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftarTips as $index => $isi)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                        <td class="p-3 text-sm text-gray-700">{{ $isi }}</td>
                        <td class="p-3 text-sm text-gray-700 text-center">
                            <div class="flex justify-center gap-2">
                                <!-- Tombol Edit -->
                                <button type="button"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs"
                                    data-modal-target="modalEditTips{{ $index }}"
                                    data-modal-toggle="modalEditTips{{ $index }}">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                </button>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.tips.update', $tips->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="index" value="{{ $index }}">
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                        <i class="fa-solid fa-trash-can me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Edit Tips -->
                    <div id="modalEditTips{{ $index }}" tabindex="-1"
                        class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-y-auto h-full bg-black bg-opacity-50">
                        <div class="relative w-full max-w-xl bg-white rounded-lg shadow">
                            <div class="flex justify-between items-center p-4 border-b">
                                <h3 class="text-lg font-semibold">Edit Tips</h3>
                                <button type="button" class="text-gray-400 hover:text-gray-900"
                                    data-modal-hide="modalEditTips{{ $index }}">×</button>
                            </div>
                            <form action="{{ route('admin.tips.update', $tips->id) }}" method="POST" class="p-4 space-y-4">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="index" value="{{ $index }}">
                                <div>
                                    <label class="block mb-2 text-sm font-medium">Daftar Tips</label>
                                    <textarea name="edited_tip" rows="4"
                                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300"
                                        required>{{ $isi }}</textarea>
                                </div>
                                <div class="flex justify-end gap-2">
                                    <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded"
                                        data-modal-hide="modalEditTips{{ $index }}">Batal</button>
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">Belum ada tips ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Tips -->
    <div id="modalTambahTips" tabindex="-1"
        class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-y-auto h-full bg-black bg-opacity-50">
        <div class="relative w-full max-w-xl bg-white rounded-lg shadow">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-lg font-semibold">Tambah Tips</h3>
                <button type="button" class="text-gray-400 hover:text-gray-900"
                    data-modal-hide="modalTambahTips">×</button>
            </div>
            <form action="{{ route('admin.tips.update', $tips->id) }}" method="POST" class="p-4 space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" name="action" value="add">
                <div>
                    <label class="block mb-2 text-sm font-medium">Daftar Tips</label>
                    <textarea name="new_tip" rows="4"
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300"
                        placeholder="Tulis tips baru..." required></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded"
                        data-modal-hide="modalTambahTips">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
