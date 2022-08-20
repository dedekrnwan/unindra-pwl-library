<template>
    <a-breadcrumb style="margin: 16px 0">
        <a-breadcrumb-item>Users Form</a-breadcrumb-item>
    </a-breadcrumb>

    <div :style="{ padding: '24px', background: '#fff', minHeight: '360px' }">
        <a-form
            :model="formState"
            :rules="$route.params.id != undefined ? formRules.update: formRules.create"
            name="book.form"
            v-bind="formItemLayout"
            @finish="submit"
        >
            <a-form-item
                label="Name"
                name="name"
            >
                <a-input v-model:value="formState.name" />
            </a-form-item>

            <a-form-item
                label="Email"
                name="email"
            >
                <a-input v-model:value="formState.email" />
            </a-form-item>
            <a-form-item
                label="Password"
                name="password"
            >
                <a-input-password v-model:value="formState.password" />
            </a-form-item>

            <a-form-item :wrapper-col="{ span: 12, offset: 6 }">
                <a-button type="primary" html-type="submit">Submit</a-button>

                <a-button style="margin-left: 10px" type="secondary" @click="$router.push({name: 'user.index'})" >Cancel</a-button>
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
            name: null,
            email: null,
            password: null,
        },
        formItemLayout: {
            labelCol: { span: 6 },
            wrapperCol: { span: 14 },
        },
        formRules: {
            create: {
                name: { required: true, message: 'Please input name!' },
                email: { required: true, message: 'Please input email!' },
                password: { required: true, message: 'Please input password!' },
            },
            update: {}
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
            update: "user/update",
            create: "user/create",
        }),
        async submit() {
            try {
                if (this.$route.params.id != undefined) {
                    let payload = {
                        id: this.formState.id,
                        email: this.formState.email,
                        name: this.formState.name,
                    }
                    if (this.formState.password != null) {
                        payload.password = this.formState.password
                    }
                    await this.update(payload)
                    sAlertSuccess(this, "User has been updated")
                } else {
                    await this.create(this.formState)
                    sAlertSuccess(this, "User has been added")
                }
                this.$router.push({name: "user.index"})
            } catch (e) {
                sAlertError(this, e)
            }
        }
    },
    watch: {

    }
}
</script>
