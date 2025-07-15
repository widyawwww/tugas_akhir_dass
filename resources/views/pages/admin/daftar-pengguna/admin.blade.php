@extends('pages.admin.index')

@section('content')
<main>
    {{-- SweetAlert Dummy --}}
    @if(session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session("success") }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
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
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        </script>
    @endif

    <div class="p-4 sm:ml-64">
        <div class="space-y-4 rounded-lg mt-14">
            <div class="p-4 bg-white rounded-lg shadow-lg flex items-center justify-between">
                <p class="text-lg font-semibold">Admin</p>

                <button data-modal-toggle="tambah" data-modal-target="tambah" type="button"
                    class="bg-blue-500 rounded-lg px-2 py-1 text-white">
                    <i class="fa-solid fa-plus"></i>
                </button>

                {{-- Modal Tambah bisa ditaruh di komponen --}}
                @include('components.modal.tambahadmin')
            </div>

            <div class="relative overflow-x-auto shadow-md rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Username</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Profile</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $index => $admin)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $admin->username }}</td>
                                <td class="px-6 py-4">{{ $admin->email }}</td>
                                <td class="px-6 py-4">
                                    @if ($admin->gambar)
                                        <img src="{{ asset('storage/' . $admin->gambar) }}" alt="Gambar Admin" class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <span class="text-gray-400 italic">Belum ada profile</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <button data-modal-toggle="edit-{{ $admin->id }}" data-modal-target="edit-{{ $admin->id }}"
                                        class="bg-yellow-500 rounded-lg px-2 py-1 text-white">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>

                                    {{-- Modal Edit --}}
                                    @include('components.modal.editadmin', ['admin' => $admin])

                                    <form action="{{ route('admin.users.admin.destroy', $admin->id) }}" method="POST"
                                        class="form-hapus">
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
                                <td colspan="4" class="text-center py-4 text-gray-500">Belum ada data admin.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $admins->links('vendor.pagination.simple-tailwind') }}
            </div>
        </div>
    </div>

    {{-- Script konfirmasi hapus --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.form-hapus');
            forms.forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data tidak bisa dikembalikan!",
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
