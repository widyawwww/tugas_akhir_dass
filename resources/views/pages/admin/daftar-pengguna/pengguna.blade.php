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
                <p class="text-lg font-semibold">Daftar Pasien</p>
                <button data-modal-toggle="tambah" data-modal-target="tambah"
                    class="bg-blue-500 text-white px-3 py-1 rounded-lg">
                    <i class="fa fa-plus"></i> Tambah
                </button>
                @include('components.modal.tambahpengguna')
            </div>

            {{-- Tabel --}}
            <div class="relative overflow-x-auto shadow-md rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama Lengkap</th>
                            <th class="px-6 py-3">Username</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Gambar</th>
                            <th class="px-6 py-3">Tanggal Lahir</th>
                            <th class="px-6 py-3">Jenis Kelamin</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $user->nama_lengkap }}</td>
                                <td class="px-6 py-4">{{ $user->username }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @if ($user->gambar)
                                        <img src="{{ asset('storage/' . $user->gambar) }}" alt="Foto" class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <span class="text-gray-400 italic">Belum ada</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $user->tanggal_lahir ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $user->jenis_kelamin ?? '-' }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <button data-modal-toggle="edit-{{ $user->id }}" data-modal-target="edit-{{ $user->id }}"
                                        class="bg-yellow-500 rounded-lg px-2 py-1 text-white">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    @include('components.modal.editpengguna', ['user' => $user])

                                    <form action="{{ route('admin.users.pengguna.destroy', $user->id) }}" method="POST" class="form-hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 rounded-lg px-2 py-1 text-white">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-gray-500">Belum ada data pasien.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $users->links('vendor.pagination.simple-tailwind') }}
            </div>
        </div>
    </div>

    {{-- Konfirmasi Hapus --}}
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
