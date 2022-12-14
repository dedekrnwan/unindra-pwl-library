import { createStore } from "vuex";
import UserLoanService from "./service";
import * as constants from './../../constants'
import moment from "moment";

const service = new UserLoanService()

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
        return: ({commit, dispatch}, id) => new Promise(async (resolve, reject) => {
            try {
                commit(constants.PROMISE_START)
                const response = await service.update(id, {
                    status: "returned"
                })
                dispatch('get')
                resolve(response)
            } catch (error) {
                reject(error)
            } finally {
                commit(constants.PROMISE_DONE)
            }
        }),
        lost: ({commit, dispatch}, id) => new Promise(async (resolve, reject) => {
            try {
                commit(constants.PROMISE_START)
                const response = await service.update(id, {
                    status: "lost"
                })
                dispatch('get')
                resolve(response)
            } catch (error) {
                reject(error)
            } finally {
                commit(constants.PROMISE_DONE)
            }
        }),
        borrow: (ctx, payload) => new Promise(async (resolve, reject) => {
            try {
                ctx.commit(constants.PROMISE_START)
                const response = await service.create({
                    effective_date: moment().format("DD-MM-YYYY"),
                    expired_date: moment().add(7, 'days').format("DD-MM-YYYY"),
                    user_id: ctx.rootState.auth.user.id,
                    book_id: payload.book_id,
                    quantity: 1,
                })
                ctx.dispatch('get')
                resolve(response)
            } catch (error) {
                reject(error)
            } finally {
                ctx.commit(constants.PROMISE_DONE)
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
