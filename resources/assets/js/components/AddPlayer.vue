<template>
    <div v-if="callComplete">
        <h1 class="display-4">Add player</h1>
        <form @submit.prevent="save()">
            <select v-model="teamID" required class="custom-select custom-select-lg mb-3">
                <option value="" selected disabled>Please select team</option>
                <option v-for="team in teams" :value="team.id">{{ team.name }}</option>
            </select>
            <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Player name</span>
                </div>
                <input v-model="playerName" type="text" required class="form-control" aria-label="Large"
                       aria-describedby="inputGroup-sizing-sm">
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
        name: "add-player",
        data() {
            return {
                teamID: 0,
                playerName: '',
                error: false,
                success: false,
            }
        },
        mounted() {
            this.getTeams();
        },

        methods: {
            save() {
                axios.post('/api/v1/players', {
                        headers: {
                            Authorization: 'Bearer ' + localStorage.getItem('token'),
                        },
                        team_id: this.teamID,
                        name: this.playerName,
                    }
                )
                    .then(response => {
                        this.success = true;
                        setTimeout(() => {
                            return this.$router.push({name: 'players'})
                        }, 500);
                    })
                    .catch(e => {
                        this.error = true;
                    });
            }
        },

        mixins: [
            teamsApiProcessor
        ],
    }
</script>

<style scoped>
    .save-button {
        margin: 10px 0 0 0;
    }
</style>