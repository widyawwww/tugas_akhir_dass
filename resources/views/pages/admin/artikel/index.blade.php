@extends('pages.admin.index')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<main class="p-4 sm:ml-64 mt-14">

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

    {{-- Header --}}
    <div class="p-4 bg-white rounded-lg shadow-lg flex justify-between items-center">
        <h2 class="text-lg font-semibold">Daftar Artikel</h2>
        <button data-modal-target="tambah" data-modal-toggle="tambah"
            class="bg-blue-500 text-white px-3 py-1 rounded-lg">
            <i class="fa fa-plus"></i> Tambah Artikel
        </button>
        @include('components.modal.tambahArtikel')
    </div>

    <br>

    {{-- Grid Artikel --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @forelse ($artikels as $artikel)
            <div class="bg-white shadow-md rounded-lg p-4 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-semibold mb-2">{{ $artikel->nama }}</h3>
                    <p class="text-gray-600 text-sm mb-3">
                        {{ $artikel->deskripsi_singkat ?? 'Tidak ada deskripsi singkat' }}
                    </p>
                    @if ($artikel->gambar)
                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Gambar Artikel"
                            class="w-full h-32 object-cover rounded mb-3">
                    @else
                        <p class="text-gray-400 italic">Tidak ada gambar</p>
                    @endif
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex gap-2 mt-2">
                    <a href="{{ route('admin.artikel.show', $artikel->id) }}"
                        class="bg-blue-500 text-white text-sm px-2 py-1 rounded-lg flex items-center gap-1">
                        <i class="fa-solid fa-eye"></i>
                        Lihat Deskripsi
                    </a>

                    <button data-modal-target="edit-{{ $artikel->id }}" data-modal-toggle="edit-{{ $artikel->id }}"
                        class="bg-yellow-500 text-white text-sm px-2 py-1 rounded-lg flex items-center gap-1">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Edit
                    </button>

                    <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" method="POST" class="form-hapus">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 text-white text-sm px-2 py-1 rounded-lg flex items-center gap-1">
                            <i class="fa-solid fa-trash"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>

            {{-- Modal Edit --}}
            @include('components.modal.editArtikel', ['artikel' => $artikel])
        @empty
            <p class="text-center col-span-3 text-gray-500">Belum ada artikel.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $artikels->links('vendor.pagination.simple-tailwind') }}
    </div>
</main>
<script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
@endsection
