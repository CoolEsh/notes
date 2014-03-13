$( function() {
    $( ".form-submit" ).on( "click", function() {
        $( this ).closest( "form" ).submit();
    } );
} );