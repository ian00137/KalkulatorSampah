@extends('template')
@section('container')


<div class="mgt-2 flex-betwen flex-align">
    <a id="btnTambahJenis" class="pdy-2 pdx-3 bg-second br-6 cl-white td-none button" style="white-space: nowrap;"><b class="cl-white">+</b> Tambah</a>
    <form class="bg-white pdy-2 pdx-3 w-fit flex-align br-solid-h br-5">
        <input type="text" placeholder="Cari..." class="custom-input" name="cari">
        <button class="custom-input cursor-pointer flex-center">
            <svg width="19" height="20" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 16.5L21 21.5" stroke="black" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M1 10.0714C1 14.8053 4.83756 18.6429 9.57144 18.6429C11.9424 18.6429 14.0887 17.6802 15.6404 16.1243C17.1869 14.5739 18.1429 12.4343 18.1429 10.0714C18.1429 5.33756 14.3053 1.5 9.57144 1.5C4.83756 1.5 1 5.33756 1 10.0714Z" stroke="black" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>                    
        </button>
    </form>
</div>
<div class="bg-white br-2 br-solid-h mgt-3">
    <div class="mgl-2 mgy-3">
        <h1 class="ft-capitalize">Jenis Sampah</h1>
        <p>Data yang ditemukan <b id="jmlData">0</b></p>
    </div>
</div>
<div id="tabelContainer" class="bg-white br-2 br-solid-h mgt-3">
    <p class='ft-center pdy-3'>Tidak ada data yang ditemukan</p>
