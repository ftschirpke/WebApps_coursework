// searching for "cc"-parameter in url parameters
const query = window.location.search;
const params = new URLSearchParams(query);
// this parameter says if we are creating a comment
let creating_comment = params.get("cc") ? true : false;

const App = {
    data() {
        return {
            cc: creating_comment,
            comments: bladeParams.comments_pagination.data
        }
    }//,
    // mounted() {
    //     axios.get("{{ route('api.posts.show', ['post'=>$post]) }}")
    //         .then(response=>{
    //             this.comments.push(response.data.data);
    //             console.log(this.comments);
    //         })
    //         .catch(response=>{
    //             console.log("Error:")
    //             console.log(response);
    //         })
    // }
};
Vue.createApp(App).mount('#cc');