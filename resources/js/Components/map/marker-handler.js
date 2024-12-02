const kakao = window.kakao.maps

class MarkerHandler {
    constructor(vueKakaoMap) {
        this.kakao = window.kakao.maps;
        console.log("[vue component]", vueKakaoMap);
        this.vueMap = vueKakaoMap;
    }
    add(userData, fnConv) {
        userData.forEach(data => {
            const option = fnConv(data);
            // option.lat, option.lng
            const markerInstance = new kakao.maps.Marker({
                map: this.vueMap.mapInstance,
                position: new kakao.maps.LatLng(option.lat, option.lng),
            });
            console.log(markerInstance);
        });
    }
}

export default MarkerHandler;