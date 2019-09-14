<template>
    <div class = "form-container container-fluid">
        <p class="form-desc">商品名</p>
        <p id="name-error"class="error-message"></p>
        <textarea class="product-form col-sm-4" maxlength="100" placeholder="商品名は１００文字まで" id="product-name" v-model="name"></textarea>
        <p class="form-desc">商品説明</p>
        <p id="desc-error" class="error-message"></p>
        <textarea class="product-form col-sm-6" maxlength="500" placeholder="商品名は５００文字まで" id="product-desc" v-model="desc"></textarea>
        <p class="form-desc">値段</p>
        <p id="value-error" class="error-message"></p>
        <input @input="validate" id="product-value" class="product-form col-sm-2" v-model="value">
        <p class="form-desc">商品画像</p>
        <p id="image-error" class="error-message"></p>
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
                if(this.validateForms()){
                    return false;
                }
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
            },
            validateForms(){
                let validate_flag = false;
                $('.product-form').each(function() {
                    $(this).css('border','');
                });
                $('.error-message').each(function() {
                    $(this).css('display','none');
                });
                if(!this.value){
                    validate_flag = true;
                    document.getElementById('product-value').style.border = "solid 2px orangered";
                    const v_error = document.getElementById('value-error');
                    v_error.style.display = "block";
                    v_error.textContent = "値段欄が空欄です。"
                }
                if(!crimage){
                    validate_flag = true;
                    const i_error = document.getElementById('image-error');
                    i_error.style.display = "block";
                    i_error.textContent = "画像が選択されていません。"
                }
                if(!this.name){
                    validate_flag = true;
                    const n_error = document.getElementById('name-error');
                    document.getElementById('product-name').style.border = "solid 2px orangered";
                    n_error.style.display = "block";
                    n_error.textContent = "名前欄が空欄です。"
                }
                if(!this.desc){
                    validate_flag = true;
                    const d_error = document.getElementById('desc-error');
                    document.getElementById('product-desc').style.border = "solid 2px orangered";
                    d_error.style.display = "block";
                    d_error.textContent = "説明欄が空欄です。"
                }
                if(validate_flag){
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
</script>

<style scoped>
    .form-container{
        margin:0 0 30px 0;
    }
    .form-desc{
        margin:0;
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
    .error-message{
        display:none;
        margin:0;
        color:orangered;
    }
</style>