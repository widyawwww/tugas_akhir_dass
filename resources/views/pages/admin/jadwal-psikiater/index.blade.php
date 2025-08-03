@extends('pages.admin.index')

@section('content')
<div class="p-4 sm:ml-64">
    <div class="mt-14 space-y-6">
        <!-- Header dan tombol tambah -->
        <div class="p-4 bg-white rounded-lg shadow-lg flex justify-between items-center">
            <p class="text-lg font-semibold">Jadwal Konsultasi Psikiater</p>
            <div class="flex space-x-2">
                <a href="{{ route('admin.jadwal-psikiater.generate') }}"
                   class="bg-green-600 text-white px-3 py-1.5 rounded-lg hover:bg-green-700 text-sm">
                    <i class="fa-solid fa-rotate"></i> Generate Otomatis 1 Minggu
                </a>
                <a href="#" class="bg-blue-500 rounded-lg px-2 py-1 text-white hover:bg-blue-600 text-sm"
                   data-modal-target="modalTambahJadwalPsikiater" data-modal-toggle="modalTambahJadwalPsikiater">
                    <i class="fa-solid fa-plus"></i> Tambah Jadwal
                </a>
            </div>
        </div>

        <!-- Tabel Jadwal -->
        <div class="mb-10">
            <div class="relative overflow-x-auto">
                <table class="w-full bg-white rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-600 text-sm font-semibold">
                            <th class="p-3">No</th>
                            <th class="p-3">Psikiater</th>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Jam</th>
                            <th class="p-3">Jumlah Slot</th>
                            <th class="p-3">Sisa Slot</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwal as $index => $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 text-sm">{{ $index + 1 }}</td>
                            <td class="p-3 text-sm">{{ $item->psikiater->nama_lengkap ?? '-' }}</td>
                            <td class="p-3 text-sm">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td class="p-3 text-sm">
                                @foreach ($item->slotJam as $jamItem)
                                    <div>
                                        {{ \Carbon\Carbon::parse($jamItem->jam->jam_mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($jamItem->jam->jam_selesai)->format('H:i') }}
                                    </div>
                                @endforeach
                            </td>
                            <td class="p-3 text-sm">
                                {{ $item->slotJam->sum(fn($jam) => $jam->rincian->jumlah_slot ?? 0) }}
                            </td>
                            <td class="p-3 text-sm">
                                {{ $item->slotJam->sum(fn($jam) => $jam->rincian->slot_tersisa ?? 0) }}
                            </td>
                            <td class="p-3 text-sm text-center whitespace-nowrap">
                                <!-- Tombol Edit -->
                                <button class="text-blue-600 hover:underline text-sm"
                                    data-modal-target="modalEditJadwalPsikiater-{{ $item->id }}"
                                    data-modal-toggle="modalEditJadwalPsikiater-{{ $item->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                <!-- Form Hapus -->
                                <form action="{{ route('admin.jadwal-psikiater.destroy', $item->id) }}"
                                    method="POST" class="inline-block"
                                    onsubmit="return confirm('Yakin hapus jadwal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-2 text-red-600 hover:underline text-sm">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-4 text-center text-gray-500">Belum ada jadwal tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('components.modal.tambahJadwalPsikiater')
@include('components.modal.editJadwalPsikiater')
@endsection
