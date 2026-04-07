<x-app-layout>
    <div class="max-w-xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <div class="hidden print:block text-center mb-6">
            <h2 class="text-2xl font-bold uppercase tracking-tight">SIPAK-Media</h2>
            <p class="text-sm">Struk Pembayaran Denda #{{ $peminjaman->id }}</p>
            <p class="text-xs text-gray-500">{{ now()->format('d/m/Y H:i') }}</p>
            <hr class="mt-4 border-dashed border-gray-300">
        </div>

        <div class="struk-container bg-white p-6 rounded-xl shadow-lg border border-gray-200 print:shadow-none print:border-none">
            
            <div class="text-center mb-6 print:hidden">
                <h2 class="text-xl font-bold text-gray-800">SIPAK-Media</h2>
                <p class="text-sm text-gray-500">Invoice: #{{ $peminjaman->id }}</p>
            </div>

            <div class="border-b border-gray-100 pb-4 mb-4 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Peminjam:</span>
                    <span class="font-semibold">{{ $peminjaman->user->name ?? 'Umum' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Tanggal Transaksi:</span>
                    <span class="font-semibold">{{ date('d/m/Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Status:</span>
                    <span class="font-semibold uppercase text-blue-600">{{ $peminjaman->status }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Harusnya Dikembalikan:</span>
                    <span class="font-semibold">{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d/m/Y') }}</span>
                </div>
            </div>

            <table class="w-full text-sm mb-6">
                <thead>
                    <tr class="border-b-2 border-gray-800 text-left">
                        <th class="py-2">Item</th>
                        <th class="py-2 text-center">Qty</th>
                        <th class="py-2 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dashed divide-gray-200">
                    @if($peminjaman->alat)
                    <tr>
                        <td class="py-3">
                            <span class="font-medium block">{{ $peminjaman->alat->nama_alat }}</span>
                            <span class="text-xs text-gray-400">ID: {{ $peminjaman->alat->id }}</span>
                        </td>
                        <td class="text-center">1</td>
                        <td class="text-right text-gray-400 italic">Dipinjam</td>
                    </tr>
                    @endif

                    <tr class="bg-gray-50 print:bg-transparent">
                        <td colspan="3" class="py-1 px-2 text-[10px] font-bold uppercase text-gray-400">Rincian Denda</td>
                    </tr>

                    <tr>
                        <td class="py-2">Denda Keterlambatan</td>
                        <td class="text-center">1</td>
                        <td class="text-right">Rp {{ number_format($peminjaman->denda ?? 0, 0, ',', '.') }}</td>
                    </tr>

                    @if($peminjaman->denda_kerusakan > 0)
                    <tr>
                        <td class="py-2">Denda Kerusakan (dari DB)</td>
                        <td class="text-center">1</td>
                        <td class="text-right">Rp {{ number_format($peminjaman->denda_kerusakan, 0, ',', '.') }}</td>
                    </tr>
                    @endif

                    <tr id="row_manual" style="display: none;">
                        <td class="py-2">Denda Tambahan</td>
                        <td class="text-center">1</td>
                        <td class="text-right" id="txt_manual">Rp 0</td>
                    </tr>
                    <tr id="row_kerusakan" style="display: none;">
                        <td class="py-2">Denda Kerusakan (Manual)</td>
                        <td class="text-center" id="qty_kerusakan_display">0</td>
                        <td class="text-right" id="txt_kerusakan">Rp 0</td>
                    </tr>
                </tbody>
            </table>

            <form id="formDenda" action="{{ route('operator.peminjaman.simpan-denda-struk', $peminjaman) }}" method="POST" class="print:hidden space-y-4 bg-gray-50 p-4 rounded-lg mb-6 border border-gray-200">
                @csrf
                <input type="hidden" id="hd_denda_manual" name="denda_manual" value="0">
                <input type="hidden" id="hd_denda_kerusakan" name="denda_kerusakan" value="0">
                <input type="hidden" id="hd_total" name="total" value="0">
                <input type="hidden" id="hd_bayar" name="bayar" value="0">
                <input type="hidden" id="hd_kembali" name="kembali" value="0">
                
                <div class="grid grid-cols-1 gap-3">
                    <div>
                        <label class="text-[10px] font-bold uppercase text-gray-500">Denda Tambahan (Rp)</label>
                        <input type="text" id="in_manual" oninput="formatRupiah(this); hitung()" placeholder="Rp 0" class="w-full border-gray-300 rounded-md text-sm">
                    </div>
                    <div class="flex gap-2">
                        <div class="w-1/3">
                            <label class="text-[10px] font-bold uppercase text-gray-500">Qty Rusak</label>
                            <input type="number" id="in_qty_kerusakan" value="0" min="0" oninput="hitung()" class="w-full border-gray-300 rounded-md text-sm">
                        </div>
                        <div class="w-2/3">
                            <label class="text-[10px] font-bold uppercase text-gray-500">Harga per Unit (Rp)</label>
                            <input type="text" id="in_harga_kerusakan" oninput="formatRupiah(this); hitung()" placeholder="Rp 0" class="w-full border-gray-300 rounded-md text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold uppercase text-blue-600">Nominal Bayar (Tunai)</label>
                        <input type="text" id="in_bayar" oninput="formatRupiah(this); hitung()" placeholder="Rp 0" class="w-full border-blue-300 rounded-md text-sm font-bold bg-blue-50 focus:ring-blue-500">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="button" onclick="cetakDanSimpan()" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-bold transition shadow-md flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                        </svg>
                        CETAK & SIMPAN KE LAPORAN
                    </button>
                </div>
            </form>

            <div class="space-y-2 pt-4 border-t-2 border-gray-100">
                <div class="flex justify-between text-lg font-black">
                    <span>TOTAL</span>
                    <span id="total_akhir">Rp 0</span>
                </div>
                <div class="flex justify-between text-sm text-gray-600">
                    <span>DIBAYAR</span>
                    <span id="txt_bayar">Rp 0</span>
                </div>
                <div class="flex justify-between text-md font-bold text-blue-600">
                    <span>KEMBALI</span>
                    <span id="txt_kembali">Rp 0</span>
                </div>
            </div>

            {{-- INFO PERHITUNGAN DENDA --}}
            <div class="mt-6 p-3 bg-blue-50 border border-blue-200 rounded-lg text-[11px] text-blue-800 space-y-1 print:hidden">
                <p class="font-bold">📌 INFO DENDA KETERLAMBATAN:</p>
                @php
                    $tanggalKembaliSebenarnya = now();
                    $tanggalKembaliHarusnya = \Carbon\Carbon::parse($peminjaman->tanggal_kembali);
                    $hari = $tanggalKembaliHarusnya->diffInDays($tanggalKembaliSebenarnya);
                    $tarif = 10000;
                @endphp
                <p>• Tarif: Rp {{ number_format($tarif, 0, ',', '.') }}/hari/unit</p>
                <p>• Tanggal Kembali Terjadwal: {{ $tanggalKembaliHarusnya->format('d/m/Y') }}</p>
                <p>• Hari Ini: {{ $tanggalKembaliSebenarnya->format('d/m/Y') }}</p>
                @if($hari > 0)
                <p class="font-bold text-red-600">• Keterlambatan: {{ $hari }} hari × {{ $peminjaman->jumlah }} unit = <span class="underline">Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}</span></p>
                @else
                <p class="text-green-600">• Status: ✅ TEPAT WAKTU (Tidak ada denda)</p>
                @endif
            </div>

            <div class="mt-8 text-center text-[10px] text-gray-400 uppercase tracking-widest border-t border-dashed pt-4">
                *** Bukti Pembayaran Sah ***
            </div>
        </div>
    </div>

    <script>
        // Fungsi memformat input angka menjadi format Rupiah saat mengetik
        function formatRupiah(input){
            let angka = input.value.replace(/\D/g,'');
            input.value = angka ? 'Rp ' + new Intl.NumberFormat('id-ID').format(angka) : '';
        }

        // Fungsi mengambil angka murni dari string format Rupiah
        function getAngka(val){ 
            if(!val) return 0;
            return parseInt(val.replace(/\D/g,'')) || 0; 
        }

        // Fungsi utama perhitungan otomatis
        function hitung(){
            // Denda dari database
            const dendaSistemKeterlambatan = {{ $peminjaman->denda ?? 0 }};
            const dendaSistemKerusakan = {{ $peminjaman->denda_kerusakan ?? 0 }};
            
            // Denda manual dari input form operator
            const manual = getAngka(document.getElementById('in_manual').value);
            const qtyRusak = parseInt(document.getElementById('in_qty_kerusakan').value) || 0;
            const hargaRusak = getAngka(document.getElementById('in_harga_kerusakan').value);
            const bayar = getAngka(document.getElementById('in_bayar').value);

            const totalKerusakan = qtyRusak * hargaRusak;
            
            // Grand Total = Denda dari DB + Denda Manual
            const grandTotal = dendaSistemKeterlambatan + dendaSistemKerusakan + manual + totalKerusakan;
            const kembali = bayar - grandTotal;

            // Masukkan nilai ke hidden input agar terkirim ke Controller
            document.getElementById('hd_denda_manual').value = manual;
            document.getElementById('hd_denda_kerusakan').value = Math.max(dendaSistemKerusakan, totalKerusakan);
            document.getElementById('hd_total').value = grandTotal;
            document.getElementById('hd_bayar').value = bayar;
            document.getElementById('hd_kembali').value = kembali > 0 ? kembali : 0;

            // Update baris denda manual di tabel
            document.getElementById('row_manual').style.display = manual > 0 ? 'table-row' : 'none';
            document.getElementById('txt_manual').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(manual);

            // Update baris denda kerusakan manual di tabel
            document.getElementById('row_kerusakan').style.display = totalKerusakan > 0 ? 'table-row' : 'none';
            document.getElementById('qty_kerusakan_display').innerText = qtyRusak;
            document.getElementById('txt_kerusakan').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalKerusakan);

            // Update teks ringkasan di bawah
            const fmt = (v) => 'Rp ' + new Intl.NumberFormat('id-ID').format(v);
            document.getElementById('total_akhir').innerText = fmt(grandTotal);
            document.getElementById('txt_bayar').innerText = fmt(bayar);
            document.getElementById('txt_kembali').innerText = fmt(kembali > 0 ? kembali : 0);
        }

        // Fungsi Cetak Browser lalu kirim data ke Database
        function cetakDanSimpan() {
            const bayar = getAngka(document.getElementById('in_bayar').value);
            const total = getAngka(document.getElementById('hd_total').value);

            if (bayar < total) {
                alert("Jumlah bayar masih kurang dari total denda!");
                return;
            }

            // 1. Trigger Print Browser
            window.print();
            
            // 2. Submit Form ke Controller setelah dialog cetak diproses
            setTimeout(() => {
                document.getElementById('formDenda').submit();
            }, 1000);
        }

        // Jalankan hitung saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', hitung);
    </script>

    <style>
        /* Pengaturan Layout Cetak */
        @media print {
            body { background: white !important; }
            nav, footer, .print\:hidden { display: none !important; }
            .struk-container { 
                width: 100% !important; 
                max-width: 100% !important; 
                margin: 0 !important; 
                box-shadow: none !important; 
                border: none !important;
                padding: 0 !important;
            }
        }
    </style>
</x-app-layout>