<template>
    <transition name="animated">
        <div v-if="fetchComplete">
            <div class="col-4 adding-button">
                <button type="button" class="btn btn-primary">Add player</button>
            </div>
            <div class="row">
                <div class="card-columns">
                    <div v-for="player in players" class="card">
                        <img class="card-img-top" src="https://lorempixel.com/400/200/" alt="Card image cap">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ player.name }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!--Pagination start-->
            <div class="row pagination">
                <div class="offset-md-3 offset-xl-5 offset-sm-3 col-lg-6">
                    <nav aria-label="pagination" class="text-center">
                        <ul class="pagination">
                            <li v-if="pagination.prev_page_url" @click="apiCall(pagination.first_page_url)"
                                class="page-item">
                                <span class="page-link">First page</span>
                            </li>
                            <li v-if="pagination.prev_page_url" @click="apiCall(pagination.prev_page_url)"
                                class="page-item">
                                <span class="page-link">Previous</span>
                            </li>
                            <li v-if="pagination.next_page_url" @click="apiCall(pagination.next_page_url)"
                                class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                            <li v-if="pagination.next_page_url" @click="apiCall(pagination.last_page_url)"
                                class="page-item">
                                <span class="page-link">Last page</span>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--Pagination end-->
        </div>
    </transition>
</template>
<script>
    export default {
        name: "players-component",
        data() {
            return {
                players: [],
                pagination: {},
                fetchComplete: false
            }
        },

        mounted() {
            this.apiCall();
        },

        computed: {
            paginationChanges() {
                return this.pagination;
            },
        },

        methods: {
            apiCall(url = false) {
                axios.get(url || '/api/v1/players', {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token'),
                        responseType: 'json'
                    }
                })
                    .then(response => {
                        this.fetchComplete = false;
                        this.pagination.first_page_url = response.data.first_page_url
                        this.pagination.last_page_url = response.data.last_page_url
                        this.pagination.next_page_url = response.data.next_page_url
                        this.pagination.prev_page_url = response.data.prev_page_url
                        this.players = response.data.data
                        setTimeout(() => {
                            this.fetchComplete = true;
                        }, 500);

                    }).catch(error => {
                })
            },
        }
    }
</script>

<style scoped>
    .row {
        margin: 1%;
    }

    .pagination {
        margin-top: 10px;
    }

    .animated {
        display: inline-block;
    }

    .animated-enter-active, .animated-leave-active {
        animation: fadein .5s;
    }

    .animated-enter, .animated-leave-active {
        animation: fadeout .5s;
    }

    @keyframes fadein {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.5);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes fadeout {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.5);
        }
        100% {
            transform: scale(0);
        }
    }
</style>