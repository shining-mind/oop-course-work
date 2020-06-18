export default function formDataToObject(formData) {
    let object = {};
    if (formData instanceof FormData) {
        formData.forEach((value, key) => object[key] = value);
    } else {
        throw new TypeError('Не удалось преобразовать данные формы');
    }
    return object;
}