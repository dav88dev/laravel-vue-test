<template>
    <div class="row">
        <div class="col-4 adding-button">
            <button @click="changePage('add-team')" type="button" class="btn btn-primary">Add team</button>
        </div>
        <div v-if="callComplete" class="card-deck">
            <div v-for="team in teams" class="card">
                <img class="card-img-top" src="https://lorempixel.com/300/150/" alt="team logo">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ team.name }}</h5>
                    <p class="card-text">
                        <router-link :to="{name:'team-players', params: { team:team.id }}">See players</router-link>
                    </p>
                    <p class="card-text">
                        <router-link :to="{name:'edit-team', params: { team:team.id }}">Edit team</router-link>
                    </p>
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