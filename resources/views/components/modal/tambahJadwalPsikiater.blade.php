<div id="modalTambahJadwalPsikiater" tabindex="-1"
    class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-y-auto h-full bg-black bg-opacity-50">
    <div class="relative w-full max-w-md bg-white rounded-lg shadow">
        <form action="{{ route('admin.jadwal-psikiater.store') }}" method="POST" class="p-4 space-y-4">
            @csrf
            <h3 class="text-lg font-semibold mb-4">Tambah Jadwal Psikiater</h3>

            <!-- Psikiater -->
            <div>
                <label class="block mb-1 text-sm font-medium">Psikiater</label>
                <select name="psikiater_id" class="w-full border p-2 rounded" required>
                    <option value="">-- Pilih Psikiater --</option>
                    @foreach ($psikiater as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal -->
            <div>
                <label class="block mb-1 text-sm font-medium">Tanggal Konsultasi</label>
                <input type="date" name="tanggal" class="w-full border rounded p-2" required>
            </div>

            <!-- Slot Jam -->
            <div id="slot-container">
                <label class="block mb-1 text-sm font-medium">Slot Jam</label>
                <div class="flex gap-2 slot-row mb-2">
                    <select name="jam_ids[]" class="w-full border p-2 rounded" required>
                        <option value="">-- Pilih Jam --</option>
                        @foreach ($jam as $j)
                            <option value="{{ $j->id }}">
                                {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button" class="remove-slot px-2 bg-red-500 text-white rounded">×</button>
                </div>
            </div>

            <template id="slot-template">
                <div class="flex gap-2 slot-row mb-2">
                    <select name="jam_ids[]" class="w-full border p-2 rounded" required>
                        <option value="">-- Pilih Jam --</option>
                        @foreach ($jam as $j)
                            <option value="{{ $j->id }}">
                                {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button" class="remove-slot px-2 bg-red-500 text-white rounded">×</button>
                </div>
            </template>

            <button type="button" id="add-slot" class="text-sm bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                + Tambah Slot
            </button>

            <div class="flex justify-end gap-2">
                <button type="button" data-modal-hide="modalTambahJadwalPsikiater"
                    class="bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('slot-container');
        const template = document.getElementById('slot-template');

        document.getElementById('add-slot').addEventListener('click', () => {
            const clone = template.content.cloneNode(true);
            container.appendChild(clone);
            bindRemove(container);
        });

        function bindRemove(container) {
            container.querySelectorAll('.remove-slot').forEach(btn => {
                btn.onclick = () => btn.closest('.slot-row')?.remove();
            });
        }

        bindRemove(container);
    });
</script>
@endpush
