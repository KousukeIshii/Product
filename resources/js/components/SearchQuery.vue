<template>
    <div class="row" id="search-query">
        <div class = "offset-1"></div>
        <span class="search-desc">検索ワード：</span>
        <input placeholder="商品名" class="col-sm-3" v-model="keyword">
        <span class="search-desc">値段：</span>
        <input @input="validate" placeholder="Min" class="col-sm-1" v-model="min_value">
        <span class="search-desc" id="between">〜</span>
        <input @input="validate" placeholder="Max" class="col-sm-1" v-model="max_value">
        <router-link class="search-link" :to="`/spa/search?keyword=${this.keyword}&max_value=${this.max_value}&min_value=${this.min_value}`">
            <button v-on:click="">検索</button>
        </router-link>
    </div>
</template>

<script>
    export default {
        created() {
        },
        data() {
            return {
                keyword:'',
                max_value:'',
                min_value:'',
            }
        },
        methods: {
            validate() {
                this.min_value = this.min_value.replace(/\D/g, '')
                this.max_value = this.max_value.replace(/\D/g, '')
            },
        }
    }
</script>

<style scoped>
    .search-desc{
        display: inline-block;
        vertical-align: center;
        margin:0 0 0 10px;
        font-size: 17px;
    }
    #between{
        margin: 0 5px 0 5px;
    }
    .search-link{
        margin: 0 0 0 25px;
    }
    #search-query{
        margin:10px 10px 30px 10px;
    }
</style>