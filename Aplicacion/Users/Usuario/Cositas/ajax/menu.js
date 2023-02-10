
$(document).ready(function(){
    /////////////////////////////////////////////////////////////////////////////////////////			
			$('#menu li:has(ul)').click(function(e){
                e.preventDefault();
                if ($(this).hasClass('activado')) {
                    $(this).removeClass('activado');
                    $(this).children('ul').slideUp();
                }
                else
                {
                    $('#menu li ul').slideUp();
                    $('#menu li').removeClass('activado');
                    $(this).addClass('activado');
                    $(this).children('ul').slideDown();

                }
            });
    //////////////////////////////////////////////////////////////////////////////

    $(".Generales").click(function(e){
        e.preventDefault();
        window.location="../../Users/Usuario/";
        exit();
    });
    
    $(".Ofertas").click(function(e)    {
        e.preventDefault();
        $(".princ").load("/Users/Usuario/bean/Ofertas.php");
    });

    $(".Postulaciones").click(function(e)    {
        e.preventDefault();
        $(".princ").load("/Users/Usuario/bean/Postulaciones.php");
    });

    

    $(".cerrar").click(e=>{
        e.preventDefault();
        window.location="../../index.php?c";
        exit();
        
    })
})
