@extends('layouts.admin')

@section('content')
<div class="p-4 sm:ml-64 mt-14">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-xl font-bold mb-4">Tautkan Tips untuk Instrumen: {{ $instrumen->nama }}</h1>

        <form action="{{ route('admin.instrumen-tes.update-tips', $instrumen->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div id="tips-container" class="space-y-3">
                {{-- Tips yang sudah terkait --}}
                @foreach ($instrumen->tips as $tip)
                    <div class="mb-2 flex items-center gap-2">
                        <select name="tips_id[]" class="w-full border rounded px-3 py-2">
                            @foreach ($tips as $t)
                                <option value="{{ $t->id }}" {{ $tip->id == $t->id ? 'selected' : '' }}>
                                    {{ $t->nama }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" class="remove-tips px-2 py-1 bg-red-500 text-white rounded">X</button>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <button type="button" id="add-tips" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Tambah Tips
                </button>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('add-tips').addEventListener('click', function () {
        const container = document.getElementById('tips-container');

        const dropdown = `
            <div class="mb-2 flex items-center gap-2">
                <select name="tips_id[]" class="w-full border rounded px-3 py-2">
                    @foreach ($tips as $t)
                        <option value="{{ $t->id }}">{{ $t->nama }}</option>
                    @endforeach
                </select>
                <button type="button" class="remove-tips px-2 py-1 bg-red-500 text-white rounded">X</button>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', dropdown);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-tips')) {
            e.target.closest('.flex').remove();
        }
    });
</script>
@endsection
