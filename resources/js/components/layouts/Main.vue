<template>
    <div>
        <a-layout style="min-height: 100vh">
            <navigation></navigation>
            <a-layout>
                <a-layout-header style="background: #fff; padding: 0">
                    <a-row type="flex" justify="end">
                        <a-col class="me-4">
                            <a-dropdown-button>
                                {{ $store.state?.auth?.user?.name }}
                                <template #overlay>
                                    <a-menu @click="logout">
                                        <a-menu-item key="1">
                                            <UserOutlined />
                                            Logout
                                        </a-menu-item>
                                    </a-menu>
                                </template>
                                <template #icon><user-outlined /></template>
                            </a-dropdown-button>
                        </a-col>
                    </a-row>
                </a-layout-header>
                <a-layout-content style="margin: 0 16px">
                   <slot/>
                </a-layout-content>
                <a-layout-footer style="text-align: center">
                    PWL Library - XYZ ©2022 Created by Dede Kurniawan
                </a-layout-footer>
            </a-layout>
        </a-layout>
    </div>
</template>

<script>
import Navigation from "../libs/layouts/navigation.vue";
import { UserOutlined } from '@ant-design/icons-vue'
import {sAlertError} from "../../utils";

export default {
    name: 'Main',
    components: {
        Navigation,
        UserOutlined,
    },
    methods: {
        async logout() {
            try {
                await this.$store.dispatch('auth/logout')
                this.$router.push({name: 'auth.login'})
            } catch (e) {
                sAlertError(this, e)
            }
        }
    }
}
</script>
