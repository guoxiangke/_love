(function($){
Drupal.behaviors.PhotoAutoSubmit = {
  attach: function(context) {
    $('.t-field_photo a').each(function(){
       //$(this).addClass('highslide').attr("onclick","return hs.expand(this)");;
       $(this).addClass('highslide').attr("onclick","return hs.expand(this,{wrapperClassName : 'highslide-white', spaceForCaption: 30,outlineType: 'rounded-white'})");
    }

  );
  }
}
})(jQuery);
