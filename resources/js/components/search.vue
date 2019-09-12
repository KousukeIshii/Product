<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 product-cards" v-for="product in products.data">
                <img :src="`data:image/png;base64,${product.image}`" class="col-sm-12 image">
                <h4 class="title col-sm-12">
                    <router-link id="link" :to="'/spa/show/' + product.id">{{ product.name }}</router-link>
                </h4>
                <p class="desc col-sm-12">
                    {{product.desc}}
                </p>
                <div class="value col-sm-12">
                    ￥{{product.value}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.searchProducts()
        },
        data() {
            return {
                products: []
            }
        },
        methods: {
            searchProducts() {
                const keyword = this.$route.query.keyword;
                const max_value = this.$route.query.max_value;
                const min_value = this.$route.query.min_value;
                let data = {};
                if(keyword){
                    data.keyword = keyword;
                }
                if(max_value){
                    data.max_value = max_value;
                }
                if(min_value){
                    data.min_value = min_value;
                }
                const token = localStorage.getItem('j_token');
                const headers = {
                    "Content-Type": "application/json",
                    "Authorization":`Bearer ${token}`,
                }
                this.$http.post('/api/search', data,{
                    headers: headers
                })
                    .then(res =>  {
                        console.log(res)
                        this.products = res.data
                    })
            },
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
    #link{
        color:#232527;
        margin:0;
    }
    #link:hover{
        text-decoration: none;
        color:darkblue;
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