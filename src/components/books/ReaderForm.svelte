<script>
    import Form from '../crud/Form.svelte';
    import FormField from '../crud/FormField.svelte';
    import { TextInput } from '../crud/inputs';
    export let cancel;
    export let submit;
    export let entity = {};
    let { lastname = '', firstname = '', patronymic = '' } = entity;
</script>
<Form {cancel} {submit} on:change on:done>
    <FormField id="lastname" label="Фамилия">
        <TextInput id="lastname" name="lastname" value={lastname} />
    </FormField>
    <FormField id="firstname" label="Имя">
        <TextInput id="firstname" name="firstname" value={firstname} />
    </FormField>
    <FormField id="patronymic" label="Отчество">
        <TextInput id="patronymic" name="patronymic" value={patronymic}  />
    </FormField>
</Form>