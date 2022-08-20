import LibraryService from './../../services/library';

export default class BookService extends LibraryService {
    constructor() {
        super({
            url: '/auth',
        });
    }


    login = payload => this.axios.post(`/login`, payload);
    getUser = payload => this.axios.get(`/get-user`, {
        params: payload
    });
}
