<script>
    export let id;
    export let label;
</script>

<div class="form-group">
    <label for={id}>{label}</label>
    <slot></slot>
</div>