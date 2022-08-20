<template>
    <a-row type="flex" justify="center" >
        <a-col span="12" style="height: 100vh;" class="border-end">
            <a-row type="flex" justify="center" align="middle">
                <a-col class="p-5" span="18">
                    <div class="p-5" style="margin-top: 20vh;">
                        <h4 style="text-align: center">Login</h4>
                        <a-form
                            layout="vertical"
                            :model="formState"
                            :rules="formRules"
                            @finish="submit"
                        >
                            <a-form-item name="email" label="Email">
                                <a-input v-model:value="formState.email" placeholder="input email" />
                            </a-form-item >
                            <a-form-item name="password" label="Password">
                                <a-input-password v-model:value="formState.password" placeholder="input password" />
                            </a-form-item>
                            <a-form-item >
                                <a-row type="flex" justify="space-between">
                                    <a-col>
                                        <a-button style="padding-left: 0px" type="link">Forgot Password?</a-button>
                                    </a-col>
                                    <a-col>
                                        <a-button type="primary" html-type="submit">Submit</a-button>
                                    </a-col>
                                </a-row>
                            </a-form-item>
                        </a-form>
                    </div>
                </a-col>
            </a-row>
        </a-col>
        <a-col span="12" style="height: 100vh;" >
            <a-row type="flex" justify="start" align="middle" >
                <a-col span="24">
                    <div class="p-5 mt-5">
                        <div class="mt-5">
                            <a-image :width="500" src="assets/images/6607.jpg"></a-image>
                        </div>
                        <h4 class="mt-5">Welcome to PWL Library - Xyz</h4>
                        <p class="mt-3">Simple Online Library Management & Library Docs Keeper</p>
                        <h6 class="mt-3">Doesn't have an account? create one here</h6>
                        <a-button class="mt-3" type="primary">Register</a-button>
                        <a-button class="m-3" type="secondary">Forgot Password</a-button>
                    </div>
                </a-col>
            </a-row>
        </a-col>
    </a-row>

</template>

<script>
import {mapActions} from 'vuex'

export default {
    name: 'Login',
    data: ()=>({
        formState: {
            email: null,
            password: null,
        },
        formRules: {
            email: {required: true, message: "Email required"},
            password: {required: true, message: "Password required"},
        }
    }),
    methods: {
        ...mapActions({
           login: 'auth/login'
        }),
        async submit(){
            try {
                await this.login(this.formState)
                this.$router.push({name: "dashboard.index"})
            } catch (e) {
                console.error(e)
            }
        }
    }
}
</script>
