<template>
    <div class="card">
        <div class="card-header">Import Zones</div>
        <div class="card-body">
            <div v-if="errors" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ errors }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <template v-if="step === 'uploading'">
                <div v-show="loading">
                    <h5 class="card-title">Uploading file</h5>
                    <div class="d-flex justify-content-center mb-2">
                        <i class="fas fa-spinner fa-pulse"></i>
                    </div>
                </div>

                <form v-show="!loading" @submit.prevent="submit" enctype="multipart/form-data">
                    <div class="mx-auto mb-2">
                        <div class="custom-file">
                            <input type="file"
                                   class="custom-file-input"
                                   id="myInput"
                                   @change="onFileChange"
                                   required>
                            <label class="custom-file-label" for="myInput">Choose file</label>
                        </div>
                    </div>
                    <div class="mx-auto">
                        <button type="submit" class="btn btn-primary btn-block">Import</button>
                    </div>
                </form>
            </template>
            <template v-else-if="step === 'chunking'">
                <progress-bar-component
                    key="chunking"
                    step="chunking"
                    title="Chunking Csv"
                    nameBatch="Chunk Csv"></progress-bar-component>
            </template>
            <template v-else-if="step === 'processing'">

                <progress-bar-component
                    key="processing"
                    step="processing"
                    title="Processsssing Csv"
                    nameBatch="Process Csv"></progress-bar-component>
            </template>

            <template v-else-if="step === 'showing'">
                <h6 class="card-subtitle mb-2 text-muted">Imported records</h6>
                <p class="card-text"> You will be redirect to view the results...</p>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    name: "ImportFileComponent",
    data() {
        return {
            fileImport: '',
            errors: '',
            batchId: '',
            loading: false,
            step : 'uploading',
        }
    },
    mounted() {
        axios.get('api/zones/import/batch', {
            params : {
                name : 'Chunk Csv'
            }
        })
            .then(response =>{
                if (response.data.length !== 0 &&
                    response.data.progress < 100) {
                    this.step = 'chunking';
                }
            })
            .catch(errors => {
                console.log(errors);
            })
        EventBus.$on('next-step', step => {
            if (step === 'uploading') {
                this.step = 'chunking';
            } else if (step === 'chunking') {
                this.insertingCsv();
                this.step = 'processing';
            } else if (step === 'processing') {
                this.redirectToResults();
                this.step = 'showing';
            }
        });
    },
    methods: {
        submit() {
            if (this.validData()) {

                let formData = new FormData();

                this.loading = true;

                formData.append('file', this.fileImport);

                axios.post('api/zones/import/chunk', formData,{
                        headers: { 'content-type': 'multipart/form-data' }
                    })
                    .then(response =>{
                        this.step = 'chunking';
                    })
                    .catch(errors => {
                        console.log(errors);
                    })
            }
        },
        onFileChange(e) {
            let fileName = document.getElementById("myInput").files[0].name;
            let nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
            if (e.target.files[0].type !== 'text/csv') {
                this.errors = 'The file must be text/csv type';
                return;
            }
            this.fileImport = e.target.files[0];
        },
        validData: function (){
            return this.errors === '' && this.fileImport !== '';
        }
    }
}
</script>

<style scoped>

</style>
