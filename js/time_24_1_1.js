function CurrentTime(containerNode, startTimeStamp) {
    var self = this,
    timer,
    weekDays = ["วันอาทิตย์", "วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัสบดี", "วันศุกร์", "วันเสาร์"],
    months = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
    now = new Date(),
    prevTickTimeStamp,
    currTickTimeStamp;
        

    function addLeadingZero(v) {
        var s = v < 0 ? "-" : "";
        v  = Math.abs(v);

        return s + (v < 10 ? "0" + v : v);
    }

    function generateTimeString() {
        var year = now.getUTCFullYear() + 543;
        //months[now.getUTCMonth()]
        //now.getUTCHours()
        ////weekDays[now.getUTCDay()]
        //months[now.getUTCMonth()] + ":" + addLeadingZero(now.getUTCMinutes()) + ":" + addLeadingZero(now.getUTCSeconds())
        return weekDays[now.getUTCDay()]+ " , " + now.getUTCDate() + " " +months[now.getUTCMonth()]+ " " +year+ " "
        + now.getUTCHours() + ":" + addLeadingZero(now.getUTCMinutes()) + ":" + addLeadingZero(now.getUTCSeconds());
    }

    function secondTick() {
        currTickTimeStamp = new Date().getTime();
        now.setTime((currTickTimeStamp - prevTickTimeStamp) + startTimeStamp);

        containerNode.nodeValue = generateTimeString();
    }

    this.start = function () {
        clearInterval(timer);
        prevTickTimeStamp = (new Date()).getTime();
        timer = setInterval(secondTick, 1000);
    }
}