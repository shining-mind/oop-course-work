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
    const result = {
        success: false,
    };
    switch (response.status) {
        case 422:
            error = new Error('Неверные входные данные');
            result.wrongFields = Object.keys(data).reduce((carry, key) => {
                carry[key] = data[key].join('<br>');
                return carry;
            }, {});
            break;
        case 404:
            error = new Error('Ресурс не найден');
            break;
    } 
    return { ...result, error, data };
}