<div id="tambah" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 justify-center items-center bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow-lg">

            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900">
                    Tambah Konselor
                </h3>
                <button type="button"
                    class="text-gray-400 hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                    data-modal-hide="tambah">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Tutup</span>
                </button>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('admin.users.konselor.store') }}" enctype="multipart/form-data"
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
                    <input type="email" name="email" class="w-full border rounded-lg px-3 py-2">
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
                    <label class="block mb-1 text-sm font-medium text-gray-700">Spesialisasi</label>
                    <input type="text" name="spesialisasi" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Nomor Lisensi</label>
                    <input type="text" name="nomor_lisensi" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Foto Profil (Opsional)</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Kata Sandi</label>
                    <input type="password" name="password" class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <!-- Footer -->
                <div class="flex justify-end pt-4 border-t border-gray-200 gap-2">
                    <button type="button" data-modal-hide="tambah"
                        class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">Batal</button>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
