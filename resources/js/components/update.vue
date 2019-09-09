<template>
    <div class = "form-container container-fluid">
        <div id="show-link-container">
            <router-link id="show-link" :to="'/spa/' + product.id">商品概要へ戻る</router-link>
        </div>
        <p class="form-desc">商品名</p>
        <textarea class="product-form col-sm-4" id="product-name" v-model="name">{{product.name}}</textarea>
        <p class="form-desc">商品説明</p>
        <textarea class="product-form col-sm-6" id="product-desc" v-model="desc">{{product.desc}}</textarea>
        <p class="form-desc">値段</p>
        <input id="product-value" @input="validate" class="product-form col-sm-2" v-model="value">
        <p class="form-image">商品画像</p>
        <input type="file" @change="getFile" ref="input" accept="image/gif,image/jpeg,image/jpg,image/png" class="product-form"/>
        <br>
        <button v-on:click="updateProduct">商品を更新</button>
    </div>
</template>

<script>
    let upimage;
    export default {
        created() {
            this.fetchProduct(this.$route.params['id'])
        },
        data() {
            return {
                name:'',
                desc:'',
                value:'',
                image:'',
                product:[]
            }
        },
        methods: {
            validate() {
                this.value = this.value.replace(/\D/g, '')
            },
            getFile() {
                const img = this.$refs.input.files[0];
                let fr=new FileReader();
                fr.onload=function(evt) {
                    upimage=evt.target.result.substr(evt.target.result.indexOf(',')+1);
                };
                fr.readAsDataURL(img);
            },
            updateProduct() {
                const token = localStorage.getItem('j_token');
                const id = this.$route.params['id'];
                let data = {};
                if(this.name !== this.product.name){
                    data.name = this.name;
                }
                if(this.desc !== this.product.desc){
                    data.desc = this.desc;
                }
                if(this.value !== this.product.value){
                    data.value = this.value;
                }
                if(upimage){
                    data.image = upimage;
                }
                const headers = {
                    "Content-Type": "application/json",
                    "Authorization":`Bearer ${token}`,
                }
                this.$http.patch(`/api/product/${id}`, data,{
                    headers: headers
                })
                    .catch(error => {
                        console.log(error);
                    })
                    .then(res =>  {
                        console.log(res)
                    })
            },
            fetchProduct(id) {
                const token = localStorage.getItem('j_token');
                axios.get(`/api/product/${id}`,{
                    headers: { "Content-Type": "application/json","Authorization": `Bearer ${token}`},
                    data: {}
                })
                    .then(res =>  {
                        this.product = res.data.data;
                        this.name=this.product.name;
                        this.desc=this.product.desc;
                        this.value=this.product.value;
                        document.getElementById('product-value').value = this.product.value;
                    })
            }
        }
    }
</script>

<style scoped>
    #show-link-container{
        margin:0 0 15px 0;
    }
    #show-link{
        color:#232527;
        font-size:18px;
        margin:0 0 0 10px;
    }
    #show-link:hover{
        text-decoration: none;
        color:darkblue;
    }
    .form-container{
        margin:0 0 30px 0;
    }
    .form-desc{
        margin:0 0 0 0;
    }
    .product-form{
        margin:0 0 5px 0;
    }
    #product-name{
        max-height:100px;
    }
    #product-desc{
        height:100px;
        max-height:100px;
    }
</style>