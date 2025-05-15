<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/js/address-dropdown.js')
    @vite('resources/js/file-upload.js')
    <title>Document</title>
</head>
<body class="bg-gray-200">

    <header class="bg-white shadow">
        <div class="m-auto w-fit items-center px-3 py-2">
            <x-nav-link href="/dash" :active="request()->is('dashboard')">Dashboard</x-nav-link>
            >
            <x-nav-link  :active="request()->is('accreditation')">Guide</x-nav-link>
            >
            <x-nav-link  :active="request()->is('accreditation/form1')">Fill-Out Form</x-nav-link>
            >
            <x-nav-link  :active="request()->is('accreditation/form2')">Upload</x-nav-link>
            >
            <x-nav-link  :active="request()->is('accreditation/confirmation')">Confirmation</x-nav-link>
            >
            <x-nav-link  :active="request()->is('accreditation/success')">Success</x-nav-link>
        </div>
    </header>

{{ $slot }}
    
</body>
</html>