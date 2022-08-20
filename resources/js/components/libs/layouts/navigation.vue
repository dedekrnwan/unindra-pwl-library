<template>
    <a-layout-sider v-model:collapsed="collapsed" collapsible>
        <div class="logo" />
        <s-menu></s-menu>
    </a-layout-sider>
</template>

<script>
import SMenu from './menu.vue'

export default  {
    name: 'Navigation',
    components: {
        SMenu
    },
    data: () => {
        return {

        }
    },
    computed: {

    },
    methods: {

    },
    watch: {

    }
}
</script>
