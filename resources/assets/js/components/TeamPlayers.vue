<template>
    <transition name="animated">
        <div v-if="fetchComplete">
            <div class="col-4 adding-button">
                <h2>{{ team.name }} players</h2>
            </div>
            <div class="row">
                <div class="card-columns">
                    <div v-for="player in players" class="card">
                        <img class="card-img-top" src="https://lorempixel.com/400/200/" alt="player avatar">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ player.first_name, player.last_name }}</h5>
                            <p class="card-text">
                                <router-link :to="{name:'edit-player', params: { player:player.id }}">Edit</router-link>
                            </p>
                            <button @click="deletePlayer(player.id)" type="button" class="btn btn-link text-danger">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
    import {deleteApiCalls} from '../mixins/delete'

    export default {
        name: "team-players",
        data() {
            return {
                team: {},
                players: {},
                fetchComplete: false
            }
        },

        mounted() {
            this.getData();
        },

        methods: {
            getData() {
                axios.get('/api/v1/teams/' + this.$route.params.team + '/players ', {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token'),
                        responseType: 'json'
                    }
                })
                    .then(response => {
                        this.team = response.data.team
                        this.players = response.data.players
                        setTimeout(() => {
                            this.fetchComplete = true;
                        }, 200);

                    }).catch(error => {
                })
            },

        },
        mixins: [
            deleteApiCalls
        ],
    }
</script>

<style scoped>
    .row {
        margin: 1%;
    }

    .pagination {
        margin-top: 10px;
    }

    .animated {
        display: inline-block;
    }

    .animated-enter-active, .animated-leave-active {
        animation: fadein .5s;
    }

    .animated-enter, .animated-leave-active {
        animation: fadeout .5s;
    }

    @keyframes fadein {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.5);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes fadeout {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.5);
        }
        100% {
            transform: scale(0);
        }
    }
</style>
