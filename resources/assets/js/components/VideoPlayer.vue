<template>
  <video
   id="video"
    class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9"
    controls preload="auto"
     data-setup='{"fluid":true,"playbackRates": [0.5, 1, 1.5, 2,2.5] }'
     :poster="thumbnailUrl"> 
     <source :src="videoUrl"  type='video/youtube'>
  </video>

</template>
<script>
import videojs from "video.js";
import youtube from "videojs-youtube";
import hotkeys from "videojs-hotkeys";
export default {
  props: {
    videoUid: null,
    videoUrl: null,
    thumbnailUrl: null
  },
  data() {
    return {
      player: null,
      duration: null
    };
  },

  mounted() {
    this.player = videojs("video");
    this.player.hotkeys({
      seekStep: 10,
      playbackRate: [0.5, 1, 1.5, 2, 2.5]
    });
    this.player.on("loadedmetadata", () => {
      axios
        .post("/videos/" + this.videoUid + "/views")
        .then(response => {
          flash("Changes saved!", "success");
        })
        .catch(error => {
          this.feedback = error.response.data.message;
        });
    });
  }
};
</script>