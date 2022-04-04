<x-navbar active=""/>
<x-app-layout>
    <x-slot name="title">
        Create a Comment
    </x-slot>

    <h1>Create Comment</h1>
    <div id="message">
        <p>@{{ message }}</p>
    </div>

    <script>
        const Message = {
            data() {
                return {
                    message: "HI"
                }
            }
        };
        Vue.createApp(Message).mount("#message");
    </script>


</x-app-layout>