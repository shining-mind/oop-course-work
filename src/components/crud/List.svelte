<script>
    import { onMount, afterUpdate } from 'svelte';
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
    let pending = false;
    let showConfirm = false;
    let loadedPage;
    let currentEntity;
    let currentOperation;
    let errorMessage;
    let list;

    function reset() {
        currentEntity = null;
        errorMessage = null;
        list = null;
        loadedPage = null;
        currentOperation = null;
    }

    function setError(error) {
        errorMessage = error && error.message;
    }
    
    function setPending(value) {
        pending = value;
    }

    async function reload(force = false) {
        if (loadedPage === currentPage && !force) {
            return;
        }
        setPending(true);
        reset();
        loadedPage = currentPage;
        try {
            list = await entityManager.read(currentPage);
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
    <h1><a href="#/" class="home-link" on:click={handleGoToHome}>↼</a>{@html title}</h1>
    <button type="button" class="btn btn-info float-right" on:click={add}>Добавить</button>
</div>
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
                <button type="button" class="btn btn-info" on:click={edit(entity)} disabled={pending}>Редактировать</button>
                <button type="button" class="btn btn-danger" on:click={del(entity)} disabled={pending}>Удалить</button>
            </td>
            </tr>
        {/each}
    </Table>
    {#if list.entities.length > 0}
        <Pagination {...list.pagination} />
    {/if}
{/if}
<Confirm bind:isOpen={showConfirm} text="Вы уверены что хотите удалить эту запись?" on:confirm={onDelete} />
<style>
    h1 {
        display: inline-block;
    }
    .panel {
        padding-top: 10px;
        padding-bottom: 30px;
    }
    .controls {
        text-align: right;
    }
    p {
        text-align: center;
    }
</style>