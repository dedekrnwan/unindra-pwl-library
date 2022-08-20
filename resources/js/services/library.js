import BaseService from './base';

export default class LibraryService extends BaseService {
    constructor(opt = {}) {
        super({
            baseUrl: import.meta.env.VITE_API_URL,
            axios: {
                headers: {
                    Accept: 'application/json',
                },
            },
        });
        this.axios = this.init(opt);

        this.axios.interceptors.request.use(
            config => {
                return config;
            },
            error => Promise.reject(error),
        );
        this.axios.interceptors.response.use(
            res => Promise.resolve(res),
            err => Promise.reject(err.response),
        );

        delete this.options.axios.headers['Access-Control-Allow-Origin'];
    }

    get = (params = {}) =>
        this.axios.get('/', {
            params,
        });

    detail = id => this.axios.get(`/${id}`);

    create = payload => this.axios.post(`/`, payload);

    update = (id, payload) => this.axios.patch(`/${id}`, payload);

    delete = id => this.axios.delete(`/${id}`);
}
