<template>
    <div class="card">
        <div class="card-header">
            <img :src="'\\svgs\\' + resourceItem.resourcetype + '.svg'" ><h4>{{resourceItem.id + '. ' + resourceItem.title }}</h4>
            <div class="actions">
                <img title="Copy to clipboard" v-if="resourceItem.resourcetype === 'snippet'" role="button" :src="'\\svgs\\copy.svg'" v-on:click="copyToClipboard" >
                <a v-on:click="(e) => e.stopPropagation()" v-if="resourceItem.filepath" :href="'\\storage\\' + resourceItem.filepath" :download="getFileName(resourceItem.filepath)"><img :src="'\\svgs\\download.svg'" ></a>
                <router-link title="Edit this resource" v-if="$store.getters.isAdmin" :to='{name:"edit",  params: { id : resourceItem.id}}'><img :src="'\\svgs\\editicon.svg'" ></router-link>
                <img v-if="$store.getters.isAdmin" title="Delete resource" role="button" :src="'\\svgs\\delete.svg'" v-on:click="deleteResource" >
            </div>
        </div>
        <div class="card-body">
            <div v-if="resourceItem.resourcetype === 'url'">
                <a :href="resourceItem.url" :target="resourceItem.openinnewtab ? '_blank' : ''" v-on:click="(e) => e.stopPropagation()">{{resourceItem.url}} </a>
                <h5>{{`(Opens ${resourceItem.openinnewtab?'in new tab' : 'here'})`}}</h5>
            </div>
            <div v-if="resourceItem.resourcetype === 'snippet'">
                <h5>Description</h5>
                <div>
                    {{resourceItem.description}}
                </div>
                <h5>HTML Snippet</h5>
                <VueEditor v-model="resourceItem.htmlsnippet" :disabled=true :editorToolbar="customToolbar"/>
            </div>
            <vue-pdf-embed v-if="resourceItem.filepath" :page=this.pdfPage :source="'\\storage\\' + resourceItem.filepath" />
        </div>
    </div>
</template>

<style>
h6 {
    font-size: 17px;
    font-weight: bold;
}
.card {
    transition: 0.4s easy;
    margin-bottom: 30px;
    box-shadow: 0px 2px 10px rgba(0,0,0,0.15);
}
.card img {
    box-shadow: 0px 2px 10px rgba(0,0,0,0.15);
}
.card-body{
    text-align: center;
    overflow: auto;
}
.card-header {
    display: flex;
}
.card-header img {
    height: 35px;
}
.actions {
    margin-left: auto;
}
</style>

<script>
import resourceService from "../services/resourceService";
import Helpers from "../Utilities/Helpers";

export default {
    data() {
        return {
            customToolbar: [
                ["code-block"]
            ]
        }
    },
    props : {
      resourceItem : {},
      pdfPage : Number | undefined
    },
    created() {

    },
    methods: {
        copyToClipboard(e){
            e.stopPropagation();
            Helpers.copyToClipboard(this.resourceItem.htmlsnippet);
        },
        getFileName(str){
            var fileName = str.split('/').at(-1);
            var firstPart = fileName.split('_')[0];
            return fileName.replace(firstPart + '_', '');
        },
        deleteResource(e){
            e.stopPropagation();
            if(confirm("Are you sure you want to delete this resource ?")){
                resourceService.deleteResource(this.resourceItem.id).then(response=>{
                    console.log('deleted')
                    this.$emit('deleted');
                }).catch(error=>{

                })
            }
        }
    }
}
</script>
