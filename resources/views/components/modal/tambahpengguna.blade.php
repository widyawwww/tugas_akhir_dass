<!-- Modal Tambah Pasien -->
<div id="tambah" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 justify-center items-center bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900">Tambah Pasien</h3>
                <button type="button"
                    class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8"
                    data-modal-hide="tambah">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13" />
                    </svg>
                    <span class="sr-only">Tutup</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.users.pengguna.store') }}" enctype="multipart/form-data"
                class="p-4 space-y-4">
                @csrf
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border rounded-lg px-3 py-2">
                        <option value="">Pilih</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Foto Profil</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div class="flex justify-end border-t pt-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
