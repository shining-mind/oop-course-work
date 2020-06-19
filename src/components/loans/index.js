export function bookToString(book) {
    return book ? `${book.name} (${book.author})` : '*удалена*';
}
export function readerToString(reader) {
    return reader ? `${reader.lastname} ${reader.firstname} ${reader.patronymic}`.trim() : '*удален*';
}