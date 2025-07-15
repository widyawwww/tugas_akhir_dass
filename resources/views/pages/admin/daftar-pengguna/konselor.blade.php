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
                <p class="text-lg font-semibold">Daftar Konselor</p>
                <button data-modal-toggle="tambah" data-modal-target="tambah"
                    class="bg-blue-500 text-white px-3 py-1 rounded-lg">
                    <i class="fa fa-plus"></i> Tambah
                </button>
                @include('components.modal.tambahkonselor')
            </div>

            {{-- Tabel --}}
            <div class="relative overflow-x-auto shadow-md rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">Username</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Gambar</th>
                            <th class="px-6 py-3">Tanggal Lahir</th>
                            <th class="px-6 py-3">Jenis Kelamin</th>
                            <th class="px-6 py-3">Spesialisasi</th>
                            <th class="px-6 py-3">Lisensi</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($konselors as $konselor)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $konselor->nama_lengkap }}</td>
                                <td class="px-6 py-4">{{ $konselor->username }}</td>
                                <td class="px-6 py-4">{{ $konselor->email }}</td>
                                <td class="px-6 py-4">
                                    @if ($konselor->gambar)
                                        <img src="{{ asset('storage/' . $konselor->gambar) }}" alt="Foto"
                                            class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <span class="text-gray-400 italic">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $konselor->tanggal_lahir ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $konselor->jenis_kelamin ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $konselor->spesialisasi }}</td>
                                <td class="px-6 py-4">{{ $konselor->nomor_lisensi }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    {{-- Tombol Edit --}}
                                    <button data-modal-toggle="edit-{{ $konselor->id }}" data-modal-target="edit-{{ $konselor->id }}"
                                        class="bg-yellow-500 text-white px-2 py-1 rounded">
                                        <i class="fa fa-pencil"></i>
                                    </button>

                                    {{-- Modal Edit --}}
                                    @include('components.modal.editkonselor', ['konselor' => $konselor])

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('admin.users.konselor.destroy', $konselor->id) }}" method="POST" class="form-hapus">
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
                                <td colspan="10" class="text-center py-4 text-gray-500">Belum ada data konselor.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $konselors->links('vendor.pagination.simple-tailwind') }}
            </div>
        </div>
    </div>

    {{-- Konfirmasi hapus --}}
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
