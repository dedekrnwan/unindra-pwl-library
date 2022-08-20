<template>
    <div>
        <a-breadcrumb style="margin: 16px 0">
            <a-breadcrumb-item>Borrowed Books</a-breadcrumb-item>
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
                    <template v-else-if="column.key === 'effective_date'">
                        <span>
                          <a-tag
                              color="geekblue"
                          >
                            {{ record.effective_date }}
                          </a-tag>
                        </span>
                    </template>
                    <template v-else-if="column.key === 'expired_date'">
                        <span>
                          <a-tag
                              color="geekblue"
                          >
                            {{ record.expired_date }}
                          </a-tag>
                        </span>
                    </template>

                    <template v-else-if="column.key === 'return_date'">
                        <span>
                          <a-tag
                              color="geekblue"
                          >
                            {{ record.return_date }}

                          </a-tag>
                        </span>
                    </template>

                    <template v-else-if="column.key === 'status'">
                        <span>
                          <a-tag
                              color="geekblue"
                          >
                            {{ record.status }}
                          </a-tag>
                        </span>
                    </template>

                    <template v-else-if="column.key === 'action'">
                        <span>
                          <a-divider type="vertical" />
                            <a-popconfirm
                                 v-if="record.status == 'borrowed'"
                                 title="Are you sure complete this borrow data?"
                                 ok-text="Yes"
                                 cancel-text="No"
                                 @confirm="confirmReturn(record)"
                            >
                                <a>Return</a>
                            </a-popconfirm>
                          <a-divider type="vertical" />
                            <a-popconfirm
                                v-if="record.status == 'borrowed'"
                                title="Are you sure losting this borrow data?"
                                ok-text="Yes"
                                cancel-text="No"
                                @confirm="confirmLost(record)"
                            >
                                <a>Lost</a>
                            </a-popconfirm>
<!--                          <a class="ant-dropdown-link">-->
<!--                            More actions-->
<!--                            <down-outlined />-->
<!--                          </a>-->
                        </span>
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
                title: 'Return Date',
                key: 'return_date',
                dataIndex: 'return_date',
            },
            {
                title: 'Status',
                key: 'status',
                dataIndex: 'status',
            },
            {
                title: 'Action',
                key: 'action',
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
            items: state => state.userLoan.items,
            loading: state => state.userLoan.loading,
        }),
    },
    methods: {
        ...mapActions({
            getItems: "userLoan/get",
            returnItem: "userLoan/return",
            lostItem: "userLoan/lost",
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
