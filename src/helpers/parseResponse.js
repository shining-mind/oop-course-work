/**
 * @param {Response} response 
 */
export default async function parseResponse(response) {
    let data;
    try {
        data = await response.json()
    } catch (e) {}
    if (response.ok) {
        return { success: true, data };
    }
    let error = new Error('Произошла непредвиденная ошибка');
    switch (response.status) {
        case 422:
            error = new Error('Неверные входные данные');
            data = { wrongFields: data };
            break;
        case 404:
            error = new Error('Ресурс не найден');
            break;
    } 
    return { success: false, error, data };
}