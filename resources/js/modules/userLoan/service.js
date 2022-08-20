import LibraryService from './../../services/library';

export default class BookService extends LibraryService {
    constructor() {
        super({
            url: '/user-loans',
        });
    }
}
