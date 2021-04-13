<template>
    <data-table
        :columns="columns"
        :per-page="[]"
        url="/zones">
    </data-table>
</template>


<script>
export default {
    name: "ResultsTable",
    data() {
        return {
            perPage: ['10', '25', '50'],
            columns: [
                {
                    label: 'Zone id',
                    name: 'zone_id',
                    orderable: false,
                },
                {
                    label: 'Zone Name',
                    name: 'zone_name',
                    orderable: false,
                },
                {
                    label: 'Repeat records',
                    name: 'num',
                    orderable: false,
                },
                {
                    label: 'Min Date',
                    name: 'min_date',
                    orderable: false,
                },
                {
                    label: 'Max Date',
                    name: 'max_date',
                    orderable: false,
                },
            ]
        }
    },
}

</script>

<style scoped>

</style>
