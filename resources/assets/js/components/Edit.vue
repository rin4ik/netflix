
  <template>
         <div style="flex">
           
           <form @submit="destroy">
            <a @click="show" class="btn btn-outline-default btn-sm ">Edit</a>
                                    <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>    
            </form>
          <transition enter-active-class="animated fadeInUpBig" leave-active-class="animated shake" mode="out-in" appear>
         <modal :name="`update-${video.id}`" height="auto" width="550px" >
               <form @submit.prevent="update">



               <div class="card-body " style="background:#fbfbfc"  >
                        <div class="modal-header " >
                    <h5 class="modal-title" style="text-align:center;">UPDATE    </h5>
            </div>
                        <div class="form-group" style="padding-top:30px;">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                             v-model="title">

                        </div>
                        <div class="form-group">
                                <label for="description">Descrition</label>
                                <textarea name="description" id="description" class="form-control" v-model="description">
                                </textarea>

                            </div>
                            <div class="form-group">
                              <label for="visibility">Visibility</label>
                                    <select name="visibility" id="visibility" class="form-control" v-model="visibility" >
                                      <option v-for="visibility in ['private','public']">{{visibility}}</option>
                                    </select>

                                </div>
                              
                                <div class="modal-footer" style="background:#f5f8fa;border:1px solid rgb(204, 208, 211);">
                                    <button type="submit" class="btn btn-success btn-sm" :class="loading ?  'loader':''">
                                        Update
                                    </button>
                                      <a   class="btn btn-danger btn-sm" @click="$modal.hide(`update-${video.id}`)" >
                                        CAncel
                                  </a>
                                </div>
                                    </div>
                        </form>

          </modal>
        </transition>
           
        </div>

  </template>

  <script>
export default {
  props: ["video"],
  data() {
    return {
      feedback: "",
      loading: false,
      title: this.video.title,
      description: this.video.description,
      visibility: this.video.visibility
    };
  },
  methods: {
    destroy() {
      axios.delete("/videos/" + this.video.uid);
      setTimeout(flash("Deleted!", "danger"), 8000);
    },
    update() {
      this.loading = true;
      axios
        .put("/videos/" + this.video.uid, {
          title: this.title,
          description: this.description,
          visibility: this.visibility
        })
        .then(response => {
          flash("Updated!");
          this.loading = false;
        })
        .catch(error => {
          this.feedback = error.response.data.errors;
          this.loading = false;
        });
    },
    show() {
      this.$modal.show(`update-${this.video.id}`);
    }
  }
};
</script>