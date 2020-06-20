<div class="container text-center">
    <h1>ИС Библиотека - абонемент</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-4">
                    <a href="#/readers">
                        <img src="./images/readers.png" alt="Читатели" />
                        <div>Читатели</div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#/books">
                        <img src="./images/books.png" alt="Книги"/>
                        <div>Книги</div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#/loans">
                        <img src="./images/loans.png" alt="Выданные книги"/>
                        <div>Выданные книги</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<style lang="scss">
    @import "../scss/var";

	h1 {
		margin-bottom: $margin * 3;
    }
    
    a {
        text-decoration: none;
        color: $font-color;
        &:hover {
            color: $hover-color;
        }
    }
</style>