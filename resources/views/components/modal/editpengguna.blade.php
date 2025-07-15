<!-- Modal Edit Pasien -->
<div id="edit-{{ $user->id }}" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 justify-center items-center bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900">Edit Pasien</h3>
                <button type="button"
                    class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8"
                    data-modal-hide="edit-{{ $user->id }}">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13" />
                    </svg>
                    <span class="sr-only">Tutup</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.users.pengguna.update', $user->id) }}" enctype="multipart/form-data"
                class="p-4 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="w-full border rounded-lg px-3 py-2"
                        value="{{ $user->nama_lengkap }}" required>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" class="w-full border rounded-lg px-3 py-2"
                        value="{{ $user->username }}" required>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full border rounded-lg px-3 py-2"
                        value="{{ $user->email }}">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="w-full border rounded-lg px-3 py-2"
                        value="{{ $user->tanggal_lahir }}">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border rounded-lg px-3 py-2">
                        <option value="">Pilih</option>
                        <option value="L" {{ $user->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $user->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Foto Profil</label>
                    
                    @if ($user->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $user->gambar) }}" alt="Foto lama"
                                class="w-16 h-16 rounded-full object-cover">
                            <p class="text-xs text-gray-500 mt-1">Foto sebelumnya</p>
                        </div>
                    @endif

                    <input type="file" name="gambar" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Kata Sandi 
                        <span class="text-sm text-gray-500">(Kosongkan jika tidak ingin diubah)</span></label>
                    <input type="password" name="password" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div class="flex justify-end border-t pt-4">
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
