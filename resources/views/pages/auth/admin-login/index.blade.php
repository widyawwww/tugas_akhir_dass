<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health - Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/f74deb4653.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gradient-to-br from-[#176B84] to-[#176B84] min-h-screen p-6 flex items-center justify-center">

    {{-- Notifikasi SweetAlert --}}
    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ $errors->first() }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        </script>
    @endif

    <div class="w-full max-w-md p-6 bg-white rounded-2xl shadow-lg space-y-6 shadow-lg">
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-extrabold text-teal-700">Mental Health</h1>
            <p class="text-sm text-gray-500">Selamat datang, silakan masuk untuk melanjutkan</p>
        </div>

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" placeholder="Masukkan Email"
                class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none">
        </div>
        <div>
            <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Kata Sandi</label>
            <input type="password" name="password" id="password" placeholder="Masukkan Kata Sandi"
                class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none">
        </div>
        <button type="submit"
            class="w-full px-4 py-2 text-white bg-teal-600 hover:bg-teal-700 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-1">
            <i class="fa-solid fa-right-to-bracket mr-2"></i>Masuk
        </button>
    </form>

        <p class="text-sm text-center text-gray-600">
            Belum punya akun?
            <a href="{{ route('admin.register') }}" class="text-teal-600 hover:underline">Daftar di sini</a>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
