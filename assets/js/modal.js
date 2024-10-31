(function($){
    $(document).on('click','.open-modal',function(e){
       var button = $(this);
        var modal=$("#modal_"+button.data('modal'));
        modal.show().scrollTop(0);
       if( typeof acf != 'undefined' ) acf.do_action('append', modal);
      
    });

    $(document).on('click','.close-modal',function(e){
        var button = $(this);
        var modal=$("#modal_"+button.data('modal'));

        modal.hide();
        if(typeof(clear)!=='undefined'){
            modal.remove();
        }
    });
    $(document).on('click','.ocmw-modal',function(e){
        if (e.target == this) $(this).hide();
    });

})(jQuery);
