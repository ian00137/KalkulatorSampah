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
<body class="flex-center">
    <form class="flex bg-white mg-2 border-box pd-2 br-2 shadow  flex-column" style="min-height: 80%; width: 800px ; max-width: 900px;" action="/hasil" method="POST">
        @csrf
        <div class="flex-betwen flex-align gap-2">
            <h1 class="">Calculator Sampah</h1>
            <div class="flex gap-1">
                <button onclick="hapus()" class="mgt-1 bg-danger border-none pdy-2 pdx-3 br-2 button cl-white ft-bold" type="button">-</button>
                <button onclick="tambah()" class="mgt-1 bg-second border-none pdy-2 pdx-3 br-2 button cl-white ft-bold" type="button">+</button>
            </div>
        </div>
        <p class="mgt-2">Pilihlah jenis sampah anda dan masukkan jumlah berat sampah anda</p>
        
        <div id="itemContainer" class="mgt-3">
            <div class="calc-item w-100  of-hidden" style="border-bottom: 1px;">
                <select name="id[]" id="cid1" class="border-none w-100" id="itm">
                    @foreach ($data as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                <input class="pdy-2 pdx-3 border-box ft-center border-none" type="number" name="kg[]" id="ckg1" placeholder="KG" style="border-bottom: 1px !important;" min="1">
            </div>
        </div>
        
        <button class="mgt-4 bg-second border-none pd-2 br-6 button cl-white">Hitung!</button>
    </form>
    <script>
        let jml = 2;
        html = "";
        function tambah(){
            html = `
            <div id="item`+ jml +`" class="calc-item w-100 mgt-2 of-hidden" style="border-bottom: 1px;">
                <select name="id[]" class="border-none w-100">
                    @foreach ($data as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                <input class="pdy-2 pdx-3 border-box ft-center border-none" type="number" name="kg[]" placeholder="KG" style="border-bottom: 1px !important;" min="1">
            </div>
            `
            jml++;
            $("#itemContainer").append(html);
        }
        function hapus(){
            if(jml > 2){
                $("#item" + (jml-1)).remove();
                jml--;
            }
        }
    </script>
</body>
</html>