<template>
    <div>
        <a-breadcrumb style="margin: 16px 0">
            <a-breadcrumb-item>Users</a-breadcrumb-item>
        </a-breadcrumb>
        <div :style="{ padding: '24px', background: '#fff', minHeight: '360px' }">

            <a-button @click="$router.push({name:'user.form'})" type="primary">Add More</a-button>
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
                            {{ record.email }}
                          </a-tag>
                        </span>
                    </template>
                    <template v-else-if="column.key === 'action'">
                        <span>
                          <a @click="$router.push({name: 'user.form', params: record})">Update</a>
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
                dataIndex: 'name',
                key: 'name',
            },
            {
                title: 'email',
                dataIndex: 'email',
                key: 'email',
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
            items: state => state.user.items,
            loading: state => state.user.loading,
        }),
    },
    methods: {
        ...mapActions({
            getItems: "user/get",
            deleteItem: "user/delete",
        }),
        async confirmDelete(record) {
            try {
                await this.deleteItem(record.id)
            } catch (e) {
                sAlertError(this,e)
            }
        }
    },
    watch: {

    }
}
</script>
