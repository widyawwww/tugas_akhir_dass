<div id="modalEditSubskala{{ $subskala->id }}" tabindex="-1"
     class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-y-auto h-full bg-black bg-opacity-50">
    <div class="relative w-full max-w-md bg-white rounded-lg shadow">
        <form action="{{ route('admin.instrumen-tes.subskala.update', $subskala->id) }}" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <h2 class="text-lg font-semibold text-gray-800">Edit Subskala</h2>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Subskala</label>
                <input type="text" name="nama" class="w-full border p-2 rounded"
                       value="{{ $subskala->nama }}" required>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded"
                        data-modal-hide="modalEditSubskala{{ $subskala->id }}">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</div>
