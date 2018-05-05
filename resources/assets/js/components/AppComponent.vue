<template>
    <transition name="entry" appear mode="out-in">
        <router-view></router-view>
    </transition>
</template>

<script>
    export default {}
</script>
<style scoped>
    /*Links transition*/
    .entry-enter {
        opacity: 0;
    }

    .entry-enter-active {
        transition: opacity 0.6s;

    }

    .entry-leave {
        opacity: 1;
    }

    .entry-leave-active {
        transition: opacity 0.6s;
        opacity: 0;
    }

    @media screen and (max-width: 576px) {
        .container-fluid {
            padding: 0;
        }
    }

    /*End link transition*/
</style>
