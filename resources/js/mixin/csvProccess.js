module.exports = {
    methods: {
        insertingCsv(){
            axios.get('api/zones/import/store')
                .then(response =>{
                    console.log(response);
                })
                .catch(errors => {
                    console.log(errors);
                })
        },
        redirectToResults(){
            setTimeout(function(){
                window.location.href = '/zones/results';
            }, 2000);
        }
    }
};
