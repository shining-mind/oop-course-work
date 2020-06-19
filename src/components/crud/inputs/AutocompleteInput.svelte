<script>
    import debounce from 'lodash.debounce'
    export let id;
    export let name;
    export let value;
    export let text;
    export let dataProvider;
    if (typeof dataProvider !== 'function') {
        throw new TypeError('Expected data provider to be a function');
    }
    let promise;
    const handleInput = debounce(e => {
        if (e.target.value) {
            promise = dataProvider(e.target.value);
        }
    }, 500)
    const onClick = (newValue, newText) => {
        return (e) => {
            value = newValue;
            text = newText;
            promise = null;
        };
    };
</script>
<input class="form-control" id={id} bind:value={text} autocomplete=off on:input={handleInput}>
<input type="hidden" bind:value={value} name={name} />
{#if promise}
    <div class="search-box">
    {#await promise}
        <p>Поиск...</p>
    {:then options}
        {#if options}
            {#if options.length}
                <ul>
                    {#each options as option}
                        <li on:click={onClick(option.value, option.text)}>{option.text}</li>
                    {/each}
                </ul>
            {:else}
                <p>Результаты не найдены</p>
            {/if}
        {/if}
    {/await}
    </div>
{/if}


<style lang="scss">
    .search-box {
        margin-top: 10px;
    }
    .search-box ul {
        list-style: none;
        padding: 0;
    }
    .search-box li {
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        line-height: 1.5;
        cursor: pointer;
        &:hover {
            background-color: lightskyblue !important;
        }
        &:nth-child(n) {
            background-color: white;
        }
        &:nth-child(2n) {
            background-color: whitesmoke;
        }
    }
</style>