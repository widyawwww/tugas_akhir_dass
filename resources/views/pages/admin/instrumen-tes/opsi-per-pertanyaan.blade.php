@extends('pages.admin.index')

@section('content')
<main class="p-4 sm:ml-64 mt-14">
    <div class="space-y-4 rounded-lg">
        <div class="p-4 bg-white rounded-lg shadow-lg">
            <h1 class="text-lg font-semibold text-gray-800">Daftar Opsi Jawaban per Pertanyaan: {{ $instrumen->nama }}</h1>
        </div>

        @foreach ($pertanyaans as $pertanyaan)
            <div class="bg-white rounded-lg shadow-md p-4 mb-6">
                <h2 class="font-semibold text-gray-700 mb-2">Pertanyaan {{ $pertanyaan->id }}: {{ $pertanyaan->teks_pertanyaan }}</h2>

                <table class="w-full mb-3">
                    <thead class="bg-gray-100 text-gray-600 text-sm font-semibold">
                        <tr>
                            <th class="p-2 text-left">Teks Opsi</th>
                            <th class="p-2">Skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pertanyaan->opsiJawabanPertanyaan as $opsi)
                            <tr class="border-b">
                                <td class="p-2 text-sm">{{ $opsi->teks_opsi }}</td>
                                <td class="p-2 text-center">{{ $opsi->skor }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="p-2 text-center text-gray-500">Belum ada opsi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</main>
@endsection
