<!-- Modal Edit Konselor -->
<div id="edit-{{ $konselor->id }}" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 justify-center items-center bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow-lg">

            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900">Edit Konselor</h3>
                <button type="button"
                    class="text-gray-400 hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                    data-modal-hide="edit-{{ $konselor->id }}">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13" />
                    </svg>
                    <span class="sr-only">Tutup</span>
                </button>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('admin.users.konselor.update', $konselor->id) }}" enctype="multipart/form-data"
                class="p-4 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="w-full border rounded-lg px-3 py-2"
                        value="{{ $konselor->nama_lengkap }}" required>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" class="w-full border rounded-lg px-3 py-2"
                        value="{{ $konselor->username }}" required>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full border rounded-lg px-3 py-2"
                        value="{{ $konselor->email }}">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Spesialisasi</label>
                    <input type="text" name="spesialisasi" class="w-full border rounded-lg px-3 py-2"
                        value="{{ $konselor->spesialisasi }}">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Foto Profil <span class="text-sm text-gray-500">(opsional)</span></label>
                    <input type="file" name="gambar" accept="image/*"
                        onchange="previewImage(this, 'preview-{{ $konselor->id }}')"
                        class="w-full border rounded-lg px-3 py-2">
                    
                    <div class="mt-2">
                        @if ($konselor->gambar)
                            <img id="preview-{{ $konselor->id }}" src="{{ asset('storage/' . $konselor->gambar) }}"
                                 class="w-20 h-20 rounded-lg object-cover border">
                        @else
                            <img id="preview-{{ $konselor->id }}" style="display: none"
                                 class="w-20 h-20 rounded-lg object-cover border">
                        @endif
                    </div>
                </div>
                
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Kata Sandi <span class="text-sm text-gray-500">(Kosongkan jika tidak diubah)</span></label>
                    <input type="password" name="password" class="w-full border rounded-lg px-3 py-2"
                           autocomplete="new-password">
                </div>

                <!-- Footer -->
                <div class="flex justify-end pt-4 border-t border-gray-200 gap-2">
                    <button type="button" data-modal-hide="edit-{{ $konselor->id }}"
                        class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">Batal</button>
                    <button type="submit"
                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script Preview -->
<script>
function previewImage(input, previewId) {
    const file = input.files[0];
    const preview = document.getElementById(previewId);

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}
</script>
