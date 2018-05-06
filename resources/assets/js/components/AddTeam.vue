<template>
    <div>
        <h1 class="display-4">Add team</h1>
        <form @submit.prevent="save()">
            <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Team name</span>
                </div>
                <input v-model="teamName" type="text" required class="form-control" aria-label="Large"
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
    export default {
        name: "add-team",
        data() {
            return {
                teamName: '',
                error: false,
                success: false,
            }
        },

        methods: {
            save() {
                axios.post('/api/v1/teams', {
                        headers: {
                            Authorization: 'Bearer ' + localStorage.getItem('token'),
                        },
                        name: this.teamName,
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
        }
    }
</script>

<style scoped>
    .save-button {
        margin: 10px 0 0 0;
    }
</style>