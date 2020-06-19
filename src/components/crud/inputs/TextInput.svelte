<script>
    export let value;
    export let id;
    export let name;
</script>
<input type="text" class="form-control" name={name} bind:value={value} id={id} autocomplete="off" />