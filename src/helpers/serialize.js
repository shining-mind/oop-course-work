export default function serialize(object) {
    return Object.keys(object)
        .map(key => key + "=" + encodeURIComponent(object[key])).join('&');
}