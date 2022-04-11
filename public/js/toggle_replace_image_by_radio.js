const ToggleReplaceImage = {
    data() {
        return {
            replaceImage: false
        }
    },
    methods: {
        onChange(event) {
            let optionText = event.target.value;
            if (optionText == 'replace') {
                this.replaceImage = true;
            } else {
                this.replaceImage = false;
            }
        }
    }
}
Vue.createApp(ToggleReplaceImage).mount('#editPost')