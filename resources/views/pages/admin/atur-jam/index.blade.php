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

        {{-- Filter Hari --}}
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <form method="GET" action="{{ route('admin.atur-jam.index') }}" class="flex items-center gap-4">
                <label for="filter_hari" class="text-sm font-medium text-gray-700">Filter Hari:</label>
                <select name="filter_hari" id="filter_hari"
                    class="border border-gray-300 rounded px-3 py-1 text-sm focus:ring focus:ring-blue-200">
                    <option value="">Semua Hari</option>
                    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
                        <option value="{{ $hari }}" {{ request('filter_hari') == $hari ? 'selected' : '' }}>
                            {{ $hari }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                    class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                    Terapkan
                </button>
            </form>
        </div>

        {{-- Tabel Data Jam --}}
        <div class="mb-10">
            <div class="relative overflow-x-auto">
                <table class="w-full bg-white rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-600 text-sm font-semibold">
                            <th class="p-3">No</th>
                            <th class="p-3">Hari</th>
                            <th class="p-3">Jam Mulai</th>
                            <th class="p-3">Jam Selesai</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jam as $index => $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 text-sm text-gray-700">
                                    {{ ($jam->currentPage() - 1) * $jam->perPage() + $index + 1 }}
                                </td>
                                <td class="p-3 text-sm text-gray-700">{{ $item->hari }}</td>
                                <td class="p-3 text-sm text-gray-700">{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}</td>
                                <td class="p-3 text-sm text-gray-700">{{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}</td>
                                <td class="p-3 text-sm flex items-center justify-center gap-2">
                                    {{-- Tombol Edit --}}
                                    <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-2 rounded text-xs flex items-center gap-1"
                                        data-modal-target="modalEditJam{{ $item->id }}" data-modal-toggle="modalEditJam{{ $item->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </button>
                                    @include('components.modal.editJam', ['jam' => $item])

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('admin.atur-jam.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jam ini?')">
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
                                <td colspan="5" class="p-4 text-center text-gray-500">Belum ada jam tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $jam->withQueryString()->links() }}
            </div>
        </div>
    </div>
</main>
@endsection
