$(document).ready(function(){
    $('#isinya').html('<img src="../img/loader.gif" alt="loader" />').show();
    $('#isinya').load('monitoring.php');
    
    $("ul#menu_parent li a, ul#menu_parent li > ul li a").click(function(){
        //$('#loader').html('<img src="img/loader.gif" alt="loader" />').show();
        var hal= $(this).attr('href');
        if(hal===''){
            return false;
        }
        $('#isinya').load(hal+'.php');
        return false;
    });
});