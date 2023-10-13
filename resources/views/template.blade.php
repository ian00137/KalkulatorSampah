<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="title">KalkulatorSampah | Jenis</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/app.css">
    <script src="/script.js"></script>
    <script src="/jquery.js"></script>
</head>
<body>
    <div id="topContainer" style="position: fixed; top: 0; left: 0; z-index: 10;">

    </div>
    {{-- notifikasi --}}
    @if (session('sukses'))
    <div class="pos-fixed w-100 flex-center " style="top: 0px; z-index: 100;">
        <div id="notif" class="shadow pos-fixed bg-white br-solid-h br-2 flex of-hidden mgx-2 notif" style="max-width: 500px;">
            <div class="bg-safe" style="width: 10px; min-height: 70px;">
            </div>
            <div class="flex-justify flex-column mgx-2" style="min-width: 250px;">
                <h3>Sukses</h3>
                <p>{{ session('sukses') }}</p>
            </div>
            <div class="flex-align mgr-2" >
                <button id="notif-button" class="border-none pd-2 br-6 button">Tutup (<b id="notif-timer">10</b>)</button>
            </div>
        </div>
    </div>
    @endif
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
    <!-- navbar -->
    <nav class="navbar pos-fixed bg-white shadow w-100 flex-align flex-betwen" style="height: 70px; z-index: 9; top: 0;">
        <div class="flex h-100 flex-align mobile-hide">
            <div class="navbar-logo h-100 flex-center" style="background-color: rgba(0, 0, 0, 0.027);">
                <h1 class="ft-italic">KalkulatorSampah</h1>
            </div>
            <p><a class="ft-bold td-none mgl-2">Admin</a> / Jenis</p>
        </div>
        <div class="flex-align mgx-2">
            <div class="bg-in circle" style="height: 50px; width: 50px;"></div>
            <div class="flex-column mgl-2">
                <b>{{ Auth()->user()->nama }}</b>
                <p>{{ Auth()->user()->username }}</p>
            </div>
        </div>
        <button class="mgr-2 mobile-show flex-center button pd-1 br-1 custom-input" id="sidebar-trigger">
            <svg x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="35" height="35" fill="#363636" >
                <g>
                    <path d="M480,224H32c-17.673,0-32,14.327-32,32s14.327,32,32,32h448c17.673,0,32-14.327,32-32S497.673,224,480,224z"/>
                    <path d="M32,138.667h448c17.673,0,32-14.327,32-32s-14.327-32-32-32H32c-17.673,0-32,14.327-32,32S14.327,138.667,32,138.667z"/>
                    <path d="M480,373.333H32c-17.673,0-32,14.327-32,32s14.327,32,32,32h448c17.673,0,32-14.327,32-32S497.673,373.333,480,373.333z"/>
                </g>
            </svg>                
        </button>
    </nav>
    <!-- sidebar -->
    <div id="sidebar" class="sidebar pos-fixed bg-white shadow border-box flex-column pd-2" style="z-index: 8; top: 0;">
        {{-- <a href="/admin/dashboard" class="{{ Request::is('admin/dashboard*') ? 'active' : '' }} flex-align">
            <div class="flex-center" style="width: 25px; height: 25px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.79 22.7402H6.21C3.47 22.7402 1.25 20.5102 1.25 17.7702V10.3602C1.25 9.00021 2.09 7.29021 3.17 6.45021L8.56 2.25021C10.18 0.990208 12.77 0.930208 14.45 2.11021L20.63 6.44021C21.82 7.27021 22.75 9.05021 22.75 10.5002V17.7802C22.75 20.5102 20.53 22.7402 17.79 22.7402ZM9.48 3.43021L4.09 7.63021C3.38 8.19021 2.75 9.46021 2.75 10.3602V17.7702C2.75 19.6802 4.3 21.2402 6.21 21.2402H17.79C19.7 21.2402 21.25 19.6902 21.25 17.7802V10.5002C21.25 9.54021 20.56 8.21021 19.77 7.67021L13.59 3.34021C12.45 2.54021 10.57 2.58021 9.48 3.43021Z" fill="#363636"/>
                    <path d="M7.50043 17.2499C7.31043 17.2499 7.12043 17.1799 6.97043 17.0299C6.68043 16.7399 6.68043 16.2599 6.97043 15.9699L10.1704 12.7699C10.3304 12.6099 10.5404 12.5299 10.7704 12.5499C10.9904 12.5699 11.1904 12.6899 11.3204 12.8799L12.4104 14.5199L15.9604 10.9699C16.2504 10.6799 16.7304 10.6799 17.0204 10.9699C17.3104 11.2599 17.3104 11.7399 17.0204 12.0299L12.8204 16.2299C12.6604 16.3899 12.4504 16.4699 12.2204 16.4499C12.0004 16.4299 11.8004 16.3099 11.6704 16.1199L10.5804 14.4799L8.03043 17.0299C7.88043 17.1799 7.69043 17.2499 7.50043 17.2499Z" fill="#363636"/>
                    <path d="M16.5 14.25C16.09 14.25 15.75 13.91 15.75 13.5V12.25H14.5C14.09 12.25 13.75 11.91 13.75 11.5C13.75 11.09 14.09 10.75 14.5 10.75H16.5C16.91 10.75 17.25 11.09 17.25 11.5V13.5C17.25 13.91 16.91 14.25 16.5 14.25Z" fill="#363636"/>
                    </svg>
            </div>
            <p class="mgl-2">Dashboard</p>
        </a> --}}
        <a href="/admin/jenis" class="{{ Request::is('admin/jenis*') ? 'active' : '' }} flex-align">
            <div class="flex-center" style="width: 25px; height: 25px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 10.75H5C2.58 10.75 1.25 9.42 1.25 7V5C1.25 2.58 2.58 1.25 5 1.25H7C9.42 1.25 10.75 2.58 10.75 5V7C10.75 9.42 9.42 10.75 7 10.75ZM5 2.75C3.42 2.75 2.75 3.42 2.75 5V7C2.75 8.58 3.42 9.25 5 9.25H7C8.58 9.25 9.25 8.58 9.25 7V5C9.25 3.42 8.58 2.75 7 2.75H5Z" fill="#363636"/>
                    <path d="M19 10.75H17C14.58 10.75 13.25 9.42 13.25 7V5C13.25 2.58 14.58 1.25 17 1.25H19C21.42 1.25 22.75 2.58 22.75 5V7C22.75 9.42 21.42 10.75 19 10.75ZM17 2.75C15.42 2.75 14.75 3.42 14.75 5V7C14.75 8.58 15.42 9.25 17 9.25H19C20.58 9.25 21.25 8.58 21.25 7V5C21.25 3.42 20.58 2.75 19 2.75H17Z" fill="#363636"/>
                    <path d="M19 22.75H17C14.58 22.75 13.25 21.42 13.25 19V17C13.25 14.58 14.58 13.25 17 13.25H19C21.42 13.25 22.75 14.58 22.75 17V19C22.75 21.42 21.42 22.75 19 22.75ZM17 14.75C15.42 14.75 14.75 15.42 14.75 17V19C14.75 20.58 15.42 21.25 17 21.25H19C20.58 21.25 21.25 20.58 21.25 19V17C21.25 15.42 20.58 14.75 19 14.75H17Z" fill="#363636"/>
                    <path d="M7 22.75H5C2.58 22.75 1.25 21.42 1.25 19V17C1.25 14.58 2.58 13.25 5 13.25H7C9.42 13.25 10.75 14.58 10.75 17V19C10.75 21.42 9.42 22.75 7 22.75ZM5 14.75C3.42 14.75 2.75 15.42 2.75 17V19C2.75 20.58 3.42 21.25 5 21.25H7C8.58 21.25 9.25 20.58 9.25 19V17C9.25 15.42 8.58 14.75 7 14.75H5Z" fill="#363636"/>
                </svg>
            </div>
            <p class="mgl-2">Jenis Sampah</p>
        </a>
        
        <a href="/logout" class="flex-align">
            <div class="flex-center" style="width: 25px; height: 25px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.90002 7.55999C9.21002 3.95999 11.06 2.48999 15.11 2.48999H15.24C19.71 2.48999 21.5 4.27999 21.5 8.74999V15.27C21.5 19.74 19.71 21.53 15.24 21.53H15.11C11.09 21.53 9.24002 20.08 8.91002 16.54" stroke="#363636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15 12H3.62" stroke="#363636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5.85 8.6499L2.5 11.9999L5.85 15.3499" stroke="#363636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>                        
            </div>
            <p class="mgl-2">Logout</p>
        </a>
    </div>

    <div class="admin-container" id="admin-container">
        @yield('container')

    </div>

    <script>

        // $('#title').html($('#title').html() + ' | Testing');

        $('#sidebar-trigger').on('click', function(){
            $('#sidebar').toggleClass("sidebar-trigger");
        });
        

        function directLink(link){
            window.location.href = link;
        }
        function openLinkNewTab(link) {
            window.open(link, '_blank');
        }

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