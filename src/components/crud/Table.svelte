<script>
    export let columns = [];
</script>
<div class="table-responsive">
    <table class="table table-striped ">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                {#each columns as column}
                    <th>{column}</th>
                {/each}
                <th class="controls"></th>
            </tr>
        </thead>
        <tbody>
            <slot></slot>
        </tbody>
    </table>
</div>
<style lang="scss">
    @import "../../scss/var";
    
    .controls {
        width: 10%;
    }
</style>