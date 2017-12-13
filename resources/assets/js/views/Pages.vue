<template>
    <div class="container">
        <table border="1" class="table is-striped is-fullwidth">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Template</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="page in pages" :key="page.id">
                    <td>{{page.title}}</td>
                    <td>{{page.slug}}</td>
                    <td>{{page.template.title}}</td>
                    <td>
                        <router-link :to="{name: 'page.edit', params: {id: page.id}}">Edit</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="is-clearfix">
            <button class="button is-success is-small is-pulled-right" @click="showModal = true" >Create</button>            
        </div>
        <modal :show="showModal" @close="closeModal">   
            <h1 slot="title">New Page</h1>            
            <div>
                <div class="field">
                    <label class="label" for="title">Page Title</label>
                    <div class="control">
                        <input class="input" type="text" :class="{'border-red': errors != null}" v-model="pageTitle" autofocus placeholder="Title..">
                        <p class="help is-danger" v-if="errors != null">{{ errors.title[0] }}</p>           
                    </div>
                </div>
                <div class="field">
                    <label for="" class="label"></label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select v-model="pageTemplate">
                                <option value="" selected disabled>Choose one</option>
                               <option v-for="template in templates" :key="template.id" :value="template.id">{{template.title}}</option>
                            </select>
                        </div>
                        <p class="help is-danger" v-if="errors != null">{{ errors.template[0] }}</p>                                   
                    </div>
                </div>
            </div>
            <button class="button is-primary is-medium" slot="footer" @click="newPage">Create</button>
        </modal>
    </div>
</template>

<script>
export default {
  data() {
    return {
      pages: [],
      templates: [],
      pageTemplate: "",
      pageTitle: "",
      showModal: false,
      errors: null
    };
  },
  mounted() {
    axios
      .get(route("items.index"), { params: { type: "page" } })
      .then(response => {
        this.pages = response.data.data;
      }),
    axios.get(route("templates.index"), {params: { type: "page" } })
    .then(response => {
        this.templates = response.data.data;
    });
  },
   methods: {
        newPage() {
        axios
            .post(route("items.store"), {
            title: this.pageTitle,
            template: this.pageTemplate
            })
            .then(response => {
                this.$router.push("/pages/" + response.data.data.id);
            })
            .catch(error => {
            this.errors = error.response.data.errors;
            })
        },
        closeModal(){
            this.showModal = false,
            this.errors = null
        }        
    }
}
</script>
