export const deleteApiCalls = {

    methods: {
        deleteTeam(id) {
            axios.delete('/api/v1/teams/' + id, {
                headers: {
                    Authorization: 'bearer' + localStorage.getItem('token'),
                }
            })
                .then(response => {
                    this.refreshTeamsData();
                }).catch(error => {

            })
        },

        deletePlayer(id) {
            axios.delete('/api/v1/players/' + id, {
                headers: {
                    Authorization: 'bearer' + localStorage.getItem('token'),
                }
            })
                .then(response => {
                    this.refreshPlayersData();
                }).catch(error => {

            })
        },

        refreshPlayersData() {
            if (this.$route.name == "team-players") {
                this.getData();
            }

            if (this.$route.name == "players") {
                this.apiCall();
            }
        },

        refreshTeamsData() {
            this.getTeams()
        }

    }
}