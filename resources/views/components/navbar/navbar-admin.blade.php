<!-- resources/views/components/navbar/navbar-admin.blade.php -->
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      {{-- Sidebar toggle & branding --}}
      <div class="flex items-center justify-start">
        <button type="button"
          class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
          <span class="sr-only">Open sidebar</span>
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path clip-rule="evenodd" fill-rule="evenodd"
              d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
          </svg>
        </button>
        <a href="#" class="flex ms-2 md:me-24">
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">Mental Health - Admin</span>
        </a>
      </div>

      {{-- Avatar & Dropdown --}}
      <div class="flex items-center">
        <div class="relative flex items-center ms-3">
          <div>
            <button id="dropdownUserButton" type="button"
              class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300"
              aria-expanded="false">
              <span class="sr-only">Open user menu</span>
              <img class="w-10 h-10 rounded-full object-cover cursor-pointer"
                src="{{ asset('storage/' . Auth::guard('admin')->user()->gambar) }}"
                alt="Gambar Admin">
            </button>
          </div>

          {{-- Dropdown --}}
          <div class="absolute right-0 top-full mt-2 z-50 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow"
            id="dropdown-user">
            <div class="px-4 py-3">
              <p class="text-sm text-gray-900">{{ Auth::guard('admin')->user()->name }}</p>
              <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::guard('admin')->user()->email }}</p>
            </div>
            <ul class="py-1">
              <li>
                <form method="POST" action="{{ route('admin.logout') }}">
                  @csrf
                  <button type="submit"
                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Keluar
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>

{{-- Toggle Dropdown Script --}}
<script>
  document.getElementById('dropdownUserButton').addEventListener('click', function () {
    const dropdown = document.getElementById('dropdown-user');
    dropdown.classList.toggle('hidden');
  });

  window.addEventListener('click', function (e) {
    const button = document.getElementById('dropdownUserButton');
    const dropdown = document.getElementById('dropdown-user');
    if (!button.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.classList.add('hidden');
    }
  });
</script>

