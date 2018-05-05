<template>
    <div class="row">
        <div class="card-deck">

        </div>
    </div>
</template>
<script>
    export default {
        name: "players-component",
        data(){
            return {
                players:[],
            }
        },

        mounted(){
            axios.get('/api/v1/players', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                    responseType: 'json'
                }
            })
                .then(response => {
                    console.log(response.data)
                    //this.players = response.data;
                }).catch(error => {

            })
        }
    }
</script>

<style scoped>

</style>