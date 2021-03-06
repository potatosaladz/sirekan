$(document).ready(function() {
    $.getJSON('controller/cont.menu.php?admin', function(data) {
        if (data === '2') {
            window.location = 'main.php';
        }
    });
    
    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);

    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    
    $('#tgl_surat').datepicker({dateFormat: 'yy-mm-dd'});
    
    $('#tgl_surat').val(today);
    //input hanya angka
    $(".int").keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        return (
                key === 8 ||
                key === 9 ||
                key === 46 ||
                (key >= 37 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
    });
    
    //JSON cek data
    $('#kdakses').change(function(){
        var e = document.getElementById('kdakses');
        var kdakses = e.options[e.selectedIndex].value;
        if(kdakses!=='2'){
            $('#isi_user').fadeIn(250);
            $('#username').fadeIn(250);
        }else {
            $('#isi_user').fadeOut(250);
            $('#username').fadeOut(250);
        }
    });
    
    $("input[type=text]").keyup(function() {
        var val = $(this).attr('value');
        var field = $(this).attr('name');
        $('#loader').html('<img src="img/loader.gif" alt="loader" />').show();
        if (field === 'kddept' && val.length === 3) {
            $.getJSON('controller/cont.rekam.php', {kddept: val, cek: true}, function(data) {
                $.each(data, function() {
                    if (data.msg === 'ok') {
                        $('span#kddept').html(data.nama).fadeIn(500);
                    } else {
                        $('span#kddept').fadeIn(1000).text(data.nama);
                    }
                    $('#loader').html('<img src="img/loader.gif" alt="loader" />').hide();
                });
            });
        }
        if (field === 'kdunit' && val.length === 2) {
            var kddept = $('#kddept').val();
            $('#loader').html('<img src="img/loader.gif" alt="loader" />').show();
            $.getJSON('controller/cont.rekam.php', {kdunit: val, kddept: kddept, cek: true}, function(data) {
                $.each(data, function() {
                    if (data.msg === 'ok') {
                        $('span#kdunit').fadeIn(1000).text(data.nama);
                    } else {
                        $('span#kdunit').fadeIn(1000).text(data.nama);
                    }
                    $('#loader').html('<img src="img/loader.gif" alt="loader" />').hide();
                });
            });
        }
        if (field === 'kdsatker' && val.length === 6) {
            var kddept = $('#kddept').val();
            var kdunit = $('#kdunit').val();
            $('#loader').html('<img src="img/loader.gif" alt="loader" />').show();
            $.getJSON('controller/cont.rekam.php', {kdsatker: val, kdunit: kdunit, kddept: kddept, cek: true}, function(data) {
                $.each(data, function() {
                    if (data.msg === 'ok') {
                        $('span#kdsatker').fadeIn(1000).text(data.nama);
                    } else {
                        $('span#kdsatker').fadeIn(1000).text(data.nama);
                    }
                    $('#loader').html('<img src="img/loader.gif" alt="loader" />').hide();
                });
            });
        }
    });

    //submit form
    $('#frm_rekam').submit(function() {
        $('#loader').html('<img src="img/loader.gif" alt="loader" />').show();
        var kddekon = $('#dekon:checked').val();
        var e = document.getElementById('kdakses');
        var kdakses = e.options[e.selectedIndex].value;
        var kddept=$('#kddept').val();
        var kdunit= $('#kdunit').val();
        var kdsatker=$('#kdsatker').val();
        if ($('#kddept').val() === '' || $('#kdunit').val() === '' || $('#kdsatker').val() === '' || $('#no_surat').val() === '' || $('#tgl_surat').val() === '' || kddekon==='') {
            $('#error').html('Tidak boleh kosong').fadeIn(1000).delay(3500).fadeOut(500);
            $('#loader').html('<img src="img/loader.gif" alt="loader" />').hide();
            return false;
        } else {
            $.post($('#frm_rekam').attr('action'), {kddept:$('#kddept').val(), kdunit: $('#kdunit').val() ,kdsatker:$('#kdsatker').val(),no_surat:$('#no_surat').val(),tgl_surat:$('#tgl_surat').val() ,kddekon:kddekon,kdakses: kdakses,username: $('#username').val()}, function(data) {
                var username='';
                var password='';
                //$.each(data, function() {
                    if (data.msg === 'ok') {
                        $("input[type=text]").val('');
                        $("input").next('span').fadeOut(500).text('');
                        $('#div_rekam').fadeOut(500);
                        
                        username=data.username;
                        password=data.password;
                        var arr={kddept:kddept, kdunit: kdunit ,
                            kdsatker:kdsatker,kddekon:kddekon,username:username,password:password};
                         cetakPass(data)
                        //$('#user_baru').html(data.password + ' ====> ' + data.username).show();
                    } else {
                        $("input[type=text]").val('');
                        $("input").next('span').fadeOut(500).text('');
                        $('#user_baru').html(data.info).fadeIn(500).delay(3500).fadeOut(500);
                    }
                //});           
            }, 'json');
        }
        $('#loader').html('<img src="img/loader.gif" alt="loader" />').hide();
        return false;
    });
});

function cetakPass(data){
    $.post('controller/cont.rekam.php?pdf', {kddept: data.kddept, kdunit:data.kdunit, kdsatker:data.kdsatker, 
        kddekon: data.kddekon,username:data.username,password:data.password}, function(data) {
            if (data === true) {
                $('#output').html('Gagal Cetak PDF');
            } else {
                //window.open('BAR.pdf', '_blank', 'fullscreen=yes');
                $('#grid').fadeOut(250);
                var pdf = new PDFObject({
                    url: data,
                    id: "pdf",
                    pdfOpenParams: {
                        view: "FitH"
                    }
                }).embed("pdf");
            }
        }, 'json');
}

