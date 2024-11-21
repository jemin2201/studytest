<template>
    <div class="controll">
        <button @click="zoom(1)">
            <img src="/images/icon1.png" alt="" class="icon">
        </button>
        <button @click="zoom(-1)">
            <img src="/images/icon2.png" alt="" class="icon">
        </button>
    </div>
    <div ref="map" class="kmap">

    </div>
</template>

<script>
export default {
  props: {
    options: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      mapInstance: null,
    };
  },
  mounted() {
    const kakao = window.kakao;
      const { center, level } = this.options;
      const container = this.$refs.map;

      // 지도 초기화
      this.mapInstance = new kakao.maps.Map(container, {
        center: new kakao.maps.LatLng(center.lat, center.lng),
        level,
      });
  },
  watch: {
    // level 값이 변경되면 지도에 반영하도록 처리
    'options.level'(cur, prev) {
      console.log(`[LEVEL CHANGED] ${prev} => ${cur}`);
      this.mapInstance.setLevel(cur);
    },
  },
  method() {
    
  },
  methods: {
      
    zoom(delta) {
    //   console.log('[delta]', delta);
      const level = Math.max(3, this.options.level + delta)
      this.options.level += level;
    //   console.log(this.options.level);
    },
  },
};
</script>

<style>
.kmap{
    width: 100%;
    height: 300px;
}
button:hover{
    background-color: rgb(226, 224, 224);
}
.icon{
    width: 50px;
    height: 50px;
}
</style>