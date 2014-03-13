{if $pageCount > 1}
    <ul class="pagination">
        <li {if $current === 1}class="disabled"{/if}><a href="{if $current !== 1}?page=1{else}javascript:;{/if}">First</a></li>
        {for $pageNum=1 to $pageCount}
            <li {if ( $pageNum === $current )}class="active"{/if}><a href="?page={$pageNum}">{$pageNum}</a></li>
        {/for}
        <li {if $current === $pageCount}class="disabled"{/if}><a href="{if $current !== $pageCount}?page={$pageCount}{else}javascript:;{/if}">Last</a></li>
    </ul>
{/if}