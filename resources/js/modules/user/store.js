import { createStore } from "vuex";
import UserService from "./service";
import * as constants from './../../constants'

const service = new UserService()

export default {
    namespaced: true,
    state: {
        items: [],
        loading: false
    },
    getters: {},
    actions: {
        get: ({commit}, payload) => new Promise(async (resolve, reject) => {
            try {
                commit(constants.PROMISE_START)
                const response = await service.get(payload)
                commit(constants.SET_ITEMS, response?.data?.data || [])
                resolve(response)
            } catch (error) {
                commit(constants.SET_ITEMS,[])
                reject(error)
            } finally {
                commit(constants.PROMISE_DONE)
            }
        }),
        update: ({commit}, payload) => new Promise(async (resolve, reject) => {
            try {
                commit(constants.PROMISE_START)
                const response = await service.update(payload.id, payload)
                resolve(response)
            } catch (error) {
                reject(error)
            } finally {
                commit(constants.PROMISE_DONE)
            }
        }),
        create: ({commit}, payload) => new Promise(async (resolve, reject) => {
            try {
                commit(constants.PROMISE_START)
                const response = await service.create(payload)
                resolve(response)
            } catch (error) {
                reject(error)
            } finally {
                commit(constants.PROMISE_DONE)
            }
        }),
        delete: ({commit, dispatch}, payload) => new Promise(async (resolve, reject) => {
            try {
                commit(constants.PROMISE_START)
                let response = await service.delete(payload)
                dispatch('get')
                resolve(response)
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
        [constants.SET_ITEMS](state, items) {
            state.items = items;
        },
    },
}
