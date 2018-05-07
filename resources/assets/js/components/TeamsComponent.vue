<template>
    <div class="row">
        <div class="col-12 adding-button">
            <button @click="changePage('add-team')" type="button" class="btn btn-primary">Add team</button>
        </div>
        <div class="clearfix"></div>
        <div class="col-12">
            <div v-if="callComplete" class="card-deck">
                <div v-for="team in teams" class="col-md-3 teams">
                    <div class="card">
                        <img class="card-img-top" src="https://lorempixel.com/300/150/" alt="team logo">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ team.name }}</h5>
                            <p class="card-text">
                                <router-link :to="{name:'team-players', params: { team:team.id }}">See players
                                </router-link>
                            </p>
                            <p class="card-text">
                                <router-link :to="{name:'edit-team', params: { team:team.id }}">Edit team</router-link>
                            </p>
                            <button @click="deleteTeam(team.id)" type="button" class="btn btn-link text-danger">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {pageChanger} from '../mixins/page-changer'
    import {teamsApiProcessor} from '../mixins/teams-api-processor'
    import {deleteApiCalls} from '../mixins/delete'

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
            teamsApiProcessor,
            deleteApiCalls
        ],
    }
</script>

<style scoped>
    .adding-button {
        margin: 10px;
    }

    .teams {
        margin-bottom: 10px;
    }

</style>