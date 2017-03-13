/*global $*/
$(function(){
   $('.front-page').append($('.footer-front-page'));
   
    $(".menu-toggle").on('click', function() {
        $(this).toggleClass("on");
        $('.menu-section').toggleClass("on");
        $("nav ul").toggleClass('hidden');
    });
    
    $('.tlt').textillate({
      loop: true,
      in: {
        effect: 'fadeInLeft',
      },
      out: {
        effect: 'fadeOutRight',
      },
    });
    
    // if(window.location.pathname.localeCompare("/wordpress/") == 0){
    //   $('#footer').remove();
    //   $('.front-page').append($('.footer-front-page'));
    //   $('.footer-front-page').toggle();
    // }
    
    
    // (function(){
    //     var x = location.pathname;
        
    //     if(x.localeCompare("/wordpress/") == 0){
    //         $('nav').removeClass().addClass('frontpage-nav-principal');
    //     }
    // // })();
    // var tamano = 60;
    // var t = 50;
    // tamanoSection();
    
    // $(document).ready( tamanoSection() );
    // $(window).resize( function( event ){ tamanoSection(); } );
    
    // function tamanoSection(){
    //     var sizeContainer = $('.frontpage .section-01 .part-01').width();
    //     tamanoLetra(tamano,sizeContainer, 1200,$('.frontpage .section-01 .part-01 p'));
    //     tamanoLetra(t,sizeContainer, 1200, $('.frontpage .section-01 .part-01 h1'));
    // }
    
    // function tamanoLetra(sizeLetter, sizeContainer, sizeAll, $txt){
    //     var p = sizeLetter * sizeContainer / sizeAll;
    //     $txt.css('font-size', p);
    // }
});

