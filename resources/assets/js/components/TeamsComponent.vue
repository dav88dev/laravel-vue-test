<template>
    <div class="row">
        <div class="col-4 adding-button">
            <button @click="changePage('add-team')" type="button" class="btn btn-primary">Add team</button>
        </div>
        <div v-if="callComplete" class="card-deck">
            <div v-for="team in teams" class="card">
                <img class="card-img-top" src="https://lorempixel.com/300/150/" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ team.name }}</h5>
                    <p class="card-text">Click to see players</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {pageChanger} from '../mixins/page-changer'
    import {teamsApiProcessor} from '../mixins/teams-api-processor'

    export default {
        name: "teams-component",

        data() {
            return {}
        },

        mounted() {
            this.getTeams();

        },

        mixins: [
            pageChanger,
            teamsApiProcessor
        ],
    }
</script>

<style scoped>
    .adding-button {
        margin: 10px;
    }

</style>