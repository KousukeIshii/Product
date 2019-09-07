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
        <textarea id="base64area">base64データ</textarea>
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
                //const image = document.getElementById("base64area").innerHTML;
                const data = {
                    "name":this.name,
                    "desc":this.desc,
                    "value":this.value,
                    "image":crimage
                }
                const headers = {
                    "Content-Type": "application/json",
                    "Authorization":"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvaG9tZSIsImlhdCI6MTU2NzY3MDM5MSwiZXhwIjoxNTY3NjczOTkxLCJuYmYiOjE1Njc2NzAzOTEsImp0aSI6IkNFZGltT2ZabTZPZFhjVWMiLCJzdWIiOjEsInBydiI6ImU1YzUzNzdkODFlMjU1NTg3NzI1MWM0M2U1MGE5NGJlN2E0ZjE2NWQifQ.rrUV8mZ6ao-1p0YpZwAgQC0o4uWdGtNhDX6i0HiSMmI",
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