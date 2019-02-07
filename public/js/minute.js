window.onload = function() {
    startTime();
    getSeconds();
    move();
};

function AutoRefresh( t ) {
    setTimeout("location.reload(true);", t);
    move();
}

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    //document.getElementById('txt').innerHTML =
    //h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
    if (s=="00"){
        location.reload(true);
    }
    //return s;
}

function getSeconds() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    var t = setTimeout(startTime, 500);
    //if (s=="00"){
    //  location.reload(true);
    //}
    return s;
}


function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

function move() {
    var elem = document.getElementById("myBar");
    var width = 1;
    var id = setInterval(frame, 600);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            //var seconds = document.getElementById("txt");
            //var splitseconds = seconds.split(":");
            //seconds = seconds[2];
            width++;
            elem.style.width = getSeconds()*1.67 + '%';
            //elem.innerHTML = startTime()*1.67;
        }
    }
}