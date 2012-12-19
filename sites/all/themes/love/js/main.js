(function ($) {
/**
 * Field instance settings screen: force the 'Display on registration form'
 * checkbox checked whenever 'Required' is checked.
 */
Drupal.behaviors.statusInit = {
 attach: function(context) {
  $('.t-field_photo a').each(function(){
       //$(this).addClass('highslide').attr("onclick","return hs.expand(this)");;
       $(this).addClass('highslide').attr("onclick","return hs.expand(this,{wrapperClassName : 'highslide-white', spaceForCaption: 30,outlineType: 'rounded-white'})");
      }
  );

	$('a[rel="tooltip"]').hover(function(){
	    $(this).tooltip('show');
	 });


  $(window).scroll(function(){
      if ($(this).scrollTop() > 100) {
          $('.scrollup').fadeIn();
      } else {
          $('.scrollup').fadeOut();
      }
  }); 

  $('.scrollup').click(function(){
      $("html, body").animate({ scrollTop: 0 }, 600);
      return false;
  });

 }
};

})(jQuery);
