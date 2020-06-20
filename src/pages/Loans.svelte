<script>
    import { endpoint } from '../env';
    import EntityManager from '../helpers/EntityManager';
    import List from '../components/crud/List.svelte';
    import { readerToString, bookToString } from '../components/loans'; 
    import LoanForm from '../components/loans/LoanForm.svelte';
    export let params = {};
    const entityManager = new EntityManager('/loans', {
        getValuesFromEntity: x => {
            return [
                x.id,
                bookToString(x.book),
                readerToString(x.reader),
                x.created_at_readable,
                x.expires_at_readable,
                x.expired ? 'Да' : 'Нет'
            ];
        }
    });
    const columns = ['Книга', 'Читатель', 'Выдана', 'Истекает', 'Просрочено'];
</script>
<div class="container">
    <List
        title="Список выданных книг"
        titleAdd="Выдать книгу"
        titleEdit="Изменить информацию о выдаче книги"
        Form={LoanForm}
        entityManager={entityManager}
        {columns}
        currentPage={params.page || 1}
    />
</div>

