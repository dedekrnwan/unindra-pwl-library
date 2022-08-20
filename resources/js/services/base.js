import axios from 'axios';

export default class BaseService {
    constructor(opt = {}) {
        this.options = {
            baseUrl: "localhost:3000",
        };
        this.axios = this.init(opt);
    }

    init = (opt = {}) => {
        //opt
        if (opt) {
            this.options.baseUrl = opt.baseUrl || this.options.baseUrl;
            this.options.token = opt.token || this.options.token;
            this.options.axios = opt.axios || this.options.axios;
            this.options.service = opt.service || this.options.service;
            this.options.url = opt.url || this.options.url;
        }
        //setup axios instance options
        if (this.options.axios) {
            this.options.axios.baseURL = `${this.options.baseUrl}${this.options.url || ''}`;
            this.options.axios.headers['Content-Type'] = 'application/json';
        }
        //set token in header
        if (this.options.token) {
            this.addHeader('Authorization', `Bearer ${this.options.token}`);
        }
        //creating axios instance
        this.axios = axios.create(this.options.axios);

        return this.axios;
    };

    addHeader = (key, value) => {
        if (this.options.axios) {
            this.options.axios.headers[key] = value;
        } else {
            this.options.axios = {
                headers: {
                    [key]: value,
                },
            };
        }
    };
}
