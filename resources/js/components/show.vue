<template>
    <div class="container-fluid">
        <div class ="col-sm-4">

        </div>
        <div class="row">
            <img class="col-sm-6" :src="`data:image/jpg;base64,${product.image}`">
            <div class="col-sm-6">
                <h2>{{product.name}}</h2>
                <hr>
                <p>￥{{product.value}}</p>
                <h5>{{product.desc}}</h5>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.fetchProduct(this.$route.params['id'])
        },
        data() {
            return {
                product: []
            }
        },
        methods: {
            fetchProduct(id) {
                const token = localStorage.getItem('j_token');
                axios.get(`/api/product/${id}`,{
                    headers: { "Content-Type": "application/json","Authorization": `Bearer ${token}`},
                    data: {}
                })
                    .then(res =>  {
                        console.log(res)
                        this.product = res.data.data
                    })
            }
        }
    }
</script>

<style scoped>

</style>