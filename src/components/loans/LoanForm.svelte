<script>
    import { endpoint } from '../../env';
    import { bookToString, readerToString } from './';
    import Form from '../crud/Form.svelte';
    import FormField from '../crud/FormField.svelte';
    import { TextInput, NumberInput, AutocompleteInput } from '../crud/inputs';
    export let cancel;
    export let submit;
    export let entity = {};
    let {
        expires_in = 90,
        firstname = '',
        patronymic = '',
        book,
        reader
    } = entity;
    let wrongFields = {};
    function onError(e) {
        ({ wrongFields } = e.detail);
    }
    function createDataProvider(route, mutator) {
        return async (query) => {
            const response = await fetch(`${endpoint}${route}/search?query=${query}`);
            if (response.ok) {
                return (await response.json()).map(x => mutator(x));
            }
            return [];
        };
    }


</script>
<Form {cancel} {submit} on:error={onError} on:done>
    <FormField id="expires_at" label="На сколько дней выдать" error={wrongFields.expires_at}>
        <NumberInput id="expires_at" name="expires_at" value={expires_in} min={1} max={180} />
    </FormField>
    <FormField id="book_id" label="Книга" error={wrongFields.book_id}>
        <AutocompleteInput
            id="book_id"
            name="book_id"
            value={book ? book.id : null}
            text={book ? bookToString(book) : null}
            dataProvider={createDataProvider('/books', book => ({ text: bookToString(book), value: book.id }))}
        />
    </FormField>
    <FormField id="reader_id" label="Читатель" error={wrongFields.reader_id}>
        <AutocompleteInput
            id="reader_id"
            name="reader_id"
            value={reader ? reader.id : null}
            text={reader ? readerToString(reader) : null}
            dataProvider={createDataProvider('/readers', reader => ({ text: readerToString(reader), value: reader.id }))}
        />
    </FormField>
</Form>