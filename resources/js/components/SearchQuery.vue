<template>
    <div class="row">
        <span class="search-desc">検索ワード</span>
        <input placeholder="商品名" class="col-sm-3" v-model="keyword">
        <span class="search-desc">値段</span>
        <input @input="validate" placeholder="Min" class="col-sm-1" v-model="min_value">
        <span class="search-desc">〜</span>
        <input @input="validate" placeholder="Max" class="col-sm-1" v-model="max_value">

        <router-link class="link" :to="`/spa/search?keyword=${this.keyword}&max_value=${this.max_value}&min_value=${this.min_value}`">
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
        margin:0;
    }
</style>