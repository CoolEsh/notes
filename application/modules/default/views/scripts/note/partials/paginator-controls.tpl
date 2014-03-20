{if $paginator.total_pages > 1}
    <ul class="pagination pull-right">
        <li {if $paginator.current_page === 1}class="disabled"{/if}><a href="{if $paginator.current_page !== 1}?page=1{else}javascript:;{/if}">First</a></li>
        {for $pageNum=1 to $paginator.total_pages}
            <li {if ( $pageNum === $paginator.current_page )}class="active"{/if}><a href="?page={$pageNum}">{$pageNum}</a></li>
        {/for}
        <li {if $paginator.current_page === $paginator.total_pages}class="disabled"{/if}><a href="{if $paginator.current_page !== $paginator.total_pages}?page={$paginator.total_pages}{else}javascript:;{/if}">Last</a></li>
    </ul>
    <div class="clearfix"></div>
{/if}