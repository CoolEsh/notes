{$errors = $form->getMessages()}

<div class="container">

    <h1>Add text note</h1>

    {if $errors}
        <div class="alert alert-danger">
            {foreach from=$errors item=elementErrors}
                {if $elementErrors}
                    {'; '|implode:$elementErrors}.<br />
                {/if}
            {/foreach}
        </div>
    {/if}

    <form class="form-horizontal" action="" method="POST">
        <div class="form-group">
            <label for="note-title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                {$form->getElement( 'title' )->render()}
            </div>
        </div>
        <div class="form-group">
            <label for="note-content" class="col-sm-2 control-label">Message</label>
            <div class="col-sm-10">
                {$form->getElement( 'content' )->render()}
            </div>
        </div>
        <div class="form-group">
            <label for="note-tags" class="col-sm-2 control-label">Tags</label>
            <div class="col-sm-10">
                {$form->getElement( 'tags' )->render()}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a href="javascript:;" class="btn btn-success form-submit">Add text note</a>
                <a href="/" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </form>

</div>