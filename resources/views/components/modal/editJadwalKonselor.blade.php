<!-- resources/views/components/modal/editJadwalKonselor.blade.php -->
@foreach($jadwal as $item)
<div id="modalEditJadwalKonselor-{{ $item->id }}" tabindex="-1"
    class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-y-auto h-full bg-black bg-opacity-50">
    <div class="relative w-full max-w-md bg-white rounded-lg shadow">
        <form action="{{ route('admin.jadwal-konselor.update', $item->id) }}" method="POST" class="p-4 space-y-4">
            @csrf
            @method('PUT')
            <h3 class="text-lg font-semibold mb-4">Edit Jadwal Konselor</h3>

            <!-- Konselor (readonly) -->
            <div>
                <label class="block mb-1 text-sm font-medium">Konselor</label>
                <input type="text" class="w-full border rounded p-2 bg-gray-100" value="{{ $item->konselor->nama_lengkap }}" readonly>
            </div>

            <!-- Tanggal (readonly) -->
            <div>
                <label class="block mb-1 text-sm font-medium">Tanggal Konsultasi</label>
                <input type="text" class="w-full border rounded p-2 bg-gray-100" value="{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}" readonly>
            </div>

            <!-- Slot Jam -->
            <div id="edit-slot-container-{{ $item->id }}">
                <label class="block mb-1 text-sm font-medium">Slot Jam</label>
                @foreach($item->slotJam as $slot)
                <div class="flex gap-2 slot-row mb-2">
                    <select name="jam_ids[]" class="w-full border p-2 rounded" required>
                        <option value="">-- Pilih Jam --</option>
                        @foreach($jam as $j)
                            <option value="{{ $j->id }}" {{ $slot->jam_id == $j->id ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button" class="remove-slot px-2 bg-red-500 text-white rounded">×</button>
                </div>
                @endforeach
            </div>

            <!-- Template slot -->
            <template id="edit-slot-template-{{ $item->id }}">
                <div class="flex gap-2 slot-row mb-2">
                    <select name="jam_ids[]" class="w-full border p-2 rounded" required>
                        <option value="">-- Pilih Jam --</option>
                        @foreach($jam as $j)
                            <option value="{{ $j->id }}">
                                {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button" class="remove-slot px-2 bg-red-500 text-white rounded">×</button>
                </div>
            </template>

            <button type="button" class="add-slot text-sm bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600"
                data-target="{{ $item->id }}">+ Tambah Slot</button>

            <div class="flex justify-end gap-2">
                <button type="button" data-modal-hide="modalEditJadwalKonselor-{{ $item->id }}"
                    class="bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.add-slot').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.getAttribute('data-target');
            const container = document.getElementById('edit-slot-container-' + id);
            const template = document.getElementById('edit-slot-template-' + id);
            const clone = template.content.cloneNode(true);
            container.appendChild(clone);
            bindRemove(container);
        });
    });

    function bindRemove(container) {
        container.querySelectorAll('.remove-slot').forEach(btn => {
            btn.onclick = () => btn.closest('.slot-row')?.remove();
        });
    }

    document.querySelectorAll('[id^="edit-slot-container-"]').forEach(container => bindRemove(container));
});
</script>
@endpush