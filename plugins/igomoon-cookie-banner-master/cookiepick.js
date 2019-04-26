jQuery(document).ready(function ( $ )
{
	// Initiating Wordpress Color picker for admin panel
   $('.igm-color-field').wpColorPicker();


   // Handles tabs in Admin page.
   $('.nav-tab').click(function(e)
   {
      e.preventDefault();
      $('.nav-tab').removeClass('active');
      $(this).addClass('active');
      $('.tab-content').removeClass('active');
      $('.tab-content[data-tab="'+$(this).data('tab')+'"]').addClass('active');
   })
});
