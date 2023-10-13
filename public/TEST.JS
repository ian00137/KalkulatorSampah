function pesanError(id, pesan){
    $(id).html(pesan);
}


function pesanNotifikasi(type, pesan){
    if(type == 'sukses'){
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
                <p>`+ pesan +`</p>
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

$('#form-open-1').on('click',function(){
    $('#form-container-1').css({
        'display':'flex'
    });
})
$('#form-close-1').on('click',function(){
    $('#form-container-1').css('display','none');
})
$('#form-open-2').on('click',function(){
    $('#form-container-2').css({
        'display':'flex'
    });
})
$('#form-close-2').on('click',function(){
    $('#form-container-2').css('display','none');
    pesanError('#keteranganErrorPost', '')
    pesanError('#fotoErrorPost', '')
})



$('#postForm').submit(function(e){
    e.preventDefault()
    $("#btnPostSimpan").disable = false;
    var dataForm = new FormData(this);
    $.ajax({
        type: "post",
        url: "/api/post",
        data: dataForm,
        contentType: false,
        processData: false,
        success: function (response) {
            let data = JSON.parse(response)
            if(data.validationPass){
                pesanNotifikasi('sukses','Data postingan berhasil ditambahkan')
                $('#form-container-2').css('display','none');
                pesanError('#keteranganErrorPost', '')
                pesanError('#fotoErrorPost', '')
            } else {
                pesanNotifikasi('gagal','Harap isi data form dengan benar!')
                if('foto' in data.validationErrors){
                    pesanError('#fotoErrorPost', data.validationErrors.foto[0])
                } else {
                    pesanError('#fotoErrorPost', '')
                }
                if('keterangan' in data.validationErrors){
                    pesanError('#keteranganErrorPost', data.validationErrors.keterangan[0])
                } else {
                    pesanError('#keteranganErrorPost', '')
                }
            }
        }
    });

})

