<!DOCTYPE html>
<html>

<head>
    <title>Laporan Aset</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            margin-bottom: 0;
        }

        p {
            text-align: center;
            color: #555;
        }
    </style>
</head>

<body>
    <h2>LAPORAN DATA ASET PERUSAHAAN</h2>
    <p>Dicetak pada: {{ date('d F Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Tanggal Beli</th>
                <th>Harga (Rp)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assets as $asset)
                <tr>
                    <td>{{ $asset->asset_code }}</td>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->category->name ?? '-' }}</td>
                    <td>{{ $asset->location->name ?? '-' }}</td>
                    <td>{{ $asset->purchase_date->format('d/m/Y') }}</td>
                    <td>{{ number_format($asset->purchase_price, 0, ',', '.') }}</td>
                    <td>{{ strtoupper($asset->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
