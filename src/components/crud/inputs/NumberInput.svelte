<script>
    export let value;
    export let id;
    export let name;
    export let step = 1;
    export let min = Number.MIN_SAFE_INTEGER;
    export let max = Number.MAX_SAFE_INTEGER;
</script>
<input type="number" class="form-control" name={name} value={value} id={id} step={step} min={min} max={max} />