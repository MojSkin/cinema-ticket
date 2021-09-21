<template>
    <li class="nav-item">
        <button class="btn btn-link nav-link" @click="report">Tickets Report</button>
    </li>
</template>

<script>
export default {
    name: "TicketsReportComponent",
    data() {
        return {
            routes: {
                report:  process.env.MIX_APP_URL+'/api/report',
            },
            loading: false
        }
    },

    methods: {
        report() {
            if (!this.loading) {
                this.loading = true
                let token = this.$helpers.getToken()
                axios.post(this.routes.report, null, { headers: {"Authorization" : `Bearer ${token}`} }).then(res => {
                    if (res && res.data) {
                        this.$swal({
                            title: 'Ticket report response',
                            html: JSON.stringify(res.data),
                            showCancelButton: false,
                            confirmButtonText: "OK!",
                            showCloseButton: true,
                        })
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
