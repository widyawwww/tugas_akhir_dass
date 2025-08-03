<!-- layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mental Health</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/f74deb4653.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <style>
        .ql-editor ul { list-style-type: disc; padding-left: 1rem; color: #374151; }
        .ql-editor ol { list-style-type: decimal; padding-left: 1rem; color: #374151; }
        .ql-editor li { margin-bottom: 0.25rem; }
        #slot-container { display: block; }
        .slot-row { display: flex; gap: 1rem; margin-bottom: 0.5rem; }
    </style>
</head>
<body class="bg-gray-100">
    @include('components.navbar.navbar-admin')

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('scripts')
    @yield('scripts')
</body>
</html>
