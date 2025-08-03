<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/f74deb4653.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/trix@1.3.1/dist/trix.css">
    <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>
    <title>Mental Health</title>

    <style>
        .ql-editor ul {
            list-style-type: disc;
            padding-left: 1rem;
            color: #374151;
            /* text-gray-700 */
        }

        .ql-editor ol {
            list-style-type: decimal;
            padding-left: 1rem;
            color: #374151;
        }

        .ql-editor li {
            margin-bottom: 0.25rem;
        }

        #slot-container {
            display: block;
        }
        .slot-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body class="bg-gray-100">
    @include('components.navbar.navbar-admin')

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('scripts')
</body>

</html>