</div>
<script>
    //Tambah
    function alertCustom(pesan, id, link){
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
        
        $('#topContainer').html(html);
        
        $('#alertCancel').on('click', function () {
            $('#alertContainer').remove();
        });
        $('#alertAccept').on('click', function () {
            $.ajax({
                type: "get",
                url: link,
                success: function (response) {
                    if(response = 'success'){
                        popupMessage('success','Postingan berhasi dihapus!')
                    } else {
                        popupMessage('fails','Terjadi kesalahan saat menghapus data')
                    }
                    $('#alertContainer').remove();
                    getData();
                }
            });
        });
    }
    function cekError(errorData){
        if('foto' in errorData){
            $('#errorFoto').html(errorData.foto[0]);
        } else{
            $('#errorFoto').html("");
        }
        if('nama' in errorData){
            $('#errorNama').html(errorData.nama[0]);
        } else{
            $('#errorNama').html("");
        }
        if('deskripsi' in errorData){
            $('#errorDeskripsi').html(errorData.deskripsi[0]);
        } else{
            $('#errorDeskripsi').html("");
        }
        if('harga' in errorData){
            $('#errorHarga').html(errorData.harga[0]);
        } else{
            $('#errorHarga').html("");
        }
    }
    
    function editData(id){
        $.ajax({
            type: "get",
            url: "/api/jenis/edit/" + id,
            success: function (response) {
                data = JSON.parse(response)
                html = 
                `<div id="form-container-1" class="w-100 h-100vh pos-fixed bg-in flex-center form-container" style="display: flex; z-index: 999999;">
                    <form id="formTambahJenis" class="bg-white pd-2 border-box mgx-2 br-2 br-solid-h flex-column shadow" style="width: 500px; max-height: 90vh;" action="" enctype="multipart/form-data">
                        @csrf
                        <h2>Tambah Fasilitas</h2>
                        <small>Lengkapi form dibawah ini untuk menambahkan fasilitas baru</small>
                        <label class="mgt-2">Foto</label>
                        <input type="file" name="foto" class="button br-2 border mgt-1 of-hidden custom-input-files">
                        <small id="errorFoto" class="cl-danger"></small>
                        <label class="mgt-2">Nama</label>
                        <input id="nama" type="text" name="nama" class="pd-2 br-2 border mgt-1">
                        <small id="errorNama" class="cl-danger"></small>
                        <label class="mgt-2">Deskripsi</label>
                        <textarea name="deskripsi" class="mgt-1 pd-2 br-2" cols="30" rows="10" resize="off">`+ data.deskripsi +`</textarea>
                        <small id="errorDeskripsi" class="cl-danger"></small>
                        <label class="mgt-2">Harga/KG</label>
                        <input id="harga" type="number" name="harga" class="pd-2 br-2 border mgt-1">
                        <small id="errorHarga" class="cl-danger"></small>
                        <div class="mgt-4 flex-end gap-1">
                            <button id="btnTutupForm" class="pd-2 border-none button br-1 bg-danger cl-white ft-uppercase" type="reset" id="form-close-1">Batal</button>
                            <button class="pd-2 border-none button br-1 bg-second cl-white ft-uppercase">Simpan</button>
                        </div>
                    </form>
                </div>`
                
                $('#topContainer').html(html);
                $('#nama').val(data.nama);
                $('#harga').val(data.harga);
                $("#btnTutupForm").on('click', function () {
                    $("#form-container-1").remove();
                });
                $('#formTambahJenis').submit(function (e) { 
            e.preventDefault();
            var dataForm = new FormData(this)
            $.ajax({
                type: "post",
                url: "/api/jenis/edit/" + id,
                data: dataForm,
                contentType: false,
                processData: false,
                success: function (response) {
                    data = JSON.parse(response)
                    if (data.isSuccess){
                        popupMessage('success', "Jenis sampah berhasil diubah!")
                        $("#form-container-1").remove();
                        getData()
                    } else {
                        cekError(data.errors);
                    }
                }
            });
        });
            }
        });
        
    }


    function getData(cari = null) {
        $.ajax({
            type: "get",
            url: "/api/jenis",
            data: {"cari": cari},
            success: function (response) {
                data = JSON.parse(response)
                $("#jmlData").html(data.length);
                console.log(data);
                if(data.length > 0){
                    nmr = 1;
                    html = `
                        <div class="of-scroll">
                            <table class="w-100">
                                <thead>
                                    <th class="ft-center">#</th>
                                    <th>Jenis</th>
                                    <th>Deskripsi</th>
                                    <th>Harga/KG</th>
                                    <th style="width: 0px;">Aksi</th>
                                </thead>
                                <tbody>`
                    data.forEach(item => {
                        html += `
                        <tr>
                            <td class="ft-center">` + nmr + `</td>
                            <td>` + item.nama + `</td>
                            <td>` + item.deskripsi + `</td>
                            <td>` + item.harga.toLocaleString('id-ID', {style: 'currency',currency: 'IDR'}) + `</td>
                            <td>
                                <button class="bg-second cl-white pdy-2 pdx-3 br-6 td-none button border-none" onclick="editData(`+ item.id +`)">Edit</button>
                                <button class="cl-white bg-danger  pdy-2 pdx-3 br-6 td-none button border-none" onclick="alertCustom('Apakah anda yakin ingin menghapus jenis sampah `+ item.nama +`?',`+ item.id +`,'/api/jenis/delete/`+ item.id +`')" >Hapus</button></td>
                        </tr>
                        `
                        nmr++
                    });
                                    
                    html += `
                                </tbody>
                            </table>    
                        </div>
                    `;
                    $('#tabelContainer').html(html);
                } else {
                    $('#tabelContainer').html("<p class='ft-center pdy-3'>Tidak ada data yang ditemukan</p>");
                }
            }
        });
    }


    $('#btnTambahJenis').on('click', function () {
        html = 
        `<div id="form-container-1" class="w-100 h-100vh pos-fixed bg-in flex-center form-container" style="display: flex; z-index: 999999;">
            <form id="formTambahJenis" class="bg-white pd-2 border-box mgx-2 br-2 br-solid-h flex-column shadow" style="width: 500px; max-height: 90vh;" action="" enctype="multipart/form-data">
                @csrf
                <h2>Tambah Jenis Sampah</h2>
                <small>Lengkapi form dibawah ini untuk menambahkan jenis sampah baru</small>
                <label class="mgt-2">Foto</label>
                <input type="file" name="foto" class="button br-2 border mgt-1 of-hidden custom-input-files">
                <small id="errorFoto" class="cl-danger"></small>
                <label class="mgt-2">Nama</label>
                <input type="text" name="nama" class="pd-2 br-2 border mgt-1">
                <small id="errorNama" class="cl-danger"></small>
                <label class="mgt-2">Deskripsi</label>
                <textarea name="deskripsi" class="mgt-1 pd-2 br-2" cols="30" rows="10" resize="off"></textarea>
                <small id="errorDeskripsi" class="cl-danger"></small>
                <label class="mgt-2">Harga/KG</label>
                <input type="number" name="harga" class="pd-2 br-2 border mgt-1">
                <small id="errorHarga" class="cl-danger"></small>
                <div class="mgt-4 flex-end gap-1">
                    <button id="btnTutupForm" class="pd-2 border-none button br-1 bg-danger cl-white ft-uppercase" type="reset" id="form-close-1">Batal</button>
                    <button class="pd-2 border-none button br-1 bg-second cl-white ft-uppercase">Simpan</button>
                </div>
            </form>
        </div>`
        $('#topContainer').html(html);
        $('#formTambahJenis').submit(function (e) { 
            e.preventDefault();
            var dataForm = new FormData(this)
            $.ajax({
                type: "post",
                url: "/api/jenis/tambah",
                data: dataForm,
                contentType: false,
                processData: false,
                success: function (response) {
                    data = JSON.parse(response)
                    console.log(data);
                    if (data.isSuccess){
                        popupMessage('success', "Jenis sampah baru berhasil ditambahkan!")
                        $("#form-container-1").remove();
                        getData()
                    } else {
                        cekError(data.errors);
                    }
                }
            });
        });
        $("#btnTutupForm").on('click', function () {
            $("#form-container-1").remove();
        });

    });

    

    $(document).ready(function () {
        getData();
    });
</script>
@endsection