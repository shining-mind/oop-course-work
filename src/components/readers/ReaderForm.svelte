<script>
    import Form from '../crud/Form.svelte';
    import FormField from '../crud/FormField.svelte';
    import { TextInput } from '../crud/inputs';
    export let cancel;
    export let submit;
    export let entity = {};
    let { lastname = '', firstname = '', patronymic = '' } = entity;
    let wrongFields = {};
    function onError(e) {
        ({ wrongFields } = e.detail);
    }
</script>
<Form {cancel} {submit} on:error on:done>
    <FormField id="lastname" label="Фамилия" error={wrongFields.lastname}>
        <TextInput id="lastname" name="lastname" value={lastname} />
    </FormField>
    <FormField id="firstname" label="Имя" error={wrongFields.firstname}>
        <TextInput id="firstname" name="firstname" value={firstname} />
    </FormField>
    <FormField id="patronymic" label="Отчество" error={wrongFields.patronymic}>
        <TextInput id="patronymic" name="patronymic" value={patronymic}  />
    </FormField>
</Form>