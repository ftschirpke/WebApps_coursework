const App = {
    created() {
        allCommentsReceived: false
    },
    data() {
        return {
            authUserId: bladeParams.userId,
            authUserIsAdmin: bladeParams.isAdmin,
            comments: []
        }
    },
    methods: {
        createComment() {
            axios.post(bladeParams.commentsStoreRoute, {
                user_id: bladeParams.userId,
                post_id: bladeParams.postId,
                message: document.getElementById('message').value
            })
                .then(response=>{
                    this.comments.unshift(response.data);
                    document.getElementById('message').value='';
                })
                .catch(response=>{
                    console.log(response);
                })
        },
        getMoreComments() {
            if (this.allCommentsReceived) return;
            axios.get(
                bladeParams.postRoute.replace('offset_value', this.comments.length)
            )
                .then(response=>{
                    if (response.data) {
                        this.comments.push(...response.data);
                    } else {
                        this.allCommentsReceived = true;
                    }    
                })
                .catch(response=>{
                    console.log(response);
                })
        },
        scroll () {
            window.onscroll = () => {
                let windowPos = Math.max(
                    window.pageYOffset,
                    document.documentElement.scrollTop,
                    document.body.scrollTop
                )
                let windowBottom = windowPos + window.innerHeight;                
                if (windowBottom === document.documentElement.offsetHeight) {
                    // scrolled to the bottom
                    this.getMoreComments(this.commentsCount);
                }
            }
        }
    },
    mounted() {
        this.getMoreComments(this.commentsCount);
        this.scroll();
    }
};
Vue.createApp(App).mount('#commentManagement');