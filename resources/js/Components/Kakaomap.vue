<template>
    <div class="controll">
        <button @click="zoom(-1)">
            <img src="/images/icon1.png" alt="" class="icon">
        </button>
        <button @click="zoom(1)">
            <img src="/images/icon2.png" alt="" class="icon">
        </button>
    </div>
    <div class="map-area">
      <div class="harbors">
        <div class="harbor" v-for="hbr in harbors" :key="hbr.seq" @click="showOnMap(hbr)">
          <h4>{{ hbr.place }}</h4>
        </div>
      </div>
      <div ref="map" class="kmap"></div>
    </div>
</template>

<script>
let kakao = window.kakao
import MarkerHandler from "@/Components/map/marker-handler";
import api from "@/services/api";

export default {
  props: {
    options: {
      type: Object,
      required: true,
      default: () => ({
        center: { lat: 35.1379222, lng: 129.05562775 },
        level: 8,
      }),
    },
  },
  data() {
    return {
      mapInstance: null,
      harbors: [],
      markers: null,
    };
  },
  mounted() {
    kakao = kakao || window.kakao;
    const { center, level } = this.options;
    const container = this.$refs.map;
    const vueKakaoMap = this.$refs.kmap;
    
    // 맵 초기화
    this.mapInstance = new window.kakao.maps.Map(container, {
      center: new window.kakao.maps.LatLng(center.lat, center.lng),
      level,  
    });

    this.markers = new MarkerHandler(vueKakaoMap);

    api.harbor.all((res) => {
      console.log("[항구목록]", res.harbors);
      this.harbors = res.harbors;
      // 마커 생성
      // this.markers.add(this.harbors, (harbor) => {
      //   return { lat: harbor.lat, lng: harbor.lng };
      // });
    });

    
  },
  watch: {
    // level 값이 변경되면 지도에 반영하도록 처리
    'options.level'(cur, prev) {
      console.log(`[LEVEL CHANGED] ${prev} => ${cur}`);
      this.mapInstance.setLevel(cur);
    },
    "options.center"(cur) {
      console.log("[NEW CENTER]", cur.lat, cur.lng);
      this.mapInstance.setCenter(new kakao.maps.LatLng(cur.lat, cur.lng));
    },
  },
  methods: {
      
    zoom(delta) { // 줌 기능
    //   console.log('[delta]', delta);
      const level = Math.max(3, this.options.level + delta)
      this.options.level = level;
      this.mapInstance.setLevel(level);
    //   console.log(this.options.level);
    },
    showOnMap(harbor) {
      console.log("[center]", harbor);
      this.options.center = {
        lat: harbor.lat,
        lng: harbor.lng,
      };
    },
  },
};
</script>

<style>
.kmap{
    height: 500px;
}
button:hover{
    background-color: rgb(226, 224, 224);
}
.icon{
    width: 50px;
    height: 50px;
}
h4{
  margin: 10px 5px 10px 5px;
  cursor: pointer;
}

.map-area{
  display: flex;
  .kmap {
    flex: 1 1 auto;
  }
}

.harbor:hover{
  border: 1px solid #000;
}
</style>