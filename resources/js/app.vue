<template>
    <v-app id="sandbox">
        <Auth v-if="$route.meta.auth">
            <router-view />
        </Auth>
        <Main v-if="!$route.meta.auth" :key="$route.fullPath">
            <router-view />
        </Main>
    </v-app>
</template>

<script>
import Main from './components/layouts/Main.vue';
import Auth from './components/layouts/Auth.vue';

export default {
    components: {
        Main,
        Auth,
    },
};
</script>
