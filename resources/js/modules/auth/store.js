import { createStore } from "vuex";
import BookService from "./service";
import * as constants from './../../constants'

const service = new BookService()

const SET_TOKEN = 'SET_TOKEN'
const SET_AUTH = 'SET_AUTH'
const SET_USER = 'SET_USER'

export default {
    namespaced: true,
    state: {
        authenticated: !!localStorage.getItem('token'),
        token: localStorage.getItem('token') || null,
        user: localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : null,
        loading: false
    },
    getters: {
        isLoggedIn: state => !!state.authenticated,
        isAdmin: state => state.user?.is_admin,
    },
    actions: {
        login: ({commit, dispatch}, payload) => new Promise(async (resolve, reject) => {
            try {
                commit(constants.PROMISE_START)
                const response = await service.login(payload)
                localStorage.setItem('token', response?.data?.data?.token)
                commit(SET_TOKEN, response?.data?.data?.token || null)
                commit(SET_AUTH)
                dispatch('getUser')
                resolve(response)
            } catch (error) {
                commit(SET_TOKEN,null)
                reject(error)
            } finally {
                commit(constants.PROMISE_DONE)
            }
        }),
        getUser: ({commit, state}) => new Promise(async (resolve, reject) => {
            try {
                commit(constants.PROMISE_START)
                const response = await service.getUser({
                    token: state.token
                })
                localStorage.setItem('user', JSON.stringify(response?.data?.data))
                commit(SET_USER, response?.data?.data || null)
                resolve(response)
            } catch (error) {
                commit(SET_TOKEN,null)
                reject(error)
            } finally {
                commit(constants.PROMISE_DONE)
            }
        }),
        logout: ({commit, dispatch}) => new Promise(async (resolve, reject) => {
            try {
                commit(constants.PROMISE_START)
                localStorage.clear()
                commit(SET_USER, null)
                commit(SET_TOKEN,null)
                commit(SET_AUTH)
                resolve({})
            } catch (error) {
                reject(error)
            } finally {
                commit(constants.PROMISE_DONE)
            }
        }),
    },
    mutations: {
        [constants.PROMISE_START](state) {
            state.loading = true;
        },
        [constants.PROMISE_DONE](state) {
            state.loading = false;
        },
        [constants.ERROR](state, error) {
            state.error = error;
        },
        [SET_TOKEN](state, value) {
            state.token = value;
        },
        [SET_AUTH](state) {
            state.authenticated = !state.authenticated;
        },
        [SET_USER](state, value) {
            state.user = value;
        },

    },
}
