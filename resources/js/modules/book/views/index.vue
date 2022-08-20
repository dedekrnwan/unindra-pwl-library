<template>
    <div>
        <a-breadcrumb style="margin: 16px 0">
            <a-breadcrumb-item>Books</a-breadcrumb-item>
        </a-breadcrumb>
        <div :style="{ padding: '24px', background: '#fff', minHeight: '360px' }">

            <a-button @click="$router.push({name:'book.form'})" type="primary">Add More</a-button>
            <a-table :columns="columns" :data-source="items">
                <template #headerCell="{ column }">
                    <template v-if="column.key === 'name'">
                        <span>
                          <smile-outlined />
                          Name
                        </span>
                    </template>
                </template>

                <template #bodyCell="{ column, record }">
                    <template v-if="column.key === 'name'">
                        <a>
                            {{ record.name }}
                        </a>
                    </template>
                    <template v-else-if="column.key === 'publish_year'">
                        <span>
                          <a-tag
                              color="geekblue"
                          >
                            {{ record.publish_year }}
                          </a-tag>
                        </span>
                    </template>
<!--                    <template v-else-if="column.key === 'tags'">-->
<!--                        <span>-->
<!--                          <a-tag-->
<!--                              v-for="tag in record.tags"-->
<!--                              :key="tag"-->
<!--                              :color="tag === 'loser' ? 'volcano' : tag.length > 5 ? 'geekblue' : 'green'"-->
<!--                          >-->
<!--                            {{ tag.toUpperCase() }}-->
<!--                          </a-tag>-->
<!--                        </span>-->
<!--                    </template>-->
                    <template v-else-if="column.key === 'action'">
                        <span>
                          <a @click="$router.push({name: 'book.form', params: record})">Update</a>
                          <a-divider type="vertical" />
                            <a-popconfirm
                                 title="Are you sure delete this data?"
                                 ok-text="Yes"
                                 cancel-text="No"
                                 @confirm="confirmDelete(record)"
                            >
                                <a>Delete</a>
                            </a-popconfirm>
                          <a-divider type="vertical" />
                             <a-popconfirm
                                 title="Are you sure borrow this data?"
                                 ok-text="Yes"
                                 cancel-text="No"
                                 @confirm="confirmBorrow(record)"
                             >
                                <a>Delete</a>
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
                name: 'Name',
                dataIndex: 'title',
                key: 'title',
            },
            {
                title: 'Writer',
                dataIndex: 'writer',
                key: 'age',
            },
            {
                title: 'Publisher',
                dataIndex: 'publisher',
                key: 'publisher',
            },
            {
                title: 'Publish Year',
                key: 'publish_year',
                dataIndex: 'publish_year',
            },
            {
                title: 'Category',
                key: 'category',
                dataIndex: 'category',
            },
            {
                title: 'Stock',
                key: 'stock',
                dataIndex: 'stock',
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
            items: state => state.book.items,
            loading: state => state.book.loading,
        }),
    },
    methods: {
        ...mapActions({
            getItems: "book/get",
            borrowItem: "userLoan/borrow",
        }),
        async confirmBorrow(record) {
            try {
                await this.borrowItem(record)
            } catch (e) {
                sAlertError(this,e)
            }
        }
    },
    watch: {

    }
}
</script>
