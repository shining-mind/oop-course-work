<script>
    export let currentPage;
    export let lastPage;
    export let from;
    export let to;
    export let total;
    export let route = '/';
  
    function range(size, startAt = 0) {
        return [...Array(size).keys()].map(i => i + startAt);
    }
</script>
<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item {currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#{route}/{currentPage - 1}">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        {#each range(lastPage, 1) as page}
        <li class="page-item {page === currentPage ? 'active': ''}">
            <a class="page-link" href="#{route}/{page}">{page}</a>
        </li>
        {/each}
        <li class="page-item {currentPage === lastPage ? 'disabled' : ''}">
        <a class="page-link" href="#{route}/{currentPage + 1}">
            <span aria-hidden="true">&raquo;</span>
        </a>
        </li>
    </ul>
</nav>
<p class="text-center">
    Страница <code>{currentPage}</code> из <code>{lastPage}</code>
    {#if from && to }
        (показано с <code>{from}</code> по <code>{to}</code> из <code>{total}</code>)
    {/if}
</p>