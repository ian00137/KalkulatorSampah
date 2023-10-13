<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator Sampah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/app.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="flex-center pd-2 border-box">
        <div class="bg-white br-2 br-solid-h" style="width: 900px; max-width:100%;">
            <div class="mgl-2 mgy-3">
                <h1 class="ft-capitalize">Hasil!</h1>
                <p>Berikut ini merupakan estimasi harga dari sampah anda</p>
            </div>
            <div class="of-scroll">
                <table class="w-100">
                    <thead>
                        <th class="ft-center">#</th>
                        <th>Jenis Sampah</th>
                        <th>Harga/kg</th>
                        <th>Jumlah(KG)</th>
                        <th>Total Harga</th>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                            $nmr = 1;
                            $kg = 0;
                        @endphp
                        @foreach ($hasil as $item)
                            <tr>
                                <td class="ft-center">{{ $nmr }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td>{{ number_format($item['harga'],0,',','.') }}</td>
                                <td>{{ $item['kg'] }}</td>
                                <td>Rp. {{ number_format($item['total'],0,',','.') }}</td>
                            </tr>
                            @php
                                $kg += $item['kg'];
                                $total += $item['total'];
                                $nmr++;
                            @endphp
                        @endforeach
                        <tr>
                            <td class="ft-center">-</td>
                            <td>Jumlah</td>
                            <td>-</td>
                            <td>{{ $kg }}</td>
                            <td>Rp. {{ number_format($total,0,',','.') }}</td>
                        </tr>
                    </tbody>
                </table>    
            </div>
        </div>
</body>
</html>