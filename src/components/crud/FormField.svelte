<script>
    export let id;
    export let label;
    export let error;
</script>

<div class="form-group">
    <label for={id}>{label}</label>
    <slot></slot>
    {#if error}
        <small class="text-danger">{error}</small>
    {/if}
</div>