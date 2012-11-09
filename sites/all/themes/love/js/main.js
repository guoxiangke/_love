(function ($) {
/**
 * Field instance settings screen: force the 'Display on registration form'
 * checkbox checked whenever 'Required' is checked.
 */
Drupal.behaviors.statusClose = {
  $('div.alert a.close').click(function(){
    $(this).offsetParent().hide();
    console.log('click');
  });
};

})(jQuery);
