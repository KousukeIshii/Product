<template>
    <div class="container-fluid">
        <div class="row">
            <div class="link-container col-sm-6">
                <router-link class="link" to='/spa'>商品一覧へ戻る</router-link>
            </div>
            <div class="link-container col-sm-6">
                <router-link class="link" :to="'/spa/update/' + product.id">商品情報を変更</router-link>
            </div>
        </div>
        <div class="row">
            <img class="col-sm-6" :src="`data:image/png;base64,${product.image}`">
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
    .link-container{
        margin:0 0 15px 0;
    }
    .link{
        color:#232527;
        font-size:18px;
        margin:0 0 0 10px;
    }
    .link:hover{
        text-decoration: none;
        color:darkblue;
    }
</style>