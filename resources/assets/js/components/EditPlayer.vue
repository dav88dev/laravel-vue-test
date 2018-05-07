<template>
    <div v-if="apiCallsCompleted">
        <h1 class="display-4">Add player</h1>
        <form @submit.prevent="edit()">
            <select v-model="player.team_id" required class="custom-select custom-select-lg mb-3">

                <option v-for="team in teams" :value="team.id">{{ team.name }}</option>
            </select>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">First and last name</span>
                </div>
                <input v-model="player.first_name" type="text" class="form-control">
                <input v-model="player.last_name" type="text" class="form-control">
            </div>
            <button type="submit" class="btn btn-success btn-lg save-button">Save</button>
        </form>
        <div v-if="success" class="alert alert-success save-button" role="alert">
            Saved !
        </div>
    </div>
</template>

<script>
    import {teamsApiProcessor} from '../mixins/teams-api-processor'

    export default {
        name: "edit-player",
        data() {
            return {
                teams: {},
                player: {},
                error: false,
                success: false,
                playerCallCompleted: false,
                test:2

            }
        },

        computed: {
            apiCallsCompleted() {
                if (this.callComplete && this.playerCallCompleted) {
                    return true
                }
                return false
            }
        },

        mounted() {
            this.getPlayer();
        },

        methods: {

            getPlayer() {
                axios.get('/api/v1/players/' + this.$route.params.player, {
                    headers: {
                        Authorization: 'bearer' + localStorage.getItem('token'),
                        responseType: 'json'
                    }
                })
                    .then(response => {
                        this.player = response.data;
                        this.playerCallCompleted = true;
                        this.getTeams();
                    }).catch(error => {

                })
            },

            edit() {
                axios.patch('/api/v1/players/' + this.$route.params.player, {
                        headers: {
                            Authorization: 'Bearer ' + localStorage.getItem('token'),
                        },
                        team_id: this.player.team_id,
                        first_name: this.player.first_name,
                        last_name: this.player.last_name,
                    }
                )
                    .then(response => {
                        this.success = true;
                        setTimeout(() => {
                            return this.$router.push({name: 'players'})
                        }, 400);
                    })
                    .catch(e => {
                        console.log(e);
                    });
            }
        },

        mixins: [
            teamsApiProcessor
        ],

    }
</script>

<style scoped>

</style>