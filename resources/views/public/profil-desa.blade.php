@extends('public.layouts.app')

@section('title', 'Profil Desa')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800">Profil Desa</h1>
        <p class="mt-4 text-gray-600">Informasi mengenai desa dan kelurahan...</p>

        <!-- Form Filter -->
        <form id="filterForm" class="mt-6 flex flex-wrap items-end gap-4" action=""{{ route('profil-desa') }}"
            method="GET">
            <div class="w-full md:w-auto">
                <label for="kecamatan" class="block text-gray-700 font-semibold">Kecamatan</label>
                <select id="kecamatan" name="kecamatan" class="w-full md:w-40 p-2 border rounded-md"
                    onchange="filterDesa()">
                    <option value="">Pilih Kecamatan</option>
                    @foreach ($kecamatanList as $kecamatan)
                        <option value="{{ $kecamatan->kdkec }}"
                            {{ request('kecamatan') == $kecamatan->kdkec ? 'selected' : '' }}>
                            {{ $kecamatan->nmkec }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-auto">
                <label for="desa" class="block text-gray-700 font-semibold">Desa</label>
                <select id="desa" name="desa" class="w-full md:w-40 p-2 border rounded-md" disabled>
                    <option value="">Pilih Desa</option>
                    @foreach ($desaList as $desa)
                        <option value="{{ $desa->iddesa }}" data-kecamatan="{{ $desa->kdkec }}" style="display: none;">
                            {{ $desa->nmdesa }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="w-full md:w-auto bg-green-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-green-700 transition duration-300">
                Tampilkan Data
            </button>
        </form>

        <!-- Navbar dan Konten Desa (Awalnya Disembunyikan) -->
        <div id="desa-content" class="{{ request('kecamatan') || request('desa') }}">
            <!-- Navbar -->
            <nav class="mt-6 bg-white shadow-md rounded-lg p-4 border border-gray-200">
                <ul class="flex flex-wrap justify-center gap-4 border-b">
                    <li><button
                            class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500"
                            data-target="profil-desa">Profil Desa</button></li>
                    <li><button
                            class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500"
                            data-target="perangkat-desa">Perangkat Desa</button></li>
                    <li><button
                            class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500"
                            data-target="keuangan">Keuangan</button></li>
                    <li><button
                            class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500"
                            data-target="bpd">BPD</button></li>
                    <li><button
                            class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500"
                            data-target="kelembagaan">Kelembagaan</button></li>
                    <li><button
                            class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500"
                            data-target="infrastruktur">Infrastruktur</button></li>
                    <li><button
                            class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500"
                            data-target="transparansi">Transparansi</button></li>
                    <li><button
                            class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500"
                            data-target="program-tidak-mampu">Program Tidak Mampu</button></li>
                </ul>
            </nav>

            <!-- Konten Desa -->
            <div id="profil-desa"
                class="content-section flex flex-col md:flex-row items-center bg-white shadow-md rounded-lg p-6 border border-gray-200 mt-6">
                <!-- Gambar Desa -->
                <div class="md:w-1/3 w-full">
                    <img src="{{ asset('images/desa.jpg') }}" alt="Profil Desa" class="w-full h-auto rounded-lg shadow-md">
                </div>

                <!-- Informasi Profil Desa -->
                <div class="md:w-2/3 w-full md:pl-6 mt-4 md:mt-0">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Profil Desa</h2>

                    @foreach ($profilDesas as $profilDesa)
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-700">Visi</h3>
                            <p class="text-gray-600">{{ $profilDesa->visi }}</p>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-700">Misi</h3>
                            <ul class="list-disc list-inside text-gray-600">
                                @foreach (explode("\n", $profilDesa->misi) as $misi)
                                    <li>{{ $misi }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-700">Program Unggulan</h3>
                            <ul class="list-disc list-inside text-gray-600">
                                @foreach (explode("\n", $profilDesa->program_unggulan) as $program)
                                    <li>{{ $program }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-700">Batas Wilayah</h3>
                            <p class="text-gray-600">{{ $profilDesa->batas_wilayah }}</p>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-700">Kontak</h3>
                            <p class="text-gray-600"><strong>Alamat:</strong> {{ $profilDesa->alamat }}</p>
                            <p class="text-gray-600"><strong>Telepon:</strong> {{ $profilDesa->kontak }}</p>
                        </div>
                    @endforeach

                </div>
            </div>

            {{-- PERANGKAT DESA --}}
            <div id="perangkat-desa" class="content-section hidden mt-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Perangkat Desa</h1>

                <div class="relative bg-gray-100 p-6 rounded-lg shadow-md">
                    <!-- Wrapper untuk Scroll Horizontal di Mobile -->
                    <div class="overflow-x-auto scroll-smooth scrollbar-hide p-2">
                        <div class="flex space-x-4 md:grid md:grid-cols-3 lg:grid-cols-4 md:gap-6">
                            @if (empty($perangkat))
                                <!-- Template Kosong dengan Style Tetap -->
                                <div class="min-w-[250px] md:w-full bg-white shadow-md rounded-xl overflow-hidden p-4">
                                    <div class="bg-gray-200 rounded-lg flex items-center justify-center h-56">
                                        <span class="text-gray-500">Foto</span>
                                    </div>
                                    <div class="p-4 text-center space-y-1">
                                        <h3 class="text-lg font-bold text-gray-400 leading-tight">nama
                                        </h3>
                                        <p class="text-gray-400 text-sm leading-tight">jabatan</p>
                                    </div>
                                </div>
                                <p class="text-gray-500 mt-4 text-center w-full">Belum ada data perangkat desa. Silakan
                                    tambahkan melalui panel admin.</p>
                            @else
                                @foreach ($perangkat as $p)
                                    <div class="min-w-[250px] md:w-full bg-white shadow-md rounded-xl overflow-hidden p-4">
                                        <div class="bg-gray-100 rounded-lg overflow-hidden">
                                            <img src="{{ asset('images/' . $p['foto']) }}" alt="{{ $p['nama'] }}"
                                                class="w-full h-56 object-cover">
                                        </div>
                                        <div class="p-4 text-center space-y-1">
                                            <h3 class="text-lg font-bold text-gray-800 leading-tight">{{ $p['nama'] }}
                                            </h3>
                                            <p class="text-gray-600 text-sm leading-tight">{{ $p['jabatan'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div id="keuangan" class="content-section hidden mt-6">
                <!-- Ringkasan Pendapatan dan Belanja -->
                <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Ringkasan Keuangan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Pendapatan -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-green-800">Pendapatan</h3>
                            <p class="text-2xl font-bold text-green-800 mt-2">
                                Rp {{ number_format(array_sum(array_column($keuangan, 'pendapatan')), 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-600">Total pendapatan desa.</p>
                        </div>
                        <!-- Belanja -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-blue-800">Belanja</h3>
                            <p class="text-2xl font-bold text-blue-800 mt-2">
                                Rp {{ number_format(array_sum(array_column($keuangan, 'belanja')), 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-600">Total belanja desa.</p>
                        </div>
                    </div>
                </div>

                <!-- Rincian Pendapatan -->
                <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Rincian Pendapatan</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 border-b text-left">Sumber Pendapatan</th>
                                    <th class="py-2 px-4 border-b text-left">Jumlah (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($keuangan as $item)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $item['sumber_pendapatan'] ?? 'N/A' }}</td>
                                        <td class="py-2 px-4 border-b">
                                            {{ number_format($item['pendapatan'] ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="py-2 px-4 border-b text-center text-gray-500">Belum ada
                                            data pendapatan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Rincian Pembelanjaan -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Rincian Pembelanjaan</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 border-b text-left">Jenis Belanja</th>
                                    <th class="py-2 px-4 border-b text-left">Jumlah (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($keuangan as $item)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $item['jenis_belanja'] ?? 'N/A' }}</td>
                                        <td class="py-2 px-4 border-b">
                                            {{ number_format($item['belanja'] ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="py-2 px-4 border-b text-center text-gray-500">Belum ada
                                            data belanja.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div id="infrastruktur" class="content-section hidden">
    <h1 class="text-3xl font-bold text-gray-800">Infrastruktur</h1>
    <p class="mt-4 text-gray-600">Informasi mengenai infrastruktur desa...</p>

    <table class="mt-6 w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 p-2 text-left">Kategori</th>
                <th class="border border-gray-300 p-2 text-left">Nilai</th>
                <th class="border border-gray-300 p-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-gray-300 p-2">Jumlah Jembatan</td>
                <td class="border border-gray-300 p-2">12</td>
                <td class="border border-gray-300 p-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Lihat Detail</button>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Tempat Pembuangan Sampah</td>
                <td class="border border-gray-300 p-2">-</td>
                <td class="border border-gray-300 p-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Lihat Detail</button>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Kapasitas</td>
                <td class="border border-gray-300 p-2">0</td>
                <td class="border border-gray-300 p-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Lihat Detail</button>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Kapasitas</td>
                <td class="border border-gray-300 p-2">3</td>
                <td class="border border-gray-300 p-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Lihat Detail</button>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Jumlah Pasar</td>
                <td class="border border-gray-300 p-2">0</td>
                <td class="border border-gray-300 p-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Lihat Detail</button>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Jumlah Jalan Desa</td>
                <td class="border border-gray-300 p-2">26</td>
                <td class="border border-gray-300 p-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Lihat Detail</button>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Jumlah Jalan Kabupaten</td>
                <td class="border border-gray-300 p-2">1</td>
                <td class="border border-gray-300 p-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Lihat Detail</button>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Jumlah Irigasi</td>
                <td class="border border-gray-300 p-2">22</td>
                <td class="border border-gray-300 p-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Lihat Detail</button>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Jumlah Pusat Perdagangan</td>
                <td class="border border-gray-300 p-2">0</td>
                <td class="border border-gray-300 p-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Lihat Detail</button>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Jumlah Rumah Potong Hewan</td>
                <td class="border border-gray-300 p-2">0</td>
                <td class="border border-gray-300 p-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Lihat Detail</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

        <div id="transparansi" class="content-section hidden">
            <h1 class="text-3xl font-bold text-gray-800">Transparansi</h1>
            <p class="mt-4 text-gray-600">Informasi transparansi desa...</p>
        </div>

        <div id="program-tidak-mampu" class="content-section hidden">
            <h1 class="text-3xl font-bold text-gray-800">Program Tidak Mampu</h1>
            <p class="mt-4 text-gray-600">Informasi mengenai program untuk warga tidak mampu...</p>
        </div>
    </div>

    @if (!request()->has('kecamatan') && !request()->has('desa') && !request()->has('tahun'))
    <!-- Bagian Visi dan Misi Desa -->
    <div class="mt-12 p-6 bg-white shadow-lg rounded-lg border border-gray-200">
        <h2 class="text-2xl font-bold text-green-800 text-center">Visi dan Misi Kabupaten</h2>
        <div class="mt-6 flex flex-col md:flex-row items-center gap-6">
            <div class="w-full md:w-1/2">
                <img src="{{ asset('images/kantorbbs.jpg') }}" alt="Visi dan Misi" class="w-full rounded-lg shadow-md">
            </div>
            <div class="w-full md:w-1/2 space-y-4">
                <div class="bg-gradient-to-r from-green-100 to-green-300 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-green-900">Visi</h3>
                    <p class="text-gray-800 mt-2 italic">
                        "Mewujudkan desa yang maju, mandiri, dan sejahtera berbasis kearifan lokal serta partisipasi
                        masyarakat."
                    </p>
                </div>
                <div class="bg-gradient-to-r from-gray-100 to-gray-300 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-green-900">Misi</h3>
                    <ul class="list-disc list-inside text-gray-800 mt-2 space-y-1">
                        <li>Meningkatkan kesejahteraan masyarakat melalui pembangunan ekonomi.</li>
                        <li>Memperkuat nilai budaya dan kearifan lokal.</li>
                        <li>Meningkatkan kualitas pendidikan dan kesehatan.</li>
                        <li>Membangun infrastruktur desa yang berkelanjutan.</li>
                        <li>Meningkatkan partisipasi aktif masyarakat dalam pembangunan desa.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Wilayah -->
    <div class="mt-8 p-4 bg-gray-100 shadow-lg rounded-lg border border-gray-200">
        <h2 class="text-xl font-bold text-green-800 text-center">Informasi Wilayah</h2>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <div class="flex justify-center">
                <img src="{{ asset('images/petabbs.png') }}" alt="Peta Wilayah" class="max-w-[250px] max-h-[250px] w-full h-auto rounded-lg shadow-md object-cover">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="bg-white p-3 rounded-lg shadow-md text-center flex flex-col items-center">
                    <img src="{{ asset('icons/map.png') }}" alt="Luas Wilayah" class="w-8 h-8 mb-1">
                    <h3 class="text-base font-semibold text-gray-700">Luas Wilayah</h3>
                    <p class="text-sm text-gray-600">150 km²</p>
                </div>
                <div class="bg-white p-3 rounded-lg shadow-md text-center flex flex-col items-center">
                    <img src="{{ asset('icons/kec.png') }}" alt="Jumlah Kecamatan" class="w-8 h-8 mb-1">
                    <h3 class="text-base font-semibold text-gray-700">Jumlah Kecamatan</h3>
                    <p class="text-sm text-gray-600">10 Kecamatan</p>
                </div>
                <div class="bg-white p-3 rounded-lg shadow-md text-center flex flex-col items-center">
                    <img src="{{ asset('icons/residential.png') }}" alt="Jumlah Desa" class="w-8 h-8 mb-1">
                    <h3 class="text-base font-semibold text-gray-700">Jumlah Desa</h3>
                    <p class="text-sm text-gray-600">50 Desa</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
    function openModal() {
        const modal = document.getElementById('modal');
        modal.classList.remove('hidden'); // Menghapus 'hidden' untuk menampilkan modal
        modal.classList.add('flex'); // Menambahkan 'flex' untuk memposisikan modal di tengah
    }

    function closeModal() {
        const modal = document.getElementById('modal');
        modal.classList.remove('flex'); // Menghapus 'flex'
        modal.classList.add('hidden'); // Menambahkan 'hidden' untuk menyembunyikan modal
    }



    document.addEventListener("DOMContentLoaded", function() {
        const scrollContainer = document.getElementById("scrollContainer");

        scrollContainer.addEventListener("wheel", function(event) {
            event.preventDefault();
            scrollContainer.scrollLeft += event.deltaY;
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".nav-button");
        const sections = document.querySelectorAll(".content-section");

        buttons.forEach(button => {
            button.addEventListener("click", function() {
                const target = this.getAttribute("data-target");

                sections.forEach(section => {
                    section.classList.add("hidden");
                });

                document.getElementById(target).classList.remove("hidden");
            });
        });

        // Tampilkan konten desa jika ada parameter di URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('kecamatan') || urlParams.has('desa') || urlParams.has('tahun')) {
            document.getElementById('desa-content').classList.remove('hidden');
        }
    });

    document.getElementById("filterForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Mencegah form mengirim request ke server langsung

        // Ambil nilai dari dropdown
        const kecamatan = document.getElementById("kecamatan").value;
        const desa = document.getElementById("desa").value;
        const tahun = document.getElementById("tahun").value;

        // Bangun query parameter
        let params = new URLSearchParams();
        if (kecamatan) params.append("kecamatan", kecamatan);
        if (desa) params.append("desa", desa);
        if (tahun) params.append("tahun", tahun);

        // Redirect ke URL dengan query parameter tanpa berpindah route
        window.location.href = "/profil-desa?" + params.toString();
    });
</script>
@endsection
