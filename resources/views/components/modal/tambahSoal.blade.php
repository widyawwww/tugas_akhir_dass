<div id="modalTambahSoal" tabindex="-1"
     class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-y-auto h-full bg-black bg-opacity-50">
    <div class="relative w-full max-w-lg bg-white rounded-lg shadow">
        <form action="{{ route('admin.instrumen-tes.pertanyaan.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <h2 class="text-lg font-semibold text-gray-800">Tambah Soal Baru</h2>

            {{-- Hidden Instrumen ID --}}
            <input type="hidden" name="instrumen_tes_id" value="{{ $instrumen->id }}">

            {{-- Teks Pertanyaan --}}
            <div>
                <label for="teks_pertanyaan" class="block text-sm font-medium text-gray-700 mb-1">Teks Pertanyaan</label>
                <textarea name="teks_pertanyaan" id="teks_pertanyaan" rows="3"
                          class="w-full border rounded p-2" required></textarea>
            </div>

            {{-- Subskala (Optional) --}}
            <div>
                <label for="subskala_id" class="block text-sm font-medium text-gray-700 mb-1">Subskala (Opsional)</label>
                <select name="subskala_id" id="subskala_id" class="w-full border rounded p-2">
                    <option value="">-- Tanpa Subskala --</option>
                    @foreach ($instrumen->subskala as $sub)
                        <option value="{{ $sub->id }}">{{ $sub->nama }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Aksi --}}
            <div class="flex justify-end gap-2">
                <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded" data-modal-hide="modalTambahSoal">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
