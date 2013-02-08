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



$('#user-register-form #edit-submit').click(function(e){
    e.preventDefault();
    if($('#edit-picture-upload').val()){
      $('#user-register-form').submit();
    }else{
      alert('请选择照片！最好是正方形的哦，这样现实效果最佳~');
    }
});


  $('.rate-number-up-down-btn-up').html('<i class="icon-thumbs-up"></i>').attr('title','顶');
  $('.rate-number-up-down-btn-down').html('<i class="icon-thumbs-down"></i>').attr('title','踩');
  $('.vote-1').addClass('hide');

//   $('.t-field_photo .photo').hover(
//    function () {
//    $(this).parents('.t-field_photo').find('.vote-1').removeClass('hide');
//    }, 
//    function () {
//     $(this).parents('.t-field_photo').find('.vote-1').addClass('hide');
//    }
//   );
    $caption = $(this).parents('.t-field_photo').find('.vote-1')
    
  $('.t-field_photo .photo').hover(function(){
      $(this).parents('.t-field_photo').find('.vote-1').stop(true, true).fadeIn('fast');
    },function(){
      $(this).parents('.t-field_photo').find('.vote-1').stop(true, true).fadeOut('fast');
    }
  );


  $(document).ready(function(){

  $('#edit-synch').css('background-position', 'right');
  $('input[type=radio]').css('display','none');
  $('#edit-synch label').css('text-indent','-10000px');

    $("input[name=synch]").click(function() {
      var button = $(this).val();
    
    if(button == '0'){ $('#edit-synch').css('background-position', 'right'); 

    }
    if(button == '1'){ $('#edit-synch').css('background-position', 'left'); }  

   });

});

  $.fn.emptyTextarea = function() {
    $('.node-status-form textarea').val('');
  };


 }
};

  
})(jQuery);
