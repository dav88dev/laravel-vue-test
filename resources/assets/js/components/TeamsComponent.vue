<template>
    <div class="row">
        <div class="col-4 adding-button">
            <button @click="changePage('add-team')" type="button" class="btn btn-primary">Add team</button>
        </div>
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
    import {pageChanger} from '../mixins/page-changer'
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
                    Authorization: 'bearer' + localStorage.getItem('token'),
                    responseType: 'json'
                }
            })
                .then(response => {
                    this.teams = response.data;
                }).catch(error => {

            })

        },
        mixins: [
            pageChanger
        ],
    }
</script>

<style scoped>
    .adding-button{
        margin: 10px;
    }

</style>