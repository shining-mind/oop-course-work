<script>
    import { createEventDispatcher } from 'svelte';
    export let submit;
    export let cancel;
    let pending = false;
    let errorMessage;
    const dispatch = createEventDispatcher();
    if (typeof submit !== 'function') {
        throw new TypeError('Expected form submit to be a function');
    }
    if (typeof cancel !== 'function') {
        throw new TypeError('Expected form cancel to be a function');
    }
    async function handleSubmit(e) {
        errorMessage = null;
        if (pending) {
            return;
        }
        pending = true;
        const result = await submit(e);
        pending = false;
        if (result.success) {
            dispatch('done', result);
        } else {
            if (result.error) {
                errorMessage = result.error.message;
            }
            dispatch('error', result);
        }
    }
</script>
{#if errorMessage}
    <div class="alert alert-danger">{errorMessage}</div>
{/if}
<form on:submit|preventDefault={handleSubmit}>
    <div class="form-body">
        <slot></slot>
    </div>
    <div class="form-footer">
        <div class="text-right">
            <button type="button" class="btn btn-secondary" on:click={cancel} disabled={pending}>Отмена</button>
            <button type="submit" class="btn btn-primary" disabled={pending}>Сохранить</button>
        </div>
    </div>
</form>
<style lang="scss">
    form {
        padding: 20px 40px;
        background-color: #fefefe;
        border: 1px solid #aeaeae;
        border-radius: 5px;
    }
</style>