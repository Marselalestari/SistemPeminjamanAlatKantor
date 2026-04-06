<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran - {{ $peminjaman->id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            display: flex; justify-content: center; align-items: flex-start;
            min-height: 100vh; margin: 0; padding: 40px 20px;
        }

        .struk {
            max-width: 450px; width: 100%;
            background: white; padding: 30px; border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            border: 1px solid #e1e4e8;
        }

        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; font-size: 20px; color: #1a1a1a; text-transform: uppercase; }
        .header p { margin: 4px 0; font-size: 12px; color: #666; }

        .info-peminjam {
            font-size: 12px; color: #444; 
            margin-bottom: 15px; padding-bottom: 10px; 
            border-bottom: 1px solid #eee;
        }

        /* Tabel Barang */
        .tabel-barang {
            width: 100%; border-collapse: collapse; margin-top: 10px;
            font-size: 13px;
        }
        .tabel-barang th {
            text-align: left; border-bottom: 2px solid #333;
            padding: 10px 5px; color: #333;
        }
        .tabel-barang td { padding: 8px 5px; border-bottom: 1px dashed #eee; }
        
        .section-title {
            background: #f4f4f4; font-size: 11px; font-weight: bold;
            padding: 5px; text-transform: uppercase; color: #555;
        }

        .nama-item { font-weight: 600; display: block; }
        .detail-item { font-size: 11px; color: #777; }

        /* Form Section */
        .input-section {
            background: #f8fafc; padding: 15px; border-radius: 10px;
            margin: 20px 0; border: 1px solid #e2e8f0;
        }
        .input-group { margin-bottom: 12px; }
        .input-group label { display: block; font-size: 11px; font-weight: 700; margin-bottom: 4px; color: #475569; }
        input {
            width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1;
            border-radius: 6px; font-size: 14px;
        }

        .summary { margin-top: 15px; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 14px; }
        .total-akhir {
            margin-top: 10px; padding-top: 10px;
            border-top: 2px solid #333; font-weight: 800; font-size: 18px;
        }

        .btn-container { margin-top: 25px; display: grid; gap: 10px; }
        .btn { padding: 12px; border-radius: 8px; cursor: pointer; font-weight: 700; border: none; }
        .btn-save { background: #2563eb; color: white; }
        .btn-print { background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; }

        @media print {
            body { background: white; padding: 0; }
            .struk { box-shadow: none; border: none; max-width: 100%; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

<div class="struk">
    <div class="header">
        <h2>PERPUSTAKAAN JAYA</h2>
        <p>Invoice: #{{ $peminjaman->id }}</p>
    </div>

    <div class="info-peminjam">
        <div><strong>Peminjam:</strong> {{ $peminjaman->user->name ?? 'Umum' }}</div>
        <div><strong>Tanggal:</strong> {{ date('d/m/Y H:i') }}</div>
    </div>

    <table class="tabel-barang">
        <thead>
            <tr>
                <th>DAFTAR PINJAMAN</th>
                <th style="text-align: center;">QTY</th>
                <th style="text-align: right;">STATUS</th>
            </tr>
        </thead>
        <tbody>
            @if($peminjaman->alat)
            <tr>
                <td>
                    <span class="nama-item">{{ $peminjaman->alat->nama_alat ?? 'Barang Tidak Diketahui' }}</span>
                    <span class="detail-item">ID: {{ $peminjaman->alat->id ?? '-' }}</span>
                </td>
                <td style="text-align: center;">{{ $peminjaman->jumlah ?? 1 }}</td>
                <td style="text-align: right;">Dipinjam</td>
            </tr>
            @else
            <tr>
                <td colspan="3" style="text-align: center; color: #999; padding: 20px 5px;">
                    Alat tidak ditemukan
                </td>
            </tr>
            @endif

            <tr><td colspan="3" class="section-title">Rincian Pembayaran</td></tr>
            
           
            
            <tr id="row_manual" style="display: none;">
                <td>
                    <span class="nama-item">Denda Tambahan</span>
                    <span class="detail-item">Manual</span>
                </td>
                <td style="text-align: center;">1</td>
                <td style="text-align: right;" id="txt_manual">Rp 0</td>
            </tr>

            <tr id="row_kerusakan" style="display: none;">
                <td>
                    <span class="nama-item">Denda Kerusakan</span>
                    <span class="detail-item">Fisik</span>
                </td>
                <td style="text-align: center;" id="qty_kerusakan_display">0</td>
                <td style="text-align: right;" id="txt_kerusakan">Rp 0</td>
            </tr>
        </tbody>
    </table>

    <form action="{{ route('operator.peminjaman.simpan-denda-struk', $peminjaman) }}" method="POST">
        @csrf
        
        <div class="input-section no-print">
            <div class="input-group">
                <label>Denda Tambahan (Rp)</label>
                <input type="text" id="in_manual" name="denda_manual" placeholder="0" oninput="formatRupiah(this); hitung()">
            </div>

            <div style="display: flex; gap: 10px;">
                <div class="input-group" style="flex: 1;">
                    <label>Qty Rusak</label>
                    <input type="number" id="in_qty_kerusakan" name="qty_kerusakan" value="0" min="0" oninput="hitung()">
                </div>
                <div class="input-group" style="flex: 2;">
                    <label>Harga per Unit (Rp)</label>
                    <input type="text" id="in_harga_kerusakan" name="harga_kerusakan" placeholder="0" oninput="formatRupiah(this); hitung()">
                </div>
            </div>

            <div class="input-group">
                <label>Uang Bayar (Rp)</label>
                <input type="text" id="in_bayar" name="bayar" placeholder="Rp 0" oninput="formatRupiah(this); hitung()" style="border-color: #2563eb;">
            </div>
        </div>

        <div class="summary">
            <div class="summary-row total-akhir">
                <span>TOTAL</span>
                <span id="total_akhir">Rp 0</span>
            </div>
            <div class="summary-row" style="color: #666; margin-top: 5px;">
                <span>DIBAYAR</span>
                <span id="txt_bayar">Rp 0</span>
            </div>
            <div class="summary-row" style="font-weight: bold; color: #2563eb;">
                <span>KEMBALI</span>
                <span id="txt_kembali">Rp 0</span>
            </div>
        </div>

        <div class="btn-container no-print">
            <button type="submit" class="btn btn-save">SIMPAN TRANSAKSI</button>
            <button type="button" onclick="window.print()" class="btn btn-print">CETAK STRUK</button>
        </div>
    </form>

    <div class="header" style="margin-top: 30px; border-top: 1px dashed #ccc; padding-top: 15px;">
        <p>Simpan struk ini sebagai bukti pengembalian.</p>
    </div>
</div>

<script>
function formatRupiah(input){
    let angka = input.value.replace(/\D/g,'');
    input.value = angka ? 'Rp ' + new Intl.NumberFormat('id-ID').format(angka) : '';
}

function getAngka(val){
    return parseInt(val.replace(/\D/g,'')) || 0;
}

function hitung(){
    const dendaSistem = {{ $peminjaman->denda ?? 0 }};
    const manual = getAngka(document.getElementById('in_manual').value);
    const qtyRusak = parseInt(document.getElementById('in_qty_kerusakan').value) || 0;
    const hargaRusak = getAngka(document.getElementById('in_harga_kerusakan').value);
    const bayar = getAngka(document.getElementById('in_bayar').value);

    const totalKerusakan = qtyRusak * hargaRusak;
    const grandTotal = dendaSistem + manual + totalKerusakan;
    const kembali = bayar - grandTotal;

    // Preview Tabel
    document.getElementById('row_manual').style.display = manual > 0 ? 'table-row' : 'none';
    document.getElementById('txt_manual').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(manual);
    document.getElementById('row_kerusakan').style.display = totalKerusakan > 0 ? 'table-row' : 'none';
    document.getElementById('qty_kerusakan_display').innerText = qtyRusak;
    document.getElementById('txt_kerusakan').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalKerusakan);

    // Summary
    document.getElementById('total_akhir').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal);
    document.getElementById('txt_bayar').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(bayar);
    document.getElementById('txt_kembali').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(kembali > 0 ? kembali : 0);
}

document.addEventListener('DOMContentLoaded', hitung);
</script>

</body>
</html>