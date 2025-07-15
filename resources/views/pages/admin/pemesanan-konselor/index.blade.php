@extends('pages.admin.index')

@section('content')
<main>
    <div class="p-4 sm:ml-64 mt-14">
        <div class="space-y-6">

            {{-- Header --}}
            <div class="bg-white p-6 rounded-2xl shadow-lg flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-blue-700">Data Pemesanan Konselor</h1>
                    <p class="text-gray-500 text-sm">Kelola pemesanan sesi konsultasi pengguna dengan konselor</p>
                </div>
            </div>

            {{-- Tabel --}}
            <div class="bg-white rounded-2xl shadow-lg p-4 overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-gray-600 uppercase bg-gray-100 rounded-t-xl">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Nama Pengguna</th>
                            <th class="px-4 py-3">Konselor</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Jam</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $item)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $item->pengguna->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->konselor->nama_lengkap ?? '-' }}</td>
                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($item->slotJam->slotKonsultasi->tanggal ?? now())->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($item->slotJam->jam->jam_mulai ?? '00:00')->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($item->slotJam->jam->jam_selesai ?? '00:00')->format('H:i') }}
                            </td>
                            <td class="px-4 py-3">
                                @php
                                    $statusClass = match($item->status) {
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'disetujui' => 'bg-green-100 text-green-800',
                                        'ditolak' => 'bg-red-100 text-red-800',
                                        'selesai' => 'bg-blue-100 text-blue-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="px-3 py-1 text-xs rounded-full font-medium {{ $statusClass }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <select class="text-sm border border-gray-300 rounded-lg px-3 py-1 shadow-sm focus:ring focus:ring-blue-200">
                                    <option {{ $item->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option {{ $item->status === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option {{ $item->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach

                        @if($data->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 p-4">Belum ada pemesanan.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</main>
@endsection
