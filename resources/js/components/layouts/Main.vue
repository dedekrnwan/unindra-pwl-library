<template>
    <div>
        <a-layout style="min-height: 100vh">
            <navigation></navigation>
            <a-layout>
<!--                <a-layout-header style="background: #fff; padding: 0" />-->
                <a-layout-content style="margin: 0 16px">

                    <router-view></router-view>

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

export default {
    name: 'Main',
    components: {
        Navigation,
    },
}
</script>
