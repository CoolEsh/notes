<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            {$reminder->getTitle()}
            <div class="pull-right">
                <a href="/note/update-todo/{$reminder->getId()}"><i class="glyphicon glyphicon-edit"></i></a>
                &nbsp;
                <a href="/note/delete-todo/{$reminder->getId()}"><i class="glyphicon glyphicon-trash"></i></a>
            </div>
        </h3>
    </div>
    <div class="panel-body">
        {foreach from=$reminder->getContent() item=todo}
            <input type="checkbox" class="form-control" {if ( intval( $todo->getCompleted() ) === 1 )}checked="checked"{/if} disabled="disabled" style="display:inline; vertical-align:bottom; margin-bottom:2px;" />&nbsp;{$todo->getContent()}<br />
        {/foreach}
    </div>
    <div class="panel-footer">
        {assign var=tags value=[]}
        {foreach from=$reminder->getTag() item=tag}
            {append var='tags' value=$tag->getName()}
        {/foreach}
        Tags: {if ( $tags )}{", "|implode:$tags}{else}-{/if}
    </div>
</div>