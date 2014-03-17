<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            {$reminder->getTitle()}
            <div class="pull-right">
                <a href="/note/update/id/{$reminder->getId()}"><i class="glyphicon glyphicon-edit"></i></a>
                &nbsp;
                <a href="/note/delete/id/{$reminder->getId()}"><i class="glyphicon glyphicon-trash"></i></a>
            </div>
        </h3>
    </div>
    <div class="panel-body">
        {foreach from=$reminder->getContent() item=content}
            {$content->getContent()}
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