$(document).ready(function () {   

    $('.owl-header').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        rtl:true,
        dots:false,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:1
               
            },
            1000:{
                items:1
            }
        }
    });
    $('.owl_offer').owlCarousel({
        loop:false,
        margin:10,
        nav:true,
        rtl:true,
        dots:false,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:1
               
            },
            1000:{
                items:1
            }
        }
    });
    $('.copon .owl_offer').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        rtl:true,
        dots:false,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:1
               
            },
            1000:{
                items:1
            }
        }
    });


    



    $('.bar').click(function(){
        $(".links_a").toggleClass("open");
        $("body").toggleClass("i-open");
    })
    $('.time-av ul li').click(function(){
        // $(".item-bank").removeClass("active");
        $(this).addClass("active");
    })








    $(".main_tabs ul li:first").addClass("active");
    $(".m_t_body").hide();
    $(".m_t_body:first").show();
    $(".main_tabs ul li").on("click", function () {
        $(".main_tabs ul li").removeClass("active");
        $(this).addClass("active");
        $(".m_t_body").hide();
        $($(this).data("tabs")).fadeIn();

    });
    $(".normal .offer_button .next").click(function () {
        $(".normal .owl_offer .owl-next").click();
    });
    $(".normal .offer_button .prev").click(function () {
        $(".normal .owl_offer .owl-prev").click();
    });


    $(".copon .offer_button .next").click(function () {
        $(".copon .owl_offer .owl-next").click();
    });
    $(".copon .offer_button .prev").click(function () {
        $(".copon .owl_offer .owl-prev").click();
    });



    $('.list-payment ul li').click(function(){
      $(".list-payment ul li").removeClass("active");
      $(this).addClass("active");
    })

    $(".co_drop button").click(function(){
        $(".co_drop ").toggleClass("show");
    })
    




    //   $($(".copy_code").children()[1]).attr("id", "select_txt")
$('.copy_code').click(function(e){

    e.preventDefault();
    // copy_data($($(this).children()[1]))
    $($(this).children()[0]).addClass("opac");
    // let x = $(this).children()[1];
    // return copy(x);

    
});




    
});



function copy_data(containerid) {
    var range = document.createRange();
    range.selectNode(containerid); //changed here
    window.getSelection().removeAllRanges(); 
    window.getSelection().addRange(range); 
    document.execCommand("copy");
    window.getSelection().removeAllRanges();
    // alert("data copied");
  }
