jQuery(document).ready(function ( $ )
{
   var cookieKey = 'moon_cookie'

   if (Cookies.get(cookieKey) === undefined || Cookies.get(cookieKey) == false)
   {
      $('.the-cookiejar').removeClass('hide-cookie');
   }
   else
   {
      $('.the-cookiejar').remove();
   }

   $('.ok-btn').click(function (e)
   {
      e.preventDefault();
      Cookies.set(cookieKey, true, { expires: 180 });
      $('.the-cookiejar').slideUp('slow', function()
      {
         $(this).remove();
      });
   });
});
