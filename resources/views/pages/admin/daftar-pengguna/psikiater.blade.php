@extends('pages.admin.index')

@section('content')
<main>
    {{-- Notifikasi --}}
    @if(session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session("success") }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ $errors->first() }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        </script>
    @endif

    <div class="p-4 sm:ml-64">
        <div class="space-y-4 rounded-lg mt-14">
            {{-- Header --}}
            <div class="p-4 bg-white rounded-lg shadow-lg flex items-center justify-between">
                <p class="text-lg font-semibold">Daftar Psikiater</p>
                <button data-modal-toggle="tambah" data-modal-target="tambah"
                    class="bg-blue-500 text-white px-3 py-1 rounded-lg">
                    <i class="fa fa-plus"></i> Tambah
                </button>
            </div>

            {{-- Modal Tambah Psikiater --}}
            <div id="tambah" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="bg-white rounded-lg w-full max-w-2xl p-6">
                    <h3 class="text-lg font-semibold mb-4">Tambah Psikiater</h3>
                    <form method="POST" action="{{ route('admin.users.psikiater.store') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="text" name="nama_lengkap" class="w-full border px-3 py-2 rounded" placeholder="Nama Lengkap" required>
                        <input type="email" name="email" class="w-full border px-3 py-2 rounded" placeholder="Email">
                        <input type="text" name="spesialisasi" class="w-full border px-3 py-2 rounded" placeholder="Spesialisasi">
                        <input type="text" name="nomor_lisensi" class="w-full border px-3 py-2 rounded" placeholder="Nomor Lisensi">
                        <input type="number" name="biaya_layanan" class="w-full border px-3 py-2 rounded" placeholder="Biaya Layanan">
                        <input type="text" name="lokasi_pelayanan" class="w-full border px-3 py-2 rounded" placeholder="Lokasi Pelayanan">
                        <input type="file" name="gambar" class="w-full border px-3 py-2 rounded">

                        <div class="text-end">
                            <button type="button" data-modal-hide="tambah" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tabel --}}
            <div class="relative overflow-x-auto shadow-md rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Gambar</th>
                            <th class="px-6 py-3">Spesialisasi</th>
                            <th class="px-6 py-3">Lisensi</th>
                            <th class="px-6 py-3">Biaya</th>
                            <th class="px-6 py-3">Lokasi</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($psikiaters as $psikiater)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $psikiater->nama_lengkap }}</td>
                                <td class="px-6 py-4">{{ $psikiater->email }}</td>
                                <td class="px-6 py-4">
                                    @if ($psikiater->gambar)
                                        <img src="{{ asset('storage/' . $psikiater->gambar) }}" alt="Foto" class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <span class="text-gray-400 italic">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $psikiater->spesialisasi }}</td>
                                <td class="px-6 py-4">{{ $psikiater->nomor_lisensi }}</td>
                                <td class="px-6 py-4">Rp{{ number_format($psikiater->biaya_layanan, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">{{ $psikiater->lokasi_pelayanan }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    {{-- Tombol Edit --}}
                                    <button data-modal-toggle="edit-{{ $psikiater->id }}" class="bg-yellow-500 text-white px-2 py-1 rounded">
                                        <i class="fa fa-pencil"></i>
                                    </button>

                                    {{-- Modal Edit --}}
                                    <div id="edit-{{ $psikiater->id }}" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
                                        <div class="bg-white rounded-lg w-full max-w-2xl p-6">
                                            <h3 class="text-lg font-semibold mb-4">Edit Psikiater</h3>
                                            <form method="POST" action="{{ route('admin.users.psikiater.update', $psikiater->id) }}" enctype="multipart/form-data" class="space-y-4">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="nama_lengkap" value="{{ $psikiater->nama_lengkap }}" class="w-full border px-3 py-2 rounded">
                                                <input type="email" name="email" value="{{ $psikiater->email }}" class="w-full border px-3 py-2 rounded">
                                                <input type="text" name="spesialisasi" value="{{ $psikiater->spesialisasi }}" class="w-full border px-3 py-2 rounded">
                                                <input type="text" name="nomor_lisensi" value="{{ $psikiater->nomor_lisensi }}" class="w-full border px-3 py-2 rounded">
                                                <input type="number" name="biaya_layanan" value="{{ $psikiater->biaya_layanan }}" class="w-full border px-3 py-2 rounded">
                                                <input type="text" name="lokasi_pelayanan" value="{{ $psikiater->lokasi_pelayanan }}" class="w-full border px-3 py-2 rounded">
                                                <input type="file" name="gambar" class="w-full border px-3 py-2 rounded">

                                                <div class="text-end">
                                                    <button type="button" data-modal-hide="edit-{{ $psikiater->id }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                                                    <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- Hapus --}}
                                    <form action="{{ route('admin.users.psikiater.destroy', $psikiater->id) }}" method="POST" class="form-hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 text-white px-2 py-1 rounded">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-gray-500">Belum ada data psikiater.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $psikiaters->links('vendor.pagination.simple-tailwind') }}
            </div>
        </div>
    </div>

    {{-- Script konfirmasi hapus --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.form-hapus');
            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: 'Data ini tidak bisa dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</main>
@endsection
