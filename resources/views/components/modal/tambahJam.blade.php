<div id="modalTambahJam" tabindex="-1"
    class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-y-auto h-full bg-black bg-opacity-50">
    <div class="relative w-full max-w-md bg-white rounded-lg shadow">
        <form action="{{ route('admin.atur-jam.store') }}" method="POST" class="p-4 space-y-4">
            @csrf
            <h3 class="text-lg font-semibold mb-4">Tambah Jam Operasional</h3>

            <div>
                <label class="block mb-1 text-sm font-medium">Hari</label>
                <select name="hari" class="w-full border p-2 rounded" required>
                    <option value="" disabled selected>Pilih Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Jam Mulai</label>
                <input type="time" name="jam_mulai" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="w-full border p-2 rounded" required>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" data-modal-hide="modalTambahJam"
                    class="bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
