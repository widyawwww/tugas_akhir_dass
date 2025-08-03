@extends('layouts.admin')

@section('content')
<div class="p-4 sm:ml-64 mt-14">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-xl font-bold mb-4">Tautkan Artikel untuk Instrumen: {{ $instrumen->nama }}</h1>

        <form action="{{ route('admin.instrumen-tes.update-artikel', $instrumen->id) }}" method="POST" id="artikel-form">
            @csrf
            @method('PUT')

            <div id="artikel-container">
                @forelse ($instrumen->artikel as $existingArtikel)
                    <div class="mb-2 flex items-center gap-2">
                        <select name="artikel_id[]" class="w-full border rounded px-3 py-2">
                            @foreach ($artikel as $a)
                                <option value="{{ $a->id }}" {{ $existingArtikel->id == $a->id ? 'selected' : '' }}>
                                    {{ $a->nama }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" class="remove-artikel px-2 py-1 bg-red-500 text-white rounded">X</button>
                    </div>
                @empty
                    <div class="mb-2 flex items-center gap-2">
                        <select name="artikel_id[]" class="w-full border rounded px-3 py-2">
                            @foreach ($artikel as $a)
                                <option value="{{ $a->id }}">{{ $a->nama }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="remove-artikel px-2 py-1 bg-red-500 text-white rounded">X</button>
                    </div>
                @endforelse
            </div>

            <button type="button" id="add-artikel" class="bg-blue-500 text-white px-3 py-1 rounded mb-4">
                + Tambah Artikel
            </button>

            <br>

            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
                Simpan
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('artikel-container');
        const addBtn = document.getElementById('add-artikel');

        addBtn.addEventListener('click', function () {
            const dropdownHTML = `
                <div class="mb-2 flex items-center gap-2">
                    <select name="artikel_id[]" class="w-full border rounded px-3 py-2">
                        @foreach ($artikel as $a)
                            <option value="{{ $a->id }}">{{ $a->nama }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="remove-artikel px-2 py-1 bg-red-500 text-white rounded">X</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', dropdownHTML);
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-artikel')) {
                e.target.closest('.flex').remove();
            }
        });
    });
</script>
@endsection
