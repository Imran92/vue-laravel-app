<template>
    <div>
        <h3 class="text-center">{{isEdit ? 'Edit' : 'Create'}} Resource</h3>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form @submit.prevent="addResourceItem" class="form-horizontal">
                    <div class="form-group">
                        <label>Title</label>
                        <input name="itemTitle" type="text" class="form-control" v-model="form.itemTitle"  :class="{ 'is-invalid': form.errors.has('itemTitle') }">
                        <div v-if="form.errors.has('itemTitle')" v-html="form.errors.get('itemTitle')" />
                    </div>
                    <div class="form-group">
                        <label>ResourceType</label>
                        <select class="form-select" v-model="form.resourceType" name="customerName" id="" v-on:change="setSelected($event)">
                            <option v-for="(resType,key) in resourceTypes" :key="key">{{resType}}</option>
                        </select>
                    </div>
                    <div v-if="form.resourceType">
                        <div class="form-group" v-if="form.resourceType == 'snippet'">
                            <label>Description</label>
                            <textarea type="text" class="form-control" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                            <div v-if="form.errors.has('description')" v-html="form.errors.get('description')" />
                        </div>
                        <div class="form-group"  v-if="form.resourceType == 'snippet'">
                            <label>HTML Snippet</label>
                            <div style="background-color: white">
                                <VueEditor v-model="form.htmlsnippet" :editorToolbar="customToolbar" :class="{ 'is-invalid': form.errors.has('htmlsnippet') }"/>
                            </div>
                            <div v-if="form.errors.has('htmlsnippet')" v-html="form.errors.get('htmlsnippet')" />
                        </div>
                        <div class="form-group" v-if="form.resourceType == 'pdf'">
                            <label>Pdf</label>
                            <div>
                                <input type="file" @change='uploadPdf' name="photo" class="form-control" :class="{ 'is-invalid': form.errors.has('pdf') }">
                            </div>
                            <div class="mt-2" style="max-height: 50vh;overflow-y: auto">
                                <vue-pdf-embed v-if="filePath||pdf" :source="getPdf()" />
                            </div>
                        </div>
                        <div class="form-group"  v-if="form.resourceType == 'url'">
                            <label>Url</label>
                            <input name="url" type="text" class="form-control" v-model="form.url"  :class="{ 'is-invalid': form.errors.has('url') }">
                            <div v-if="form.errors.has('url')" v-html="form.errors.get('url')" />
                        </div>
                        <div class="form-check"  v-if="form.resourceType == 'url'">
                            <input id="openInNewTab" type="checkbox" class="form-check-input" @click="toggleNewTab"
                                   :checked="form.newtab"
                            />
                            <label class="form-check-label" for="openInNewTab">
                                Open in new tab
                            </label>
                        </div>
                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn btn-primary">{{this.isEdit ? 'Update' : 'Save'}} Resource</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style>
.is-invalid{
    border: 1px solid red;
}
</style>

<script>
import resourceService from "../services/resourceService";
export default {
    data() {
        return {
            isEdit : false,
            filePath : '',
            pdf : '',
            resourceTypes : [
                'pdf',
                'snippet',
                'url'
            ],
            resourceItem: {},
            tableData : {},
            customToolbar: [
                ["code-block"]
            ],
            form: new Form({
                id : '',
                itemTitle: '',
                resourceType : '',
                description: '',
                url : '',
                pdf : '',
                htmlsnippet : '',
                newtab : false
            })
        }
    },
    created() {
        if(this.$route.name === 'edit'){
            this.isEdit = true;
            resourceService.getResource(this.$route.params.id)
                .then((res) => {
                    let data = res;
                    this.filePath = data.filepath;
                    this.form.fill(data);
                });
        }
    },
    methods: {
        toggleNewTab(){
            this.form.newtab = !this.form.newtab;
        },
        getPdf(){
            if(this.pdf || this.filePath)
            return (this.pdf.length > 100) ? this.pdf : '\\storage\\' + this.filePath;
        },
        uploadPdf(e){
            let file = e.target.files[0];
            let reader = new FileReader();

            if(file['size'] < 2111775)
            {
                reader.onloadend = (file) => {
                    this.pdf = reader.result;
                }
                reader.readAsDataURL(file);
                this.form.pdf = file;
            }else{
                alert('File size can not be bigger than 2 MB')
            }
        },
        async addResourceItem() {
            this.form.post(`/api/resources${this.isEdit ? `/${this.form.id}?_method=PUT` : ''}`)
                .then(()=>{
                    Toast.fire({
                        icon: 'success',
                        title: 'Operation completed successfully'
                    }).then(res => {
                        this.$router.push({path: '/'});
                    })
                })
                .catch((ex)=>{
                    console.log(ex);
                });
        },
        setSelected(value) {
            //  trigger a mutation, or dispatch an action
            console.log(this.resourceItem);
        }
    }
}
</script>
