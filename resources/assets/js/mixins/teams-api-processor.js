export const teamsApiProcessor = {

    data() {
        return {
            teams: [],
            callComplete: false
        }
    },

    methods: {
        getTeams() {
            axios.get('/api/v1/teams', {
                headers: {
                    Authorization: 'bearer' + localStorage.getItem('token'),
                    responseType: 'json'
                }
            })
                .then(response => {
                    this.teams = response.data;
                    this.callComplete = true;
                }).catch(error => {

            })
        }
    }
}