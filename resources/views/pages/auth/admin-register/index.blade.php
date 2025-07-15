<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mental Health - Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/f74deb4653.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gradient-to-br from-[#176B84] to-[#176B84] min-h-screen p-6 flex items-center justify-center">

    {{-- Alert sukses dan error --}}
    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
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
                timerProgressBar: true
            });
        </script>
    @endif

    <div class="w-full max-w-md p-6 bg-white rounded-2xl shadow-lg space-y-6">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-teal-700">Daftar Akun</h1>
            <p class="text-sm text-gray-500 mt-1">Bergabunglah untuk menjaga kesehatan mental Anda</p>
        </div>
        <form action="{{ route('admin.register.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="username" class="block mb-1 text-sm font-medium text-gray-700">Username</label>
                <input type="username" name="username" placeholder="Masukkan Username"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg" required />
            </div>
            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" placeholder="Masukkan Email"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg" required />
            </div>
            <div>
                <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Kata Sandi</label>
                <input type="password" name="password" placeholder="Masukkan Kata Sandi"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg" required />
            </div>
            <div>
                <label for="password_confirmation" class="block mb-1 text-sm font-medium text-gray-700">Konfirmasi Sandi</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi Kata Sandi"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg" required />
            </div>
            <button type="submit"
                class="w-full px-4 py-2 text-white bg-teal-600 hover:bg-teal-700 rounded-lg">
                Daftar
            </button>
        </form>


        <p class="text-sm text-center text-gray-600">
            Sudah punya akun?
            <a href="{{ route('admin.login') }}" class="text-teal-600 hover:underline">Masuk di sini</a>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
