//Modal
jQuery(function($) {
  

    $('button#site_icon').on('click', function(e){
  
      $( '.modal' ).addClass( 'show' );
      $( '.signup-card' ).addClass( 'show' );
      $( '.signup-card' ).removeClass( 'hide' );
      $( '.login-card' ).addClass( 'hide' );
      $( '.login-card' ).removeClass( 'show' );
      $( '.reset-card' ).addClass( 'hide' );
      $( '.reset-card' ).removeClass( 'show' );
      $( '.login-btn' ).show();
      $( '.signup-btn' ).hide();
      $( '.reset-btn' ).show();
    });
  
    $('button#modal_close').on('click', function(e){
  
      $(  '.modal' ).removeClass( 'show' );
    });
  
    $('button#signup_btn').on('click', function(e){
  
      $( '.signup-card' ).addClass( 'show' );
      $( '.signup-card' ).removeClass( 'hide' );
      $( '.login-card' ).addClass( 'hide' );
      $( '.login-card' ).removeClass( 'show' );
      $( '.reset-card' ).addClass( 'hide' );
      $( '.reset-card' ).removeClass( 'show' );
      $( '.login-btn' ).show();
      $( '.signup-btn' ).hide();
      $( '.reset-btn' ).show();
    });
  
    $('button#login_btn').on('click', function(e){
  
      $( '.signup-card' ).addClass( 'hide' );
      $( '.signup-card' ).removeClass( 'show' );
      $( '.login-card' ).addClass( 'show' );
      $( '.login-card' ).removeClass( 'hide' );
      $( '.reset-card' ).addClass( 'hide' );
      $( '.reset-card' ).removeClass( 'show' );
      $( '.login-btn' ).hide();
      $( '.signup-btn' ).show();
      $( '.reset-btn' ).show();
    });

    $('button#reset_btn').on('click', function(e){
  
      $( '.signup-card' ).addClass( 'hide' );
      $( '.signup-card' ).removeClass( 'show' );
      $( '.login-card' ).addClass( 'hide' );
      $( '.login-card' ).removeClass( 'show' );
      $( '.reset-card' ).addClass( 'show' );
      $( '.reset-card' ).removeClass( 'hide' );
      $( '.login-btn' ).show();
      $( '.signup-btn' ).show();
      $( '.reset-btn' ).hide();
    });
  });