<template>
    <div>
        <a-breadcrumb style="margin: 16px 0">
            <a-breadcrumb-item>History Lost Books</a-breadcrumb-item>
        </a-breadcrumb>
        <div :style="{ padding: '24px', background: '#fff', minHeight: '360px' }">

<!--            <a-button @click="$router.push({name:'userLoan.form'})" type="primary">Add More</a-button>-->
            <a-table :columns="columns" :data-source="items">
                <template #headerCell="{ column }">
                    <template v-if="column.key === 'user'">
                        <span>
                          <smile-outlined />
                          User
                        </span>
                    </template>
                </template>

                <template #bodyCell="{ column, record }">
                    <template v-if="column.key === 'user'">
                        <a>
                            {{ record.user.name }}
                        </a>
                    </template>

                    <template v-if="column.key === 'book'">
                        <a>
                            {{ record.book.title }}
                        </a>
                    </template>
                </template>
            </a-table>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import { sAlertError } from './../../../utils'


export default  {
    namespaced: true,
    data: () => ({
        columns: [
            {
                name: 'User',
                dataIndex: 'user.name',
                key: 'user',
            },
            {
                title: 'Book',
                dataIndex: 'book.title',
                key: 'book',
            },
            {
                title: 'Quantity',
                dataIndex: 'quantity',
                key: 'quantity',
            },

            {
                title: 'Cash Amount Returned',
                dataIndex: 'cash_amount',
                key: 'cash_amount',
            },
        ],
    }),
    async mounted() {
        try {
            await this.getItems()
        } catch (e) {
            console.error(e)
            sAlertError(this, e)
        }
    },
    computed: {
        ...mapState({
            items: state => state.bookTurnover.items,
            loading: state => state.bookTurnover.loading,
        }),
    },
    methods: {
        ...mapActions({
            getItems: "bookTurnover/get",
            returnItem: "bookTurnover/return",
            lostItem: "bookTurnover/lost",
        }),
        async confirmReturn(record) {
            try {
                await this.returnItem(record.id)
            } catch (e) {
                sAlertError(this,e)
            }
        },
        async confirmLost(record) {
            try {
                await this.returnItem(record.id)
            } catch (e) {
                sAlertError(this,e)
            }
        }

    },
    watch: {

    }
}
</script>
