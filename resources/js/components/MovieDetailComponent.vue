<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" v-text="movie.title"></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h3>Available seats</h3>
                                <p>To book a seat click on it</p>
                                <p>Tip: Seats shown as <span class="btn btn-danger m-2">#</span> are taken, so you can only select seats shown like <span class="btn btn-success my-2">#</span></p>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button
                                v-for="seat in seats"
                                class="btn m-2"
                                :class="isTaken(seat.id)?'btn-danger':'btn-success'"
                                :disabled="isTaken(seat.id) || loading"
                                v-text="seat.number"
                                @click="bookSeat(seat.id)"
                            ></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "MovieDetailComponent",

    props: ["movie", "all_seats"],

    data() {
        return {
            routes: {
                book:  process.env.MIX_APP_URL+'/api/book',
            },
            seats: this.all_seats,
            tickets: this.movie.tickets,
            loading: false,
        }
    },

    created() {
    },

    mounted() {
    },

    methods: {
        isTaken(seat_id) {
            let result = false
            if (this.tickets && this.tickets.length) {
                result = this.tickets.find(item => {
                    return item.seat_id == seat_id
                })
            }
            return result
        },

        bookSeat(seat_id) {
            if (!this.loading) {
                this.loading = true
                let token = this.$helpers.getToken()
                axios.post(this.routes.book, {seat_id: seat_id, movie_id: this.movie.id}, { headers: {"Authorization" : `Bearer ${token}`} }).then(res => {
                    if (res && res.data) {
                        if (res.data.status) {
                            this.tickets.push(res.data.result)
                        } else {
                            this.$helpers.notify('Error while booking this seat', {type: 'error', icon: 'fa fa-exclamation-triangle'});
                        }
                    } else {
                        this.$helpers.notify('Unexpected error while booking this seat', {type: 'error', icon: 'fa fa-exclamation-triangle'});
                    }
                }).catch(error => {
                    if (error.response) {
                        switch (error.response.status) {
                            case 401:
                                this.$helpers.notify('Unauthenticated.', {type: 'error', icon: 'fa fa-exclamation-triangle'});
                                break
                            case 419:
                                this.$helpers.notify('Page is expired.', {type: 'error', icon: 'fa fa-exclamation-triangle'});
                                break
                            default:
                                this.$helpers.notify('Unexpected error while booking seat', {type: 'error', icon: 'fa fa-exclamation-triangle'});
                        }
                    } else {
                        this.$helpers.notify('Unexpected error while booking seat', {type: 'error', icon: 'fa fa-exclamation-triangle'});
                    }
                }).then(res => {
                    this.loading = false
                })
            }
        }
    }
}
</script>
<style scoped>

</style>
