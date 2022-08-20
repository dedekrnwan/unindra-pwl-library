<template>
    <v-app id="sandbox">
        <Main :key="$route.fullPath">
            <router-view />
        </Main>
    </v-app>
</template>

<script>
import Main from './components/layouts/Main.vue';

export default {
    components: {
        Main,
    },
};
</script>
