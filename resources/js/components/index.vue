<template>
    <div>
        <div v-for="product in products">
            {{product}}
            <h1>
                {{product.name}}
            </h1>
            <p>
                {{ product.desc }}
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.fetchProducts()
        },
        data() {
            return {
                products: []
            }
        },
        methods: {
            fetchProducts() {
                this.$http.get('/api/product',{
                    headers: { "Content-Type": "application/json","Authorization": "Bearer "},
                    data: {}
                })
                    .then(res =>  {
                        this.products = res.data
                    })
            }
        }
    }
</script>

<style scoped>

</style>