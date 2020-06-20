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
<input class="form-control" id={id} bind:value={text} on:input={handleInput} autocomplete="off">
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
    @import "../../../scss/var";

    .search-box {
        margin-top: $margin;
    }

    .search-box ul {
        list-style: none;
        padding: 0;
    }

    .search-box li {
        height: $input-height;
        padding: $input-padding-y $input-padding-x;
        line-height: $input-line-height;
        border: 1px solid $gray-300;
        border-collapse: collapse;
        border-bottom: none;
        cursor: pointer;
        &:hover {
            background-color: $focus-color !important;
        }
        &:first-child {
            @include border-top-radius($input-border-radius);
        }

        &:last-child {
            @include border-bottom-radius($input-border-radius);
            border-bottom: 1px solid $gray-300;
        }

        &:nth-child(n) {
            background-color: white;
        }
        &:nth-child(2n) {
            background-color: whitesmoke;
        }
    }
</style>