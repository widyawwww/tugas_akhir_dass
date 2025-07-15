@extends('layouts.admin')

@section('content')
<main>
    <div class="p-4 sm:ml-64">
        <div class="space-y-4 rounded-lg mt-14">
            <div class="p-4 bg-white rounded-lg shadow-lg flex items-center">
                <p class="text-lg font-semibold">Dashboard</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
                {{-- Psikiater --}}
                <div class="p-4 bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-semibold">Psikiater</p>
                            <p class="text-xl font-semibold">{{ $jumlahPsikiater }}</p>
                        </div>
                        <div class="text-3xl font-semibold text-red-500">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                    </div>
                </div>

                {{-- Konselor --}}
                <div class="p-4 bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-semibold">Konselor</p>
                            <p class="text-xl font-semibold">{{ $jumlahKonselor }}</p>
                        </div>
                        <div class="text-3xl font-semibold text-green-500">
                            <i class="fa-solid fa-user-nurse"></i>
                        </div>
                    </div>
                </div>

                {{-- Tips --}}
                <div class="p-4 bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-semibold">Tips</p>
                            <p class="text-xl font-semibold">{{ $jumlahTips }}</p>
                        </div>
                        <div class="text-3xl font-semibold text-yellow-500">
                            <i class="fa-solid fa-lightbulb"></i>
                        </div>
                    </div>
                </div>

                {{-- Artikel --}}
                <div class="p-4 bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-semibold">Artikel</p>
                            <p class="text-xl font-semibold">{{ $jumlahArtikel }}</p>
                        </div>
                        <div class="text-3xl font-semibold text-blue-500">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                    </div>
                </div>

                {{-- Tes --}}
                <div class="p-4 bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-semibold">Tes</p>
                            <p class="text-xl font-semibold">{{ $jumlahTes }}</p>
                        </div>
                        <div class="text-3xl font-semibold text-purple-500">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
