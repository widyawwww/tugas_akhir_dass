<div id="modalTambahSubskala" tabindex="-1"
     class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-y-auto h-full bg-black bg-opacity-50">
    <div class="relative w-full max-w-md bg-white rounded-lg shadow">
        <form action="{{ route('admin.instrumen-tes.subskala.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <h2 class="text-lg font-semibold text-gray-800">Tambah Subskala</h2>

            <input type="hidden" name="instrumen_tes_id" value="{{ $instrumen->id }}">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Subskala</label>
                <input type="text" name="nama" class="w-full border p-2 rounded" placeholder="Contoh: Depresi" required>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded" data-modal-hide="modalTambahSubskala">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
