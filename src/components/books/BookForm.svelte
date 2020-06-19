<script>
    import Form from '../crud/Form.svelte';
    import FormField from '../crud/FormField.svelte';
    import { NumberInput, TextInput } from '../crud/inputs';
    export let cancel;
    export let submit;
    export let entity = {};
    let { name = '', author = '', condition = 100 } = entity;
    let wrongFields = {};
    function onError(e) {
        ({ wrongFields } = e.detail);
    }

</script>
<Form {cancel} {submit} on:error={onError} on:done>
    <FormField id="name" label="Название" error={wrongFields.name}>
        <TextInput id="name" name="name" value={name} />
    </FormField>
    <FormField id="author" label="Автор" error={wrongFields.author}>
        <TextInput id="author" name="author" value={author} />
    </FormField>
    <FormField id="condition" label="Состояние (от 0 до 100)" error={wrongFields.condition}>
        <NumberInput id="condition" name="condition" value={condition} min={0} max={100} />
    </FormField>
</Form>