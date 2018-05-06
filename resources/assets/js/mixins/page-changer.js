export const pageChanger = {

    data() {
        return {

        }
    },

    methods: {
        changePage(pageName) {
            this.$router.push({name: pageName})
        }
    }
}