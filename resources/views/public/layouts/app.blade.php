<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Amongrasa - Aplikasi Monografi Desa')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto flex items-center justify-between flex-wrap">
            <!-- Nama Aplikasi dengan Link -->
            <a href="{{ url('/') }}" class="text-lg font-bold text-green-800">Amongrasa</a>

            <!-- Menu Navigasi -->
            <div class="flex flex-wrap md:flex-nowrap gap-2 md:gap-4 justify-center md:justify-end mt-2 md:mt-0">
                <a href="{{ route('profil-desa') }}" class="bg-green-700 text-white px-4 py-2 rounded-lg shadow-md font-semibold text-sm text-center">Profil Desa</a>
                <p class="bg-white px-4 py-2 rounded-lg shadow-md font-semibold text-gray-800 text-sm text-center">Desa Dalam Angka</p>
                <p class="bg-white px-4 py-2 rounded-lg shadow-md font-semibold text-gray-800 text-sm text-center">Desa Dalam Peta</p>
                <p class="bg-white px-4 py-2 rounded-lg shadow-md font-semibold text-gray-800 text-sm text-center">Desa Dalam Grafik</p>
                <p class="bg-white px-4 py-2 rounded-lg shadow-md font-semibold text-gray-800 text-sm text-center">Buku Monografi Desa</p>
                <p class="bg-white px-4 py-2 rounded-lg shadow-md font-semibold text-gray-800 text-sm text-center">Metadata</p>
                <p class="bg-white px-4 py-2 rounded-lg shadow-md font-semibold text-gray-800 text-sm text-center">Instrumen</p>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-6 p-4">
        @yield('content')
    </div>    
</body>
<script>
    function filterDesa() {
        var selectedKecamatan = document.getElementById("kecamatan").value;
        var desaDropdown = document.getElementById("desa");
        var options = desaDropdown.getElementsByTagName("option");

        if (selectedKecamatan === "") {
            desaDropdown.disabled = true;
            for (var i = 0; i < options.length; i++) {
                options[i].style.display = "none"; 
            }
        } else {
            desaDropdown.disabled = false;
            for (var i = 0; i < options.length; i++) {
                var kecamatanAttr = options[i].getAttribute("data-kecamatan");

                if (kecamatanAttr === selectedKecamatan) {
                    options[i].style.display = "";
                } else {
                    options[i].style.display = "none";
                }
            }
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        filterDesa();
    });
</script>


</html>
