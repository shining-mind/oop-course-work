<script>
    import { onMount, afterUpdate } from 'svelte';
    import Icon from 'fa-svelte';
    import { faPlusCircle, faTrashAlt, faEdit, faTrashRestoreAlt } from '@fortawesome/free-solid-svg-icons';
    import Table from './Table.svelte';
    import Confirm from '../modals/Confirm.svelte';
    import Pagination from '../Pagination.svelte';
    import formDataToObject from '../../helpers/formDataToObject';
    import { push } from 'svelte-spa-router'
    export let title;
    export let columns;
    export let entityManager;
    export let Form;
    export let currentPage = 1;
    export let supportsTrash = false;
    let pending = false;
    let withTrashed = false;
    let showConfirm = false;
    let loadedHash = null;
    let currentEntity;
    let currentOperation;
    let errorMessage;
    let list;

    function reset() {
        currentEntity = null;
        errorMessage = null;
        list = null;
        loadedHash = null;
        currentOperation = null;
    }

    function setError(error) {
        errorMessage = error && error.message;
    }
    
    function setPending(value) {
        pending = value;
    }

    async function reload(force = false) {
        const newHash = `${currentPage}${withTrashed}`;
        if (loadedHash === newHash && !force) {
            return;
        }
        setPending(true);
        reset();
        loadedHash = newHash;
        try {
            list = await entityManager.read(currentPage, { withTrashed });
        } catch (error) {
            errorMessage = error.message;
        } finally {
            setPending(false);
        }
    }

    function add(e) {
        e.preventDefault();
        currentEntity = {};
    }

    function edit(entity) {
        return (e) => {
            e.preventDefault();
            currentEntity = entity;
            currentOperation = 'edit';
        };
    }

    function del(entity) {
        return (e) => {
            e.preventDefault();
            currentEntity = entity;
            currentOperation = 'delete';
            showConfirm = true;
        };
    }

    function restore(entity) {
        return async (e) => {
            e.preventDefault();
            setPending(true);
            const { success, error } = await entityManager.restore(entity);
            if (success) {
                reload(true);
            } else {
                setError(error);
                setPending(false);
            }
        };
    }
    
    async function onDelete() {
        if (currentEntity) {
            setPending(true);
            const { success, error } = await entityManager.delete(currentEntity);
            if (success) {
                reload(true);
            } else {
                setError(error);
                setPending(false);
            }
        }
    }

    function submitEdit(e) {
        return entityManager.edit({
            ...currentEntity,
            ...formDataToObject(new FormData(e.target))
        });
    }
    
    function submitCreate(e) {
        return entityManager.create(formDataToObject(new FormData(e.target)));
    }
    
    function handleGoToHome(e) {
        e.preventDefault();
        if (currentEntity) {
            reset();
        } else {
            push('#/');
        }
    }
    onMount(() => {
        reload();
    });

    afterUpdate(() => {
        reload();
    });
</script>
<div class="panel">
    <h1>
        <a href="#/" class="home-link" on:click={handleGoToHome}>↼</a>
        {@html title}
        <span on:click={add}><Icon icon={faPlusCircle} class="add" /></span>
    </h1>
</div>
{#if supportsTrash}
    <div class="filter form-inline">
        <div class="form-group">
            <input type="checkbox" id="with-trashed" on:change={() => withTrashed = !withTrashed} checked={withTrashed} />
            <label for="with-trashed">Показать удаленные</label>
        </div>
    </div>
{/if}
{#if errorMessage}
    <div class="alert alert-danger">{errorMessage}</div>
{:else if currentEntity && currentOperation !== 'delete'}
    <svelte:component
        this={Form}
        bind:entity={currentEntity}
        cancel={() => currentEntity = null}
        submit={currentEntity.id ? submitEdit : submitCreate}
        on:done={reload}
        on:error={(e) => setError(e.detail.error)}
    />
{:else if pending}
    <!-- TODO: add overlay -->
    <Table {columns}>
        <tr><td colspan={columns.length + 2}><p>Идёт загрузка ожидайте...</p></td></tr>
    </Table>
{:else if list}
    <Table {columns}>
        {#if list.entities.length === 0}
            <tr><td colspan={columns.length + 2}><p>Нет записей</p></td></tr>
        {/if}
        {#each list.entities as entity, i}
            <tr>
            {#each list.values[i] as value}
                <td>{value}</td>
            {/each}
            <td class="controls">
                <span on:click={edit(entity)} class:disabled={pending}><Icon icon={faEdit} class="edit" /></span>
                {#if entity.deleted}
                    <span on:click={restore(entity)} class:disabled={pending}><Icon icon={faTrashRestoreAlt} class="restore" /></span>
                {:else}
                    <span on:click={del(entity)} class:disabled={pending}><Icon icon={faTrashAlt} class="delete" /></span>
                {/if}
            </td>
            </tr>
        {/each}
    </Table>
    {#if list.entities.length > 0}
        <Pagination {...list.pagination} />
    {/if}
{/if}
<Confirm bind:isOpen={showConfirm} text="Вы уверены что хотите удалить эту запись?" on:confirm={onDelete} on:cancel={() => currentEntity = null} />
<style lang="scss">
    @import "../../scss/var";
    h1 {
        display: inline-block;
    }

    .filter {
        padding-bottom: $padding;
        .form-group {
            margin-right: $margin;
        }

        input + label {
            margin-left: $margin * 0.5;
        }

        [type=checkbox], [type=checkbox] + label {
            cursor: pointer;
        }
    }

    .panel {
        text-align: center;
        padding-top: $padding;
        padding-bottom: $padding;
    }
    .controls {
        text-align: right;
        span {
            cursor: pointer;
        }
        .disabled {
            cursor: default;
        }
    }
    p {
        text-align: center;
    }
    :global(.add) {
        cursor: pointer;
        font-size: 0.8em;
        margin: 0 $margin;
        &:hover {
            color: $primary;
        }
    }
    :global(.edit, .delete, .restore) {
        margin: 0 $margin * 0.5;
    }
    :global(.edit:hover) {
        color: $warning;
    }

    :global(.delete:hover) {
        color: $danger;
    }

    :global(.restore:hover) {
        color: $success;
    }
</style>