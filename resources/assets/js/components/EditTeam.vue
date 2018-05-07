<template>
    <div>
        <h1 class="display-4">Edit team</h1>
        <form @submit.prevent="edit()">
            <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Team name</span>
                </div>
                <input v-model="team.name" type="text" required class="form-control" aria-label="Large"
                       aria-describedby="inputGroup-sizing-sm">
            </div>
            <button type="submit" class="btn btn-success btn-lg save-button">Edit</button>
        </form>
        <div v-if="success" class="alert alert-success save-button" role="alert">
            Changed !
        </div>
    </div>
</template>

<script>
    export default {
        name: "edit-team",
        data() {
            return {
                team: {},
                error: false,
                success: false,
            }
        },

        mounted() {
            this.getTeam();
        },

        methods: {

            getTeam() {
                axios.get('/api/v1/teams/' + this.$route.params.team, {
                    headers: {
                        Authorization: 'bearer' + localStorage.getItem('token'),
                        responseType: 'json'
                    }
                })
                    .then(response => {
                        this.team = response.data;
                        this.callComplete = true;
                    }).catch(error => {

                })
            },

            edit() {
                axios.patch('/api/v1/teams/' + this.$route.params.team, {
                        headers: {
                            Authorization: 'Bearer ' + localStorage.getItem('token'),
                        },
                        id: this.team.id,
                        name: this.team.name,
                    }
                )
                    .then(response => {
                        this.success = true;
                        setTimeout(() => {
                            return this.$router.push({name: 'teams'})
                        }, 500);
                    })
                    .catch(e => {
                        console.log(e);
                    });
            }
        },

    }
</script>

<style scoped>
    .save-button {
        margin: 10px 0 0 0;
    }
</style>