<div id="modalEditSoal{{ $soal->id }}" tabindex="-1"
     class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-y-auto h-full bg-black bg-opacity-50">
    <div class="relative w-full max-w-lg bg-white rounded-lg shadow">
        <form action="{{ route('admin.instrumen-tes.pertanyaan.update', $soal->id) }}" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            <h2 class="text-lg font-semibold text-gray-800">Edit Soal</h2>

            {{-- Hidden Instrumen ID --}}
            <input type="hidden" name="instrumen_tes_id" value="{{ $soal->instrumen_tes_id }}">

            {{-- Teks Pertanyaan --}}
            <div>
                <label for="teks_pertanyaan_{{ $soal->id }}" class="block text-sm font-medium text-gray-700 mb-1">
                    Teks Pertanyaan
                </label>
                <textarea name="teks_pertanyaan" id="teks_pertanyaan_{{ $soal->id }}" rows="3"
                          class="w-full border rounded p-2" required>{{ $soal->teks_pertanyaan }}</textarea>
            </div>

            {{-- Subskala (Optional) --}}
            <div>
                <label for="subskala_id_{{ $soal->id }}" class="block text-sm font-medium text-gray-700 mb-1">
                    Subskala (Opsional)
                </label>
                <select name="subskala_id" id="subskala_id_{{ $soal->id }}" class="w-full border rounded p-2">
                    <option value="">-- Tanpa Subskala --</option>
                    @foreach ($instrumen->subskala as $sub)
                        <option value="{{ $sub->id }}" @if ($soal->subskala_id == $sub->id) selected @endif>
                            {{ $sub->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-end gap-2">
                <button type="button"
                        class="bg-gray-400 text-white px-4 py-2 rounded"
                        data-modal-hide="modalEditSoal{{ $soal->id }}">
                    Batal
                </button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
