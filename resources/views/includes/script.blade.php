      <script src="{{ asset('/assets/js/metisMenu.js') }}"></script>
      <script src="{{ asset('/assets/js/jquery.slimscroll.min.js') }}"></script>
      <script src="{{ asset('/assets/js/collapse.js') }}"></script>
      <script src="{{ asset('/assets/js/alert.js') }}"></script>

      <script>
         $(function (){
            $('#menu2').metisMenu();
            $('.sidebar-nav').slimscroll({
               width: '250px',
               height: '100%',
               color : '#ff7f0e'
            });     
         });

         (function($){
            $(document).ready(function(){
               $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
                  event.preventDefault(); 
                  event.stopPropagation(); 
                  $(this).parent().siblings().removeClass('open');
                  $(this).parent().toggleClass('open');
               });
            });
         })
         (jQuery); 
         window.setTimeout(function() {
            $("#flashMessage").fadeTo(500, 0).slideUp(500, function(){
               $(this).remove(); 
// $(this).hide();            
});
         }, 5000);
      </script>
