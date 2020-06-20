<script>
    export let value;
    export let id;
    export let name;
    export let prefix = '';
    export let postfix = '';
    export let step = 1;
    export let min = Number.MIN_SAFE_INTEGER;
    export let max = Number.MAX_SAFE_INTEGER;
</script>
{@html prefix}<span>{value}</span>{@html postfix}
<input type="range" class="form-control-range" name={name} bind:value={value} id={id} step={step} min={min} max={max} />