<!-- Modal Tambah Artikel -->
<div id="tambah" tabindex="-1" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="relative p-4 w-full max-w-2xl mx-auto mt-20">
        <div class="bg-white rounded-lg shadow-lg p-6 space-y-4">
            <h2 class="text-lg font-semibold">Tambah Artikel</h2>
            <form method="POST" action="{{ route('admin.artikel.store') }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <label>Judul Artikel</label>
                    <input type="text" name="nama" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label>Deskripsi Singkat</label>
                    <textarea name="deskripsi_singkat" class="w-full border rounded px-3 py-2"></textarea>
                </div>
                <div>
                    <label>Deskripsi Lengkap</label>
                    <textarea name="deskripsi" class="w-full border rounded px-3 py-2"></textarea>
                </div>
                <div>
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="w-full border rounded px-3 py-2">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" data-modal-hide="tambah" class="bg-gray-400 px-4 py-2 text-white rounded">Batal</button>
                    <button type="submit" class="bg-blue-500 px-4 py-2 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
