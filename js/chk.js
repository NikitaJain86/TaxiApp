(function(){
    var e="";
    jwplayer=function(n){
        e=n;
        return t
        };
        
    var t={
        setup:function(){
            var n="There was an error retrieving your embed.:Please double check your hosted URL in your <a href='http://account.jwplayer.com'>JW Dashboard</a>.";
            if(typeof error_message!=="undefined")n=error_message;
            var r=document.getElementById(e);
            var i=r.style;
            i.backgroundColor="#000";
            i.color="#FFF";
            i.width="480px";
            i.height="270px";
            i.display="table";
            i.opacity=1;
            var s=document.createElement("p"),o=s.style;
            o.verticalAlign="middle";
            o.textAlign="center";
            o.display="table-cell";
            o.font="15px/20px Arial, Helvetica, sans-serif";
            s.innerHTML=n.replace(":",":<br>");
            r.innerHTML="";
            r.appendChild(s);
            return t
            },
        getRenderingMode:function(){
            return t
            },
        onReady:function(e){
            return t
            },
        getPlaylist:function(){
            return t
            },
        getPlaylistItem:function(e){
            return t
            },
        load:function(e){
            return t
            },
        playlistItem:function(e){
            return t
            },
        onPlaylist:function(e){
            return t
            },
        onPlaylistItem:function(e){
            return t
            },
        onComplete:function(e){
            return t
            },
        onPlaylistComplete:function(e){
            return t
            },
        getBuffer:function(){
            return t
            },
        onBufferChange:function(e){
            return t
            },
        getState:function(){
            return t
            },
        play:function(e){
            return t
            },
        pause:function(e){
            return t
            },
        stop:function(){
            return t
            },
        onBeforePlay:function(e){
            return t
            },
        onPlay:function(e){
            return t
            },
        onPause:function(e){
            return t
            },
        onBuffer:function(e){
            return t
            },
        onIdle:function(e){
            return t
            },
        getPosition:function(){
            return t
            },
        getDuration:function(){
            return t
            },
        seek:function(e){
            return t
            },
        onSeek:function(e){
            return t
            },
        onTime:function(e){
            return t
            },
        getMute:function(){
            return t
            },
        getVolume:function(){
            return t
            },
        setMute:function(e){
            return t
            },
        setVolume:function(e){
            return t
            },
        onMute:function(e){
            return t
            },
        onVolume:function(e){
            return t
            },
        getFullscreen:function(){
            return t
            },
        getHeight:function(){
            return t
            },
        getWidth:function(){
            return t
            },
        resize:function(e,n){
            return t
            },
        onFullscreen:function(e){
            return t
            },
        getQualityLevels:function(){
            return t
            },
        getCurrentQuality:function(){
            return t
            },
        setCurrentQuality:function(e){
            return t
            },
        onQualityLevels:function(e){
            return t
            },
        onQualityChange:function(e){
            return t
            },
        addButton:function(e,n,r,i){
            return t
            },
        removeButton:function(e){
            return t
            },
        getControls:function(){
            return t
            },
        getSafeRegion:function(){
            return t
            },
        setControls:function(e){
            return t
            },
        onControls:function(e){
            return t
            },
        onDisplayClick:function(e){
            return t
            },
        onError:function(e){
            return t
            },
        onMeta:function(e){
            return t
            }
        }
})();/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


