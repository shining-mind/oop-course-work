<script>
    import { createEventDispatcher } from 'svelte';
    import Modal from "sv-bootstrap-modal";
    export let title = 'Подтверждение';
    export let text = '';
    export let isOpen = false;
    const dispatch = createEventDispatcher();
    function handleClick(type) {
        isOpen = false;
        dispatch(type);
    }
</script> 
 
<Modal bind:open={isOpen}>
    <div class="modal-header">
        <h5 class="modal-title">{title}</h5>
    </div>
    <div class="modal-body">{text}</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" on:click={() => handleClick('cancel')}>Отмена</button>
        <button type="button" class="btn btn-primary" on:click={() => handleClick('confirm')}>Подтвердить</button>
    </div>
</Modal>