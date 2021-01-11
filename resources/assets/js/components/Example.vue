<template>
    
    <div class="container" style="margin-top:50px;">
    <h1>Post List</h1>
    <button name="submit" class="btn btn-success">Add New Post</button>
    <hr>
        <div class="row justify-content-center">
            <div class="col-md-8">
                            <table class="table table-dark">
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>slug</th>
                                <th colspan="2">Actions</th>
                            </tr>
                            <tr v-for="item in list" :key="item.id">
                                <td>{{item.id}}</td>
                                <td>{{item.title}}</td>
                                <td>{{item.slug}}</td>
                                <td> <a v-bind:href="'http://127.0.0.1:8000/post-edit/'+item.id" ><span class="glyphicon glyphicon-edit"></span></a></td>
                                <td> <a v-bind:href="'http://127.0.0.1:8000/posts-delete/'+item.id"  ><span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                            </table>
                          <!-- <p v-for="item in list" :key="item.id">
                            <a v-bind:href="'http://127.0.0.1:8000/posts/'+item.id" target="_blank">{{item.title}}</a>
                          </p> -->
                          <infinite-loading @distance="1" @infinite="infiniteHandler"></infinite-loading>
 
                   
                </div>
            </div>
        </div>

</template>
 
<script>

    export default {
        data() {
            return {
              list: [],
              page: 1,
            };
          },
          methods: {
            infiniteHandler($state) {
            axios
            .get('http://127.0.0.1:8000/posts/?page='+this.page)
           
                    .then(response => {
                        console.log(response.data.data)
                        return response.data;
                        
                    }).then(data => {
                        
                        $.each(data.data, (key, value)=> {
                                this.list.push(value);
                        });
                    setInterval(() => {
                        $state.loaded();
                    }, 5000)
                    });
 
                this.page = this.page + 1;
            },
          },
    }
</script> 