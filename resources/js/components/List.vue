<template>
    <div class="row">
        <modal v-if="showModal" @close="showModal = false">
            <card slot="content" :resource-item="selectedItem" @deleted="resourceDeleted"></card>
        </modal>
        <div v-if="$store.getters.isAdmin" class="col-12 mb-2 text-end">
            <router-link :to='{name:"create"}' class="btn btn-primary">Create New Resource</router-link>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div v-for="(resourceItem,key) in resourceItems" class="col-md-3 resource-item" :key="key" v-on:click="() => selectCard(resourceItem)">
                    <card :resource-item="resourceItem" :pdf-page=1 @deleted="getResources"></card>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.resource-item > div {
    height: 30vh;
    border-radius: 2rem;
    overflow: hidden;
}
</style>
<script>
import Modal from "./Modal";
import Card from "./Card";
import resourceService from "../services/resourceService";


export default {
    name:"categories",
    data(){
        return {
            selectedItem : null,
            resourceItems:[],
            showModal : false
        }
    },
    components : {
        modal : Modal,
        card : Card
    },
    mounted(){
        this.getResources();
    },
    methods:{
        selectCard(cardItem){
            this.selectedItem = cardItem;
            this.showModal = true;
        },
        resourceDeleted(){
            this.showModal = false;
            this.getResources();
        },
        getResources(){
            resourceService.getResources().then(res => {
                this.resourceItems = res
            });
        }
    }
}
</script>
