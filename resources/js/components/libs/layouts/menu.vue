<template>
    <a-menu
        v-model:openKeys="openKeys"
        v-model:selectedKeys="selectedKeys"
        mode="inline"
        theme="dark"
    >
        <router-link :to="{name: item.name}" v-for="(item, i) in items" :key="i">
            <a-menu-item :key="'menu'+i">
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

export default  {
    name: 'Menu',
    data: () => ({
        selectedKeys: ['menu-0'],
        openKeys: [],
        items: [
            {
                title: 'Dashboard',
                name: 'dashboard.index'
            },
            {
                title: 'Books',
                name: 'book.index'
            },
            {
                title: 'Users',
                name: 'user.index'
                // name: 'book.index'
            },
            {
                title: 'Borrowed Books',
                name: 'userLoan.index'
                // name: 'book.index'
            },
            {
                title: 'History Lost Books',
                name: 'bookTurnover.index'
                // name: 'book.index'
            },
        ]
    }),
    computed: {

    },
    methods: {

    },
    watch: {

    }
}
</script>
