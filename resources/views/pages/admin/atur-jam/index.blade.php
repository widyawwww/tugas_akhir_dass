@extends('pages.admin.index')

@section('content')
<main class="p-4 sm:ml-64">
    <div class="space-y-4 rounded-lg mt-14">
        {{-- Header dan Tombol Tambah --}}
        <div class="p-4 bg-white rounded-lg shadow-lg flex justify-between items-center">
            <h1 class="text-lg font-semibold text-gray-800">Atur Jam Operasional Konsultasi</h1>
            <a href="#" class="bg-blue-500 rounded-lg px-2 py-1 text-white hover:bg-blue-600 text-sm"
            data-modal-target="modalTambahJam" data-modal-toggle="modalTambahJam">
                <i class="fa-solid fa-plus"></i> Tambah Jam
            </a>

            {{-- Include modal Tambah Jam --}}
            @include('components.modal.tambahJam')
        </div>

        {{-- Tabel Statis --}}
        <div class="mb-10">
            <div class="relative overflow-x-auto">
                <table class="w-full bg-white rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-600 text-sm font-semibold">
                            <th class="p-3">No</th>
                            <th class="p-3">Jam Mulai</th>
                            <th class="p-3">Jam Selesai</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jam as $index => $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                                <td class="p-3 text-sm text-gray-700">{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}</td>
                                <td class="p-3 text-sm text-gray-700">{{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}</td>
                                <td class="p-3 text-sm flex items-center justify-center gap-2">
                                    {{-- Tombol Edit --}}
                                <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-2 rounded text-xs flex items-center gap-1"
                                    data-modal-target="modalEditJam{{ $item->id }}" data-modal-toggle="modalEditJam{{ $item->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                    {{-- Include modal edit --}}
                                    @include('components.modal.editJam', ['jam' => $item])

                                    <form action="{{ route('admin.atur-jam.destroy', $item->id) }}" method="POST">
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
                                <td colspan="4" class="p-4 text-center text-gray-500">Belum ada jam tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
