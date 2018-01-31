<template>
    <textarea :id="generatedId"></textarea>
</template>

<script>
    export default {
        props : ['value'],

        data() {
            return {
                generatedId: null,
            };
        },

        beforeMount() {
            this.generatedId = 'tinyMCE'+window.generateID();
        },
        
        mounted () {
            tinymce.init({
                selector: `#${this.generatedId}`,
                init_instance_callback: (editor) => {
                    editor.on('KeyUp', (e) => {
                        this.$emit('input', editor.getContent());
                    });
                    editor.on('Change', (e) => {
                        this.$emit('input', editor.getContent());
                    });
                    
                    editor.setContent(this.value !== null ? this.value : "");
                },
                skin_url: "tinymce",
                branding: false,
                menubar: false,
                plugins: "fullscreen code lists link image table",
                toolbar: "formatselect | bold italic underline | alignleft aligncenter alignright | fontselect | fontsizeselect | outdent indent blockquote | link hr image | bullist numlist | table | removeformat | fullscreen code",
            });
        },

        destroyed () {
            tinymce.get(this.generatedId).destroy();
        },
    }
</script>