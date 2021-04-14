<template>
    <data-table
        :columns="columns"
        :per-page="['10', '25', '50']"
        url="/zones/errors">
    </data-table>
</template>


<script>
export default {
    name: "ErrorsTable",
    data() {
        return {
            perPage: ['10', '25', '50'],
            columns: [
                {
                    label: 'File id',
                    name: 'file_chunk',
                    orderable: true,
                },
                {
                    label: 'Number of errors',
                    name: 'number_of_errors',
                    orderable: true,
                },
                {
                    label: 'Line on file',
                    name: 'line_numbers',
                    orderable: true,
                }
            ]
        }
    },
}

</script>

<style scoped>

</style>
