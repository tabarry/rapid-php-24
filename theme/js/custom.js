/* Sidebar navigation */
/* ------------------ */

/* Show navigation when the width is greather than or equal to 991px */

$(document).ready(function(){

  $(window).resize(function()
  {
    if($(window).width() >= 767){
      $(".side-nav").slideDown(150);
    }     
	else{
	  $(".side-nav").slideUp(150);
	}	
  });

});

/* ****************************************** */
/* Sidebar dropdown */
/* ****************************************** */

$(document).ready(function(){
  $(".sidebar-dropdown a").on('click',function(e){
      e.preventDefault();

      if(!$(this).hasClass("open")) {
        // hide any open menus and remove all other classes
        $(".sidebar .side-nav").slideUp(150);
        $(".sidebar-dropdown a").removeClass("open");
        
        // open our new menu and add the open class
        $(".sidebar .side-nav").slideDown(150);
        $(this).addClass("open");
      }
      
      else if($(this).hasClass("open")) {
        $(this).removeClass("open");
        $(".sidebar .side-nav").slideUp(150);
      }
  });

});

/* ****************************************** */
/* Sidebar dropdown menu */
/* ****************************************** */

$(document).ready(function(){

  $(".has_submenu > a").click(function(e){
    e.preventDefault();
    var menu_li = $(this).parent("li");
    var menu_ul = $(this).next("ul");

    if(menu_li.hasClass("open")){
      menu_ul.slideUp(150);
      menu_li.removeClass("open");
	  $(this).find("span").removeClass("fa-caret-up").addClass("fa-caret-down");
    }
    else{
      $(".side-nav > li > ul").slideUp(150);
      $(".side-nav > li").removeClass("open");
      menu_ul.slideDown(150);
      menu_li.addClass("open");
	  $(this).find("span").removeClass("fa-caret-down").addClass("fa-caret-up");
    }
  });
  
});

/* ****************************************** */
/* Slim Scroll */
/* ****************************************** */

$(function(){
    $('.scroll').slimScroll({
        height: '315px',
		size: '5px',
		color:'rgba(50,50,50,0.3)'
    });
});	


/* ****************************************** */
/* JS for UI Tooltip */
/* ****************************************** */

$('.ui-tooltip').tooltip();



/* ****************************** */
/* Slider */
/* ******************************* */

    $(function() {
        // Horizontal slider
        $( "#master1, #master2" ).slider({
            value: 60,
            orientation: "horizontal",
            range: "min",
            animate: true
        });

        $( "#master4, #master3" ).slider({
            value: 80,
            orientation: "horizontal",
            range: "min",
            animate: true
        });        

        $("#master5, #master6").slider({
            range: true,
            min: 0,
            max: 400,
            values: [ 75, 200 ],
            slide: function( event, ui ) {
                $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            }
        });


        // Vertical slider 
        $( "#eq > span" ).each(function() {
            // read initial values from markup and remove that
            var value = parseInt( $( this ).text(), 10 );
            $( this ).empty().slider({
                value: value,
                range: "min",
                animate: true,
                orientation: "vertical"
            });
        });
    });
