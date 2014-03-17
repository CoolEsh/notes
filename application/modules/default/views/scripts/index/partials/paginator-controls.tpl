{if $totalPages > 1}
    <ul class="pagination pull-right">
        <li {if $currentPage === 1}class="disabled"{/if}><a href="{if $currentPage !== 1}?page=1{else}javascript:;{/if}">First</a></li>
        {for $pageNum=1 to $totalPages}
            <li {if ( $pageNum === $currentPage )}class="active"{/if}><a href="?page={$pageNum}">{$pageNum}</a></li>
        {/for}
        <li {if $currentPage === $totalPages}class="disabled"{/if}><a href="{if $currentPage !== $totalPages}?page={$totalPages}{else}javascript:;{/if}">Last</a></li>
    </ul>
    <div class="clearfix"></div>
{/if}