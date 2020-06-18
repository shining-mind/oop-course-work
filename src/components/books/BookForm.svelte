<script>
    import Form from '../crud/Form.svelte';
    import FormField from '../crud/FormField.svelte';
    import { NumberInput, TextInput } from '../crud/inputs';
    export let cancel;
    export let submit;
    export let entity = {};
    let { name = '', author = '', condition = 100 } = entity;
</script>
<Form {cancel} {submit} on:change on:done>
    <FormField id="name" label="Название">
        <TextInput id="name" name="name" value={name} />
    </FormField>
    <FormField id="author" label="Автор">
        <TextInput id="author" name="author" value={author} />
    </FormField>
    <FormField id="condition" label="Состояние (от 0 до 100)">
        <NumberInput id="condition" name="condition" value={condition} min={0} max={100} />
    </FormField>
</Form>