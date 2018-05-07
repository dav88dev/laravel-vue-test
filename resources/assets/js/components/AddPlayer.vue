<template>
    <div v-if="callComplete">
        <h1 class="display-4">Add player</h1>
        <form @submit.prevent="save()">
            <select v-model="teamID" required class="custom-select custom-select-lg mb-3">
                <option value="" selected disabled>Please select team</option>
                <option v-for="team in teams" :value="team.id">{{ team.name }}</option>
            </select>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">First and last name</span>
                </div>
                <input v-model="firstName" type="text" class="form-control">
                <input v-model="lastName" type="text" class="form-control">
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
                firstName: '',
                lastName: '',
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
                        first_name: this.firstName,
                        last_name: this.lastName,
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