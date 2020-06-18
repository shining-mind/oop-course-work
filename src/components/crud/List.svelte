<script>
    import Table from './Table.svelte';
    import Pagination from '../Pagination.svelte';
    import formDataToObject from '../../helpers/formDataToObject';
    import { onMount } from 'svelte';
    import { push } from 'svelte-spa-router'
    export let title;
    export let columns;
    export let entityManager;
    export let Form;
    let pending = false;
    let currentEntity = null;
    let currentPage;
    let errorMessage;
    let list;
    let promise = entityManager.read();
    function reset() {
        currentEntity = null;
        errorMessage = null;
        list = null;
    }
    function setError(error) {
        errorMessage = error.message;
    }
    function setPending(value) {
        pending = value;
    }
    async function reload() {
        setPending(true);
        reset();
        try {
            list = await entityManager.read(currentPage);
        } catch (error) {
            errorMessage = error.message;
        } finally {
            setPending(false);
        }
    }
    function handlePageChange(e) {
        currentPage = e.detail;
        reload();
    }
    function add(e) {
        e.preventDefault();
        currentEntity = {};
    }
    function edit(entity) {
        return (e) => {
            e.preventDefault();
            currentEntity = entity;
        };
    }
    function del(entity) {
        return async (e) => {
            e.preventDefault();
            setPending(true);
            const { success, error } = await entityManager.delete(entity);
            if (!success) {
                setError(error);
            } else {
                reload();
            }
        };
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
</script>
<div class="panel">
    <h1><a href="#/" class="home-link" on:click={handleGoToHome}>↼</a>{@html title}</h1>
    <button type="button" class="btn btn-info float-right" on:click={add}>Добавить</button>
</div>
{#if errorMessage}
    <div class="alert alert-danger">{errorMessage}</div>
{:else if currentEntity}
    <svelte:component
        this={Form}
        bind:entity={currentEntity}
        cancel={reset}
        submit={currentEntity.id ? submitEdit : submitCreate}
        on:done={reload}
        on:error={setError}
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
        <Pagination {...list.pagination} on:change={handlePageChange} />
    {/if}
{/if}
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