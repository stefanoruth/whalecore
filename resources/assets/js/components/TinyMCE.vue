<template>
    <textarea :id="generatedId"></textarea>
</template>

<script>
    export default {
        props : {
            id: {
                type: String,
                required: true
            },
            value: String,
        },

        computed: {
            generatedId: function() {
                return 'tinyMce-'+this.id;
            },
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