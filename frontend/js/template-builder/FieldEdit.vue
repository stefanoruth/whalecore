<template>
    <modal :show="show" @close="$emit('close')">
        <div v-if="field != null">
            <div class="field">
                <label class="label">Title</label>
                <div class="control">
                    <input class="input" type="text" v-model="field.title">
                </div>
            </div>
             <div class="field">
                <label class="label">Id</label>
                <div class="control">
                    <input class="input" type="text" v-model="field.id">
                </div>
            </div>
            <div class="field" v-if="!hasSubFields()">
                <label class="label">Placeholder</label>
                <div class="control">
                    <input class="input" type="text" v-model="field.placeholder">
                </div>
            </div>
            <div class="field" v-if="!hasSubFields()">
                <label class="label">Default</label>
                <div class="control">
                    <input class="input" type="text" v-model="field.default">
                </div>
            </div>
             <div class="field" v-if="!hasSubFields()">
                <label class="label">Description</label>
                <div class="control">
                    <textarea class="textarea" placeholder="e.g. Hello world" v-model="field.description"></textarea>
                </div>
            </div>
            <div class="field" v-if="!hasSubFields()">
                <div class="control">
                    <label class="checkbox">          
                        <input type="checkbox" v-model="field.required">
                        Required
                    </label>
                </div>
            </div>
            <div class="field" v-if="!hasSubFields()">
                <label class="label">Minimum items in repeater</label>
                <div class="control">
                    <input class="input" type="number" v-model="field.min">
                </div>
            </div>
            <div class="field" v-if="!hasSubFields()">
                <label class="label">Maximum items in repeater</label>
                <div class="control">
                    <input class="input" type="number" v-model="field.max">
                </div>
            </div>
            <button class="button is-success" @click="$emit('save')">Save</button>
            <button class="button is-danger" @click="$emit('delete')">Delete</button>
        </div>
    </modal>
</template>

<script>
export default {
  props: ["show", "field"],

  methods: {
    hasSubFields() {
      return ["section", "repeater"].indexOf(this.field.type) > -1;
    }
  }
};
</script>