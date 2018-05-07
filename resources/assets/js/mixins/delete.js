export const teamsApiProcessor = {

    data() {
        return {
            deleted:false
        }
    },

    methods: {
       deleteTeam(id) {
            axios.delete('/api/v1/teams' + id, {
                headers: {
                    Authorization: 'bearer' + localStorage.getItem('token'),
                }
            })
                .then(response => {
                    this.deleted = true;
                }).catch(error => {

            })
        },

        deletePlayer(id) {
            axios.delete('/api/v1/players' + id, {
                headers: {
                    Authorization: 'bearer' + localStorage.getItem('token'),
                }
            })
                .then(response => {
                    this.deleted = true;
                }).catch(error => {

            })
        }

    }
}