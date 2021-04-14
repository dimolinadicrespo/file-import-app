<template>
    <data-table
        :columns="columns"
        :per-page="['10', '25', '50']"
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
                    orderable: true,
                },
                {
                    label: 'Zone Name',
                    name: 'zone_name',
                    orderable: true,
                },
                {
                    label: 'Repeat records',
                    name: 'num',
                    orderable: true,
                },
                {
                    label: 'Min Date',
                    name: 'min_date',
                    orderable: true,
                },
                {
                    label: 'Max Date',
                    name: 'max_date',
                    orderable: true,
                },
            ]
        }
    }
}

</script>

<style scoped>

</style>
