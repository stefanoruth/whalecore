<template>
    <div class="container">
        <table border="1" class="table is-striped is-fullwidth">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>                   
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="template in templates" :key="template.id">
                    <td>{{template.title}}</td>
                    <td>{{template.type}}</td>            
                    <td>
                        <router-link :to="{name: 'template.edit', params: {id: template.id}}">Edit</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="is-clearfix">
            <button class="button is-success is-small is-pulled-right" @click="showModal = true" >Create</button>            
        </div>
        <modal :show="showModal" @close="closeModal">   
            <h1 slot="title">New Template</h1>            
            <div>
                <div class="field">
                    <label class="label" for="title">Template title</label>
                    <div class="control">
                        <input class="input" type="text" :class="{'border-red': errors != null}" v-model="newTemplateTitle" autofocus placeholder="Title..">
                        <p class="help is-danger" v-if="errors != null">{{ errors.title[0] }}</p>           
                    </div>
                </div>
                <div class="field">
                    <label for="" class="label"></label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select v-model="newTemplateType">
                                <option value="" selected disabled>Choose one</option>
                               <option v-for="Type in templateTypes" :key="Type.id" :value="Type.id">{{Type.name}}</option>
                            </select>
                        </div>
                        <p class="help is-danger" v-if="errors != null">{{ errors.type[0] }}</p>                                   
                    </div>
                </div>
            </div>
            <button class="button is-primary is-medium" slot="footer" @click="newTemplate">Create</button>
        </modal>
    </div>
</template>

<script>
export default {
  data() {
    return {
      templates: [],
      templateTypes: [],
      showModal: false,
      newTemplateTitle: null,
      newTemplateType: "",
      errors: null
    };
  },
  mounted() {
    axios.get(route("templates.index")).then(response => {
      this.templates = response.data.data;
    }),
      axios.get(route("types.index")).then(response => {
        this.templateTypes = response.data;
      });
  },
  methods: {
    newTemplate() {
      axios
        .post(route("templates.store"), {
          title: this.newTemplateTitle,
          type: this.newTemplateType
        })
        .then(response => {
            this.$router.push("/templates/" + response.data.data.id);
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    },
    closeModal(){
        this.showModal = false,
        this.errors = null
    }
  }
};
</script>
