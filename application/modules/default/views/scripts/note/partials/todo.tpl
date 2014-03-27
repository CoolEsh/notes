<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            {$reminder->getTitle()}
            <div class="pull-right">
                <a href="/note/update-todo/{$reminder->getId()}"><i class="glyphicon glyphicon-edit"></i></a>
                &nbsp;
                <a class="delete-action" href="javascript:;" data-deleteurl="/note/delete/{$reminder->getId()}" data-title="Delete note" data-message="Do you really want to delete this to-do note?"><i class="glyphicon glyphicon-trash"></i></a>
            </div>
        </h3>
    </div>
    <div class="panel-body">
        <div class="pull-left">
            <img src="/note/get-text-image/{$reminder->getImage()}" width="50" height="50" />
        </div>
        <div class="pull-left" style="margin-left:15px;">
            {foreach from=$reminder->getTodoContent() item=todo}
                <input type="checkbox" class="form-control" {if ( intval( $todo->getCompleted() ) === 1 )}checked="checked"{/if} disabled="disabled" style="display:inline; vertical-align:bottom; margin-bottom:2px; width:16px; height:16px;" />&nbsp;{$todo->getContent()}<br />
            {/foreach}
        </div>
    </div>
    <div class="panel-footer">
        {assign var=tags value=[]}
        {foreach from=$reminder->getTag() item=tag}
            {append var='tags' value=$tag->getName()}
        {/foreach}
        Tags: {if ( $tags )}{", "|implode:$tags}{else}-{/if}
    </div>
</div>