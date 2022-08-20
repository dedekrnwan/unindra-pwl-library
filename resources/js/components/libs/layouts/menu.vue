<template>
    <a-menu
        v-model:openKeys="openKeys"
        v-model:selectedKeys="selectedKeys"
        mode="inline"
        theme="dark"
    >
        <router-link :to="{name: item.name}" v-for="(item, i) in items" :key="i" >
            <a-menu-item v-if="show(item)" :key="'menu'+i">
                <!--            <pie-chart-outlined />-->
                <span>{{ item.title }}</span>
            </a-menu-item>
        </router-link>
<!--        <a-sub-menu key="sub1">-->
<!--            <template #title>-->
<!--                            <span>-->
<!--                              <user-outlined />-->
<!--                              <span>User</span>-->
<!--                            </span>-->
<!--            </template>-->
<!--            <a-menu-item key="3">Tom</a-menu-item>-->
<!--            <a-menu-item key="4">Bill</a-menu-item>-->
<!--            <a-menu-item key="5">Alex</a-menu-item>-->
<!--        </a-sub-menu>-->
<!--        <a-sub-menu key="sub2">-->
<!--            <template #title>-->
<!--                            <span>-->
<!--                              <team-outlined />-->
<!--                              <span>Team</span>-->
<!--                            </span>-->
<!--            </template>-->
<!--            <a-menu-item key="6">Team 1</a-menu-item>-->
<!--            <a-menu-item key="8">Team 2</a-menu-item>-->
<!--        </a-sub-menu>-->
    </a-menu>
</template>

<script>

import {mapGetters} from "vuex";

export default  {
    name: 'Menu',
    data: () => ({
        selectedKeys: ['menu-0'],
        openKeys: [],
        items: [
            {
                title: 'Dashboard',
                name: 'dashboard.index',
                middlewares: ['auth'],
            },
            {
                title: 'Books',
                name: 'book.index',
                middlewares: ['auth'],

            },
            {
                title: 'Users',
                name: 'user.index',
                // name: 'book.index'
                middlewares: ['auth', 'admin'],
            },
            {
                title: 'Borrowed Books',
                name: 'userLoan.index',
                middlewares: ['auth', 'admin'],

                // name: 'book.index'
            },
            {
                title: 'History Lost Books',
                name: 'bookTurnover.index',
                middlewares: ['auth', 'admin'],

                // name: 'book.index'
            },
        ]
    }),
    computed: {
        ...mapGetters({
            isAdmin: 'auth/isAdmin',
        }),
    },
    methods: {
        show(item) {
            if (item?.middlewares?.includes("admin")) {
                return this.isAdmin
            }
            return true
        }
    },
    watch: {

    }
}
</script>
