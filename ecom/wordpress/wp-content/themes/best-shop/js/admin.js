( function( $ ){
    $( document ).ready( function(){
						
      $( '.best-shop-btn-get-started' ).on( 'click', function( e ) {
          e.preventDefault();
          $( this ).html( 'Processing... Please wait' ).addClass( 'updating-message' );
          $.post( best_shop_ajax_object.ajax_url, { 'action' : 'install_act_plugin' }, function( response ){
              location.href = 'themes.php?page=advanced-import';
          } );
      } );

      // Dismiss theme admin notice via AJAX
      $( document ).on( 'click', '.best-shop-admin-notice .notice-dismiss, .best-shop-admin-notice .best-shop-dismiss-link', function( e ) {
          if ( $( this ).hasClass( 'best-shop-dismiss-link' ) ) {
              e.preventDefault();
          }
          var $notice = $( this ).closest( '.best-shop-admin-notice' );
          var nonce   = $notice.data( 'nonce' );
          var ajaxUrl = ( typeof best_shop_ajax_object !== 'undefined' && best_shop_ajax_object.ajax_url ) 
              ? best_shop_ajax_object.ajax_url 
              : ( typeof ajaxurl !== 'undefined' ? ajaxurl : '' );

          if ( ajaxUrl && nonce ) {
              $.post( ajaxUrl, {
                  action: 'best_shop_dismiss_admin_notice',
                  nonce:  nonce
              } );
          }

          $notice.fadeTo( 150, 0, function() {
              $( this ).slideUp( 150, function() {
                  $( this ).remove();
              } );
          } );
      } );
    } );

}( jQuery ) )