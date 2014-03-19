$( function() {

    $( ".todos-container" ).on( "click", ".add-todo-item", function() {
        var $el = $( ".todo-item:last").clone( true );
        var $hidden = $el.find( "input:hidden" );
        var $checkbox = $el.find( "input:checkbox" );
        var $text = $el.find( "input:text" );

        var newKey = parseInt( $text.data( "key" ), 10 ) + 1;

        $hidden.attr( "name", "todo_completed[" + newKey + "]");
        $hidden.data( "key", newKey );

        $checkbox.attr( "name", "todo_completed[" + newKey + "]" );
        $checkbox.removeProp( "checked" );
        $checkbox.data( "key", newKey );

        $text.attr( "name", "todo_content[" + newKey + "]" );
        $text.val( "" );
        $text.data( "key", newKey );

        $el.insertAfter( $( ".todo-item:last" ) );
    } );

    $( ".todos-container" ).on( "click", ".remove-todo-item", function() {
        var $el = $( this ).closest( ".todo-item" );
        if ( $el.siblings().size() > 0 ) {
            $el.remove();
        }
    } );


    $( "#note-tags" ).tagit();

} );