<aside id="logo-sidebar"
    class="fixed top-16 left-0 z-40 w-64 h-[calc(100vh-4rem)] pt-4 transition-transform bg-white border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="#"
                    class="flex items-center p-2 rounded-lg bg-blue-500 text-white">
                    <i class="fa-solid fa-house"></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            <li>
                <button type="button"
                    class="flex items-center justify-between w-full p-2 rounded-lg hover:bg-blue-200 hover:text-white {{ Request::is('admin/pengguna/*') ? 'bg-blue-500 text-white' : '' }}"
                    data-collapse-toggle="dropdown-users">
                    <span class="flex items-center">
                        <i class="fa-solid fa-users me-2"></i> Pengguna
                    </span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>

                <ul id="dropdown-users" class="{{ Request::is('admin/pengguna/*') ? 'block' : 'hidden' }} py-2 space-y-2">
                    <li>
                        <a href="{{ route('admin.daftar-pengguna.admin') }}"
                            class="flex gap-1 items-center w-full p-2 pl-11 rounded-lg hover:bg-blue-200 hover:text-white {{ request()->routeIs('admin.daftar-pengguna.admin') ? 'bg-blue-500 text-white' : '' }}">
                            <i class="fa-solid fa-user"></i>
                            <span class="ms-3">Admin</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.daftar-pengguna.psikiater') }}"
                            class="flex gap-1 items-center w-full p-2 pl-11 rounded-lg hover:bg-blue-200 hover:text-white {{ request()->routeIs('admin.daftar-pengguna.psikiater') ? 'bg-blue-500 text-white' : '' }}">
                            <i class="fa-solid fa-user"></i>
                            <span class="ms-3">Psikiater</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.daftar-pengguna.konselor') }}"
                            class="flex gap-1 items-center w-full p-2 pl-11 rounded-lg hover:bg-blue-200 hover:text-white {{ request()->routeIs('admin.daftar-pengguna.konselor') ? 'bg-blue-500 text-white' : '' }}">
                            <i class="fa-solid fa-user"></i>
                            <span class="ms-3">Konselor</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.daftar-pengguna.pengguna') }}"
                            class="flex gap-1 items-center w-full p-2 pl-11 rounded-lg hover:bg-blue-200 hover:text-white {{ request()->routeIs('admin.daftar-pengguna.pengguna') ? 'bg-blue-500 text-white' : '' }}">
                            <i class="fa-solid fa-user"></i>
                            <span class="ms-3">Pengguna</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('admin.artikel.index') }}"
                    class="flex items-center p-2 rounded-lg hover:bg-blue-200 hover:text-white {{ request()->routeIs('admin.articles.index') ? 'bg-blue-500 text-white' : '' }}">
                    <i class="fas fa-book-open me-2"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Artikel</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.tips.index') }}"
                    class="flex items-center p-2 rounded-lg hover:bg-blue-200 hover:text-white {{ request()->routeIs('admin.tips.index') ? 'bg-blue-500 text-white' : '' }}">
                    <i class="fas fa-book-open me-2"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Tips Kesehatan Mental</span>
                </a>
            </li>
            {{-- <li><a href="#" class="flex items-center p-2 rounded-lg hover:bg-blue-200"><i class="fa-solid fa-question-circle me-2"></i><span class="ms-3">Konseling</span></a></li> --}}
            <li>
                <a href="{{ route('admin.instrumen-tes.index') }}"
                    class="flex items-center p-2 rounded-lg hover:bg-blue-200 hover:text-white {{ request()->routeIs('admin.instrumen-tes.index') ? 'bg-blue-500 text-white' : '' }}">
                    <i class="fa-regular fa-file-lines me-2"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Instrumen Tes</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="flex items-center justify-between w-full p-2 rounded-lg hover:bg-blue-200 hover:text-white"
                    data-collapse-toggle="dropdown-pemesanan">
                    <span class="flex items-center">
                        <i class="fa-solid fa-calendar-check me-2"></i> Data Pemesanan Konsultasi
                    </span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>

                <ul id="dropdown-pemesanan" class="py-2 space-y-2">
                    <li>
                        <a href="{{ route('admin.pemesanan-psikiater.index') }}"
                            class="flex gap-1 items-center w-full p-2 pl-11 rounded-lg hover:bg-blue-200 hover:text-white">
                            <i class="fa-solid fa-user"></i>
                            <span class="ms-3">Psikiater</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pemesanan-konselor.index') }}"
                            class="flex gap-1 items-center w-full p-2 pl-11 rounded-lg hover:bg-blue-200 hover:text-white">
                            <i class="fa-solid fa-user"></i>
                            <span class="ms-3">Konselor</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button"
                    class="flex items-center justify-between w-full p-2 rounded-lg hover:bg-blue-200 hover:text-white"
                    data-collapse-toggle="dropdown-konsultasi">
                    <span class="flex items-center">
                        <i class="fa-solid fa-users me-2"></i> Jadwal Konsultasi
                    </span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>

                <ul id="dropdown-konsultasi" class="py-2 space-y-2">
                    <li>
                        <a href="{{ route('admin.atur-jam.index') }}"
                            class="flex gap-1 items-center w-full p-2 pl-11 rounded-lg hover:bg-blue-200 hover:text-white">
                            <i class="fa-solid fa-user"></i>
                            <span class="ms-3">Atur Jam Konsultasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.jadwal-psikiater.index') }}"
                            class="flex gap-1 items-center w-full p-2 pl-11 rounded-lg hover:bg-blue-200 hover:text-white">
                            <i class="fa-solid fa-user"></i>
                            <span class="ms-3">Psikiater</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.jadwal-konselor.index') }}"
                            class="flex gap-1 items-center w-full p-2 pl-11 rounded-lg hover:bg-blue-200 hover:text-white">
                            <i class="fa-solid fa-user"></i>
                            <span class="ms-3">Konselor</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>

