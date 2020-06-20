import { endpoint } from '../env';
import serialize from './serialize';
import parseResponse from './parseResponse';

export default class EntityManager {
    constructor(route, {
        getValuesFromEntity = (entity) => Object.values(entity),
    }) {
        this.route = route;
        this.getValuesFromEntity = getValuesFromEntity;
    }

    async create(entity) {
        const response = await fetch(`${endpoint}${this.route}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
            },
            body: serialize(entity)
        });
        return parseResponse(response);
    }

    async read(page, { withTrashed = false } = {}) {
        let url = `${endpoint}${this.route}`;
        const params = [];
        if (page) {
            params.push(`page=${page}`);
        }
        if (withTrashed) {
            params.push(`with_trashed=1`);
        }
        if (params.length) {
            url += '?' + params.join('&');
        }
        const { success, error, data } = await parseResponse(await fetch(url));
        if (success) {
            return {
                values: data.data.map((x) => this.getValuesFromEntity(x)),
                entities: data.data,
                pagination: {
                    currentPage: data.current_page,
                    lastPage: data.last_page,
                    from: data.from,
                    to: data.to,
                    total: data.total,
                    route: this.route
                }
            };
        }
        throw error;
    }

    async edit(entity) {
        return parseResponse(await fetch(`${endpoint}${this.route}/${entity.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
            },
            body: serialize(entity)
        }));
    }

    async delete(entity) {
        return parseResponse(await fetch(`${endpoint}${this.route}/${entity.id}`, {
            method: 'DELETE',
        }));
    }

    async restore(entity) {
        return parseResponse(await fetch(`${endpoint}${this.route}/${entity.id}`, {
            method: 'PATCH',
        }));
    }
}