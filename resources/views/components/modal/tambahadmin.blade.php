<!-- Modal Tambah Admin -->
<div id="tambah" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow-lg">
            
            <!-- Header Modal -->
            <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900">
                    Tambah Admin
                </h3>
                <button type="button"
                    class="text-gray-400 hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                    data-modal-hide="tambah">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13" />
                    </svg>
                    <span class="sr-only">Tutup</span>
                </button>
            </div>

            <!-- Form Tambah Admin -->
            <form method="POST" action="{{ route('admin.users.admin.store') }}" class="p-4 space-y-4">
                @csrf

                <div>
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="name" name="name" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="gambar" class="block mb-1 text-sm font-medium text-gray-700">Upload Gambar (opsional)</label>
                    <input type="file" id="gambar" name="gambar"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                </div>

                <div>
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Kata Sandi</label>
                    <input type="password" id="password" name="password" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Footer Modal -->
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-200">
                    <button type="button" data-modal-hide="tambah"
                        class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
