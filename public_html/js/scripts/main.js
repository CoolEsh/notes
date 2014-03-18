$( function() {

    $( ".form-submit" ).on( "click", function() {
        $( this ).closest( "form" ).submit();
    } );

    /**
     * BOF delete action handling
     */
    $( ".container" ).delegate( ".delete-action", "click", function() {
        var $el = $( this );

        $( "#modal_dialog" ).find( ".modal_dialog_title" ).html( $el.data( "title" ) );
        $( "#modal_dialog" ).find( ".modal_dialog_message" ).html( $el.data( "message" ) );

        var dialogFooter = '<a href="javascript:;" class="btn btn-default modal_dialog_cancel" data-dismiss="modal" aria-hidden="true">Cancel</a>\n\
        <a href="javascript:;" class="btn btn-default btn-danger modal_dialog_delete">Delete</a>';

        $( "#modal_dialog" ).find( ".modal-footer" ).children().remove();
        $( "#modal_dialog" ).find( ".modal-footer" ).html( dialogFooter );

        $( "#modal_dialog" ).find( ".modal_dialog_delete" ).attr( "href", $el.data( "deleteurl" ) );

        $( '#modal_dialog' ).modal();

        return false;
    } );
    /**
     * EOF delete action handling
     */

} );