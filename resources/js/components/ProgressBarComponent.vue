<template>
    <div>
        <h5 class="card-title">{{ title }}</h5>
        <div class="progress">
            <div class="progress-bar
                progress-bar-striped
                progress-bar-striped
                progress-bar-animated"
                role="progressbar"
                :aria-valuenow="batchData.processedJobs"
                :aria-valuemin="0"
                :aria-valuemax="batchData.totalJobs"
                :style="{width: batchData.progress + '%'}">{{ batchData.progress }}%</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProgressBarComponent",
    props: {
        nameBatch: {
            type: String,
        },
        step: {
            type: String,
        },
        title: {
            type: String,
        }
    },
    data() {
        return {
            batchData : {
                totalJobs : 0,
                pendingJobs : 0,
                processedJobs : 0,
                progress : 0,
                failedJobs : 0,
            },
            pollingId : null
        }
    },
    mounted() {
        this.polling();
    },
    methods: {
        polling () {
            this.pollingId = setInterval(() => {
                axios.get('api/zones/import/batch', {
                    params : {
                        name : this.nameBatch,
                    }
                })
                    .then(response => {
                        this.batchData.totalJobs = response.data.totalJobs;
                        this.batchData.pendingJobs = response.data.pendingJobs;
                        this.batchData.processedJobs = response.data.processedJobs;
                        this.batchData.progress = response.data.progress;
                        this.batchData.failedJobs = response.data.failedJobs;
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            }, 500)
        },
    },
    updated() {
        if (this.batchData.progress === 100) {
            clearInterval(this.pollingId);
            EventBus.$emit('next-step', this.step);
        }
    },
    beforeDestroy () {
        clearInterval(this.pollingId)
    }
}
</script>

<style scoped>

</style>
