<template>
    <div class="row">
        <div class="card-deck">
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
    export default {
        name: "teams-component",
        data(){
            return {
                teams:[]
            }
        },

        mounted() {
            axios.get('/api/v1/teams', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                    responseType: 'json'
                }
            })
                .then(response => {
                    this.teams = response.data;
                }).catch(error => {

            })

        }
    }
</script>

<style lang="scss" scoped>

</style>