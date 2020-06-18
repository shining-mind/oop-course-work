<script>
    import { endpoint } from '../env';
    import EntityManager from '../helpers/EntityManager';
    import List from '../components/crud/List.svelte';
    import BookForm from '../components/books/BookForm.svelte';
    export let params = {};
    const entityManager = new EntityManager('/books', {
        getValuesFromEntity: x => [x.id, x.name, x.author, `${x.condition} %`],
    });
    const columns = ['Название', 'Автор', 'Состояние'];
</script>
<div class="container">
    <List
        title="Список книг"
        Form={BookForm}
        entityManager={entityManager}
        {columns}
        currentPage={params.page || 1}
    />
</div>

