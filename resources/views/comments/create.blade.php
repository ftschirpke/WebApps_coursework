<x-navbar active=""/>
<x-app-layout>
    <x-slot name="title">
        Create a Comment
    </x-slot>

    <button id="create_comment_button" class="btn btn-warning" type="button">
        Create Comment
    </button>

    
    <h1>Create Comment</h1>
    <div id="message">
        <p>@{{ message }}</p>
    </div>
    <div id="create comment">
        YOU WANT TO CREATE A COMMENT?!?!?
    </div>

    <div id="app">
        <button v-on:click="isHidden = true">Hide the text below</button>
        <button v-on:click="isHidden = !isHidden">Toggle hide and show</button>
        
        <h1 v-if="!isHidden">Hide me on click event!</h1>
    </div>

    <script>    
        let creating_comment = false;
        var x = document.getElementById("create comment");
        x.style.display = "none";
        const crcombtn = document.getElementById("create_comment_button");
        crcombtn.addEventListener("click", ()=>{
            creating_comment = creating_comment !== true;
            var x = document.getElementById("create comment");
            if (creating_comment) {
                x.style.display = "block";
                crcombtn.innerText = "Cancel";
            } else {
                x.style.display = "none";
                crcombtn.innerText = "Create Comment";
            }
        });
        const Message = {
            data() {
                return {
                    message: "HI" + creating_comment
                };
            }
        }
        Vue.createApp(Message).mount("#message");

        var app = new Vue({
            el: '#app',
            data: {
                isHidden: false
            }
        });

        </script>


</x-app-layout>