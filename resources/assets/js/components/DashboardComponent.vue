<template>
    <div><div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal">Test Task</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <router-link class="p-2 text-dark" :to="{ name: 'teams' }">Teams</router-link>
            <router-link class="p-2 text-dark" :to="{ name: 'players' }">Players</router-link>
        </nav>
        <router-link class="btn btn-outline-primary" :to="{ name: 'logout' }">Logout</router-link>
    </div>
    <div class="container-fluid">
        <router-view></router-view>
    </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                data: 'nothing'
            }
        },
        mounted() {


        }
    }
</script>
<style>
    .border-top { border-top: 1px solid #e5e5e5; }
    .border-bottom { border-bottom: 1px solid #e5e5e5; }

    .box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05); }
</style>