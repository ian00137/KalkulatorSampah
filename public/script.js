
function popupMessage(type, message){
    if(type == 'success'){
        background = 'bg-safe'
        judul = 'Sukses'
    } else {
        background = 'bg-danger'
        judul = 'Gagal'
    }
    html = `
    <div id='notif-container' class="pos-fixed w-100 flex-center " style="top: 0px; z-index: 100;">
        <div id="notif" class="shadow pos-fixed bg-white br-solid-h br-2 flex of-hidden mgx-2 notif" style="max-width: 500px;">
            <div class="`+ background +`" style="width: 10px; min-height: 70px;">
            </div>
            <div class="flex-justify flex-column mgx-2" style="min-width: 250px;">
                <h3>`+ judul +`</h3>
                <p>`+ message +`</p>
            </div>
            <div class="flex-align mgr-2" >
                <button id="notif-button" class="border-none pd-2 br-6 button">Tutup (<b id="notif-timer">10</b>)</button>
            </div>
        </div>
    </div>
    `;
    $('#notif-container').remove();
    $('body').append(html)
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
                $('#notif-container').remove();
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
            $('#notif-container').remove();
        },800);
    });
}


function errorMessage(id, pesan = ''){
    $(id).html(pesan);
}

function fixURL(url) {
    var regex = new RegExp("\\bpublic/\\b", "g");
    url = "/storage/" + url.replace(regex, "")
    return url;
}

function openLink(link){
    window.location.href = link;
}
function openLinkNewTab(link) {
    window.open(link, '_blank');
}
function setTitle(judul){
    $('title').html(judul);
}

function alertLink(pesan, link){
    html = `
    <div id="alertContainer" class="flex-center w-100 h-100vh pos-fixed bg-in" style="z-index: 9999;">
        <div class="bg-white shadow mg-2 pd-3 br-2 br-solid-h" style="min-width: 250px; max-width: 400px;">
            <h2 class="flex-align gap-1">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="orange"><path d="M13.5,10.5v5c0,.83-.67,1.5-1.5,1.5s-1.5-.67-1.5-1.5v-5c0-.83,.67-1.5,1.5-1.5s1.5,.67,1.5,1.5Zm-1.5,8.5c-.83,0-1.5,.67-1.5,1.5s.67,1.5,1.5,1.5,1.5-.67,1.5-1.5-.67-1.5-1.5-1.5Zm11.05-4.19L15.31,2.73c-.75-1.08-1.99-1.73-3.31-1.73s-2.56,.65-3.34,1.78L.99,14.76c-1.09,1.56-1.29,3.45-.52,4.92,.77,1.48,2.34,2.32,4.32,2.32h1.72c.83,0,1.5-.67,1.5-1.5s-.67-1.5-1.5-1.5h-1.72c-.48,0-1.33-.09-1.66-.71-.25-.48-.13-1.17,.35-1.87L11.15,4.44c.28-.4,.69-.44,.85-.44s.57,.04,.82,.39l7.74,12.08c.45,.64,.57,1.34,.32,1.82-.32,.62-1.18,.71-1.66,.71h-1.72c-.83,0-1.5,.67-1.5,1.5s.67,1.5,1.5,1.5h1.72c1.97,0,3.55-.85,4.32-2.32,.77-1.47,.57-3.36-.48-4.87Z"/></svg>
                Peringatan!
            </h2>
            <p class="mgt-1">`+ pesan +`</p>
            <div class="flex-end gap-1 mgt-3">
                <button id="alertCancel" class="bg-danger cl-white pdy-2 pdx-3 button border-none br-6" >Batal</button>
                <button id="alertAccept" class="bg-second cl-white pdy-2 pdx-3 button border-none br-6" >Lanjutkan</button>
            </div>
        </div>
    </div>
    `;
    $('#topCode').append(html);
    $('#alertCancel').on('click', function () {
        $('#alertContainer').remove();
    });
    $('#alertAccept').on('click', function () {
        openLink(link);
    });
}




