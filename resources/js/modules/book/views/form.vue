<template>
    <a-breadcrumb style="margin: 16px 0">
        <a-breadcrumb-item>Books Form</a-breadcrumb-item>
    </a-breadcrumb>

    <div :style="{ padding: '24px', background: '#fff', minHeight: '360px' }">
        <a-form
            :model="formState"
            :rules="formRules"
            name="book.form"
            v-bind="formItemLayout"
            @finish="submit"
        >
            <a-form-item
                label="Title"
                name="title"
            >
                <a-input v-model:value="formState.title" />
            </a-form-item>

            <a-form-item
                label="Writer"
                name="writer"
            >
            <a-input v-model:value="formState.writer" />
            </a-form-item>
            <a-form-item
                label="Publisher"
                name="publisher"
            >
                <a-input v-model:value="formState.publisher" />
            </a-form-item>
            <a-form-item
                label="Publish Year"
                name="publish_year"
                :rules="[{ required: true, message: 'Please input publish year!' }]"
            >
                <a-input-number  v-model:value="formState.publish_year" :min="1000" />
            </a-form-item>
            <a-form-item
                label="Category"
                name="category"
            >
                <a-input v-model:value="formState.category" />
            </a-form-item>
            <a-form-item
                label="Stock"
                name="stock"
                :rules="[{ required: true, message: 'Please input stock!' }]"
            >
                <a-input-number v-model:value="formState.stock" :min="1" />
            </a-form-item>
            <a-form-item
                label="Price"
                name="price"
            >
                <a-input-number v-model:value="formState.price" :min="1000"/>
            </a-form-item>

            <a-form-item :wrapper-col="{ span: 12, offset: 6 }">
                <a-button type="primary" html-type="submit">Submit</a-button>

                <a-button style="margin-left: 10px" type="secondary" @click="$router.push({name: 'book.index'})" >Cancel</a-button>
            </a-form-item>
        </a-form>
    </div>
</template>

<script>
import { sAlertError, sAlertSuccess } from './../../../utils'
import { mapState, mapActions } from 'vuex'
import { Form } from 'ant-design-vue';

const useForm = Form.useForm;

export default  {
    namespaced: true,
    data: () => ({
        formState: {
            id: null,
            title: null,
            writer: null,
            publisher: null,
            publish_year: null,
            stock: null,
            category: null,
            price: null,
        },
        formItemLayout: {
            labelCol: { span: 6 },
            wrapperCol: { span: 14 },
        },
        formRules: {
            title: { required: true, message: 'Please input title!' },
            writer: { required: true, message: 'Please input writer!' },
            publisher: { required: true, message: 'Please input publisher!' },
            publish_year: { required: true, message: 'Please input publish year!' },
            category: { required: true, message: 'Please input category!' },
            stock: { required: true, message: 'Please input stock!' },
            price: { required: true, message: 'Please input price!' },
        }

    }),
    async mounted() {
        try {
            if (this.$route.params) {
               Object.assign(this.formState, this.$route.params)
            }
        } catch (e) {
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
            update: "book/update",
            create: "book/create",
        }),
        async submit() {
            try {
                if (this.$route.params.id != undefined) {
                    await this.update(this.formState)
                    sAlertSuccess(this, "Book has been updated")
                } else {
                    await this.create(this.formState)
                    sAlertSuccess(this, "Book has been added")
                }
                this.$router.push({name: "book.index"})
            } catch (e) {
                sAlertError(this, e)
            }
        }
    },
    watch: {

    }
}
</script>
