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

  $('.menu-457').click(function(e){
    e.preventDefault();
    options = {
      keyboard: false
    };
    $('#add-photo').modal('show');
  });

  $('.menu-invite a').click(function(e){
    e.preventDefault();
    options = {
      keyboard: false
    };
    $('#invite_form').modal('show');
  });


$('.rate-number-up-down-btn-up').html('<i class="icon-thumbs-up"></i>').attr('title','顶');
$('.rate-number-up-down-btn-down').html('<i class="icon-thumbs-down"></i>').attr('title','踩');

$('#user-register-form #edit-submit').click(function(e){
    e.preventDefault();
    if($('#edit-picture-upload').val()){
      $('#user-register-form').submit();
    }else{
      alert('请选择照片！最好是正方形的哦，这样现实效果最佳~');
    }
});


    $(function(){
      $().timelinr({
        orientation:  "vertical",
        issuesSpeed:  300,
        datesSpeed:   100,
        arrowKeys:    "true",
        startAt:    3
      })
    });


 }
};

  
})(jQuery);
