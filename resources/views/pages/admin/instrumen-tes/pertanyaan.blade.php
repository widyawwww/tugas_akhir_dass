@extends('pages.admin.index')

@section('content')
<main class="p-4 sm:ml-64 mt-14">
    <div class="space-y-4 rounded-lg">
        {{-- Header --}}
        <div class="p-4 bg-white rounded-lg shadow-lg flex justify-between items-center">
            <h1 class="text-lg font-semibold text-gray-800">Daftar Soal: {{ $instrumen->nama }}</h1>
            <a href="#" class="bg-blue-500 rounded-lg px-2 py-1 text-white hover:bg-blue-600 text-sm"
               data-modal-target="modalTambahSoal" data-modal-toggle="modalTambahSoal">
                <i class="fa-solid fa-plus"></i> Tambah Soal
            </a>
        </div>

        {{-- Include Modal Tambah Soal --}}
        @include('components.modal.tambahSoal', ['instrumen' => $instrumen])

        {{-- Tabel Soal --}}
        <div class="relative overflow-x-auto mb-10">
            <table class="w-full bg-white rounded-lg shadow-lg">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-600 text-sm font-semibold">
                        <th class="p-3">No</th>
                        <th class="p-3">Teks Pertanyaan</th>
                        <th class="p-3">Subskala</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pertanyaanList as $index => $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                            <td class="p-3 text-sm text-gray-700">{{ $item->teks_pertanyaan }}</td>
                            <td class="p-3 text-sm text-gray-700">
                                {{ $item->subskala ? $item->subskala->nama : 'Tanpa Subskala' }}
                            </td>
                            <td class="p-3 text-sm flex justify-center gap-2">
                                {{-- Tombol Edit --}}
                                <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-2 rounded text-xs flex items-center gap-1"
                                    data-modal-target="modalEditSoal{{ $item->id }}" data-modal-toggle="modalEditSoal{{ $item->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>

                                {{-- Modal Edit --}}
                                @include('components.modal.editSoal', ['soal' => $item])

                                <form action="{{ route('admin.instrumen-tes.pertanyaan.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-xs flex items-center gap-1">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">Belum ada soal ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
