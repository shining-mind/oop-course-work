<script>
    import { endpoint } from '../env';
    import EntityManager from '../helpers/EntityManager';
    import List from '../components/crud/List.svelte';
    import ReaderForm from '../components/books/ReaderForm.svelte';
    export let params = {}
    const entityManager = new EntityManager('/readers', {
        getValuesFromEntity: x => [x.id, x.lastname, x.firstname, x.patronymic || ''],
    });
    const columns = ['Фамилия', 'Имя', 'Отчество'];
</script>
<div class="container">
    <List
        title="Читатели"
        Form={ReaderForm}
        entityManager={entityManager}
        {columns}
        currentPage={params.page || 1}
    />
</div>

