<template>
    <div class = "form-container container-fluid">
        <p class="form-desc">商品名</p>
        <textarea class="product-form col-sm-4" id="product-name" v-model="name"></textarea>
        <p class="form-desc">商品説明</p>
        <textarea class="product-form col-sm-6" id="product-desc" v-model="desc"></textarea>
        <p class="form-desc">値段</p>
        <input @input="validate" class="product-form col-sm-2" v-model="value">
        <p class="form-image">商品画像</p>
        <input type="file" @change="getFile" ref="input" accept="image/gif,image/jpeg,image/jpg,image/png" class="product-form"/>
        <br>
        <button v-on:click="postProducts">商品を登録</button>
    </div>
</template>

<script>
    let crimage;
    export default {
        created() {
        },
        data() {
            return {
                name:'',
                desc:'',
                value:'',
                image:''
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
                    crimage=evt.target.result.substr(evt.target.result.indexOf(',')+1);
                };
                fr.readAsDataURL(img);
            },
            postProducts() {
                const token = localStorage.getItem('j_token');
                const data = {
                    "name":this.name,
                    "desc":this.desc,
                    "value":this.value,
                    "image":crimage
                }
                const headers = {
                    "Content-Type": "application/json",
                    "Authorization":`Bearer ${token}`,
                }
                this.$http.post('/api/product', data,{
                    headers: headers
                })
                    .catch(error => {
                        console.log(error);
                    })
                    .then(res =>  {
                        console.log(res)
                    })
            }
        }
    }
</script>

<style scoped>
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