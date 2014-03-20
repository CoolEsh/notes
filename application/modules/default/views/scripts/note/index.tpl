<div class="container">
    <h1>Notes List</h1>

    {include file='./partials/paginator-controls.tpl' paginator=$remindersPaginator}

    {if ( count( $remindersPaginator.data ) )}
        {foreach from=$remindersPaginator.data item=reminder}

            {if ( $reminder->getType() === 'text' )}
                {include file='./partials/text.tpl'}
            {elseif ( $reminder->getType() === 'todo' )}
                {include file='./partials/todo.tpl'}
            {else}

            {/if}

        {/foreach}
    {/if}

    {include file='./partials/paginator-controls.tpl' paginator=$remindersPaginator}

</div>