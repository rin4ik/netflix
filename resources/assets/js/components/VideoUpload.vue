<template>

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload</div>

                <div class="card-body">
                   
    
                    <div id="video-form" >
                 <div class="form-group">
                     <label for="url">URL</label>
                
                              
                                <input type="text" class="form-control" v-model="url">
                            </div>
                 </div>
                     
                            <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text"  class="form-control" v-model="title">
                            </div>

                            <div class="form-group">
                              <label for="description">Description</label>
                              <textarea class="form-control" v-model="description"></textarea>
                            </div>
                               
                            <div class="form-group">
                              <label for="Visibility">Visibility</label>
                              <select class="form-control" v-model="visibility">
                                <option value="private">Private</option> 
                                <option value="public">Public</option>
                              </select>
                            </div> 
                            <button class="btn btn-outline-success btn-sm" type="submit" @click.prevent="store" style="padding-right:10px ; padding-left:10px">Add video</button>
                              <div  v-if="feedback">
                                            <span  style="color:red" v-text="feedback" ></span>
                                    </div>
                    </div>  
               </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      feedback: "",
      url: null,
      failed: false,
      title: "Untitled",
      description: null,
      visibility: "private"
    };
  },
  methods: {
    store() {
      axios
        .post("/upload", {
          url: this.url,
          title: this.title,
          description: this.description,
          visibility: this.visibility
        })
        .then(response => {
          flash("Changes saved!", "success");
        })
        .catch(error => {
          this.feedback = error.response.data.message;
        });
    }
  },
  mounted() {
    window.onbeforeunload = () => {
      if (this.uploading && !this.uploadingComplete && !this.failed) {
        return "Are you sure you want to navigate away";
      }
    };
  }
};
</script>