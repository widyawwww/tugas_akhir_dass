<!-- Modal Edit Admin -->
<div id="edit-{{ $admin->id }}" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900">Edit Admin</h3>
                <button type="button"
                    class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="edit-{{ $admin->id }}">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Tutup</span>
                </button>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('admin.users.admin.update', $admin->id) }}" enctype="multipart/form-data" class="p-4 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" class="w-full border rounded-lg px-3 py-2" value="{{ $admin->username }}" required>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Gambar (opsional)</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                    
                    @if ($admin->gambar)
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 mb-1">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $admin->gambar) }}" alt="Foto Admin" class="w-20 h-20 rounded object-cover border">
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Kata Sandi <span class="text-sm text-gray-500">(Kosongkan jika tidak diubah)</span></label>
                    <input type="password" name="password" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
