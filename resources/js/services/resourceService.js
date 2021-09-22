import VueAxios from "vue-axios";
import axios from "axios";

class ResourceService {
    async getResources(){
        return axios.get('/api/resources').then(response=>{
            console.log(response);
            return response.data
        }).catch(error=>{
            console.log(error)
            return []
        })
    }
    async deleteResource(id){
        return await axios.delete(`/api/resources/${id}`);
    }
    async getResource(id) {
        return axios.get(`/api/resources/${id}`)
            .then((res) => {
                var data = {
                    itemTitle : res.data.title,
                    resourceType : res.data.resourcetype,
                    newtab : res.data.openinnewtab,
                    pdf : '',
                    ...res.data };
                return data;
            }).catch(error=>{
            console.log(error)
            return {}
        });

    }
}
export default new ResourceService();
