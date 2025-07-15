<div id="modalEditOpsi{{ $opsi->id }}" tabindex="-1"
     class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-y-auto h-full bg-black bg-opacity-50">
    <div class="relative w-full max-w-lg bg-white rounded-lg shadow">
        <form action="{{ route('admin.instrumen-tes.opsi.update', $opsi->id) }}" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <h2 class="text-lg font-semibold text-gray-800">Edit Opsi Jawaban</h2>

            <div>
                <label class="block text-sm font-medium mb-1">Teks Opsi</label>
                <input type="text" name="teks_opsi" value="{{ $opsi->teks_opsi }}" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Skor</label>
                <input type="number" name="skor" value="{{ $opsi->skor }}" class="w-full border rounded p-2" required>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded" data-modal-hide="modalEditOpsi{{ $opsi->id }}">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
