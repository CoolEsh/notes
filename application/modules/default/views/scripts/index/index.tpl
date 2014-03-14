<div class="container">
    <h1>Homepage</h1>

    {*{$paginator}*}

    {*{if ( count( $paginator ) )}*}
        {*{foreach from=$paginator item=reminder}*}
            {*<div class="panel panel-default">*}
                {*<div class="panel-heading">*}
                    {*<h3 class="panel-title">*}
                        {*{$reminder->getTitle()}*}
                        {*<div class="pull-right">*}
                            {*<a href="/note/update/id/{$reminder->getId()}"><i class="glyphicon glyphicon-edit"></i></a>*}
                            {*&nbsp;*}
                            {*<a href="/note/delete/id/{$reminder->getId()}"><i class="glyphicon glyphicon-trash"></i></a>*}
                        {*</div>*}
                    {*</h3>*}
                {*</div>*}
                {*<div class="panel-body">*}
                    {*{if $reminder->getType() === 'text'}*}
                        {*{$reminder->content}*}
                    {*{else}*}
                        {*{foreach from=$reminder->content item=todo}*}
                            {*<input type="checkbox" class="form-control" {if ( intval( $todo.completed ) === 1 )}checked="checked"{/if} disabled="disabled" style="display:inline; vertical-align:bottom;" />&nbsp;{$todo.content}<br />*}
                        {*{/foreach}*}
                    {*{/if}*}
                {*</div>*}
                {*<div class="panel-footer">*}
                    {*{if $reminder->tags}*}
                        {*Tags: {", "|implode:$reminder->tags}*}
                    {*{/if}*}
                {*</div>*}
            {*</div>*}

        {*{/foreach}*}
    {*{/if}*}

    {*{$paginator}*}
</div>