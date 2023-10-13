<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="title">Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/app.css">
    <script src="/script.js"></script>
    <script src="/jquery.js"></script>
</head>
<body class="flex-center">
    @if (session('gagal'))
    <div class="pos-fixed w-100 flex-center " style="top: 0px; z-index: 100;">
        <div id="notif" class="shadow pos-fixed bg-white br-solid-h br-2 flex of-hidden mgx-2 notif" style="max-width: 500px;">
            <div class="bg-danger" style="width: 10px; min-height: 70px;">
            </div>
            <div class="flex-justify flex-column mgx-2" style="min-width: 250px;">
                <h3>Gagal</h3>
                <p>{{ session('gagal') }}</p>
            </div>
            <div class="flex-align mgr-2" >
                <button id="notif-button" class="border-none pd-2 br-6 button">Tutup (<b id="notif-timer">10</b>)</button>
            </div>
        </div>
    </div>
    @endif
    <form class="flex-column bg-white pd-3 shadow mg-2 br-4" style="width: 300px" action="" method="POST">
        @csrf
        <h1>Login</h1>
        <p>Silahkan login untuk melanjutkan sebagai admin</p>

        <input class="pdy-2 pdx-3 br-6 border mgt-4" type="text" name="username" placeholder="Username" autocomplete="off">
        <input class="pdy-2 pdx-3 br-6 border mgt-2" type="password" name="password" placeholder="Password" autocomplete="off">

        <button class="border-none pd-2 br-6 bg-second cl-white button mgt-4">LOGIN</button>

    </form>
    <script>
        $('#notif').ready(function(){
            let detik = 10;
            notifTimer = setInterval(function(){
                detik--;
                if(detik == -1){
                    $('#notif').css({
                        'opacity': '0',
                        'top' : '-40px'
                    });
                    clearInterval(notifTimer);
                    setTimeout(function(){
                        $('#notif').remove();
                    },800);
                }
                $('#notif-timer').html(detik);
            },1000);

            $('#notif-button').on('click',function(){
                $('#notif').css({
                    'opacity': '0',
                    'top' : '-40px'
                });
                clearInterval(notifTimer);
                setTimeout(function(){
                    $('#notif').remove();
                },800);
            });
        })
    </script>
</body>
</html>