<template>
    <data-table
        :columns="columns"
        url="/zones/errors">
    </data-table>
</template>


<script>
export default {
    name: "ErrorsTable",
    data() {
        return {
            columns: [
                {
                    label: 'File id',
                    name: 'file_chunk'
                },
                {
                    label: 'Number of errors',
                    name: 'number_of_errors',
                },
                {
                    label: 'Line on file',
                    name: 'line_numbers',
                }
            ]
        }
    },
}

</script>

<style scoped>

</style>
