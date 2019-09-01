<template>
        <div class="row">
            <div class="col-sm-3 product-cards" v-for="product in products.data">
                <img :src="`../image/${product.image}`" class="col-sm-12 image">
                <h4 class="title col-sm-12">
                    {{product.name}}
                </h4>
                <p class="desc col-sm-12">
                    {{product.desc}}
                </p>
                <div class="value col-sm-12">
                    ￥{{product.value}}
                </div>
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
                    headers: { "Content-Type": "application/json","Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvaG9tZSIsImlhdCI6MTU2NzM0NzczNiwiZXhwIjoxNTY3MzUxMzM2LCJuYmYiOjE1NjczNDc3MzYsImp0aSI6InFudEpvNWkzMmxacWdmdHoiLCJzdWIiOjEsInBydiI6ImU1YzUzNzdkODFlMjU1NTg3NzI1MWM0M2U1MGE5NGJlN2E0ZjE2NWQifQ.Qmdky5Y6LdssHjpilPkngkIBzIPfomJBtC5_SczFlSg"},
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
    .product-cards{
        color:dimgray;
        background-color: white;
    }
    .image{
        margin:8px 0px 8px 0px;
    }
    .title{
        color:#232527;
        margin:0;
    }
    .desc{
        margin:8px 8px;
    }
    .value{
        color:orangered;
        margin:8px 0px 8px 0px;
    }
    .row{
        margin:10px 0px 10px 0px;
        border-top:solid 2px lightgray;
        border-bottom:solid 2px lightgray;
    }
</style>