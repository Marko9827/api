class eronelit {

    constructor(id, KEY, page) {
        this.id = id;
        this.KEY = KEY;
        this.page = page;
    }
    country() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
            });
        }
    }
    flags() {
        
        var searchParams = new URLSearchParams(window.location.search);
        var flag_XX = searchParams.get('flag');
        if (flag_XX !== null) {
            var eronelit = "";
            if (window.XMLHttpRequest) {
                eronelit = new XMLHttpRequest();
            } else {
                eronelit = new ActiveXObject("Microsoft.XMLHTTP");
            }
            eronelit.onreadystatechange = function () {
                if (eronelit.readyState == 4 && eronelit.status == 200) {


                    document.open();
                    document.write(`<style> * { margin:0px; padding:0px; } body { background:black; }</style> ${eronelit.response}`);
                    document.close();


                }

            };
            eronelit.open('GET', '/flags/' + flag_XX + '.svg', true);
            eronelit.send(null);
        } 
    }

    run() {
        this.flags();

    }

    time() {
        var return_st = "";
        var timer = {
            time: function () {
                let time = new Date();
                let hh = time.getHours();
                let mm = time.getMinutes();
                let ss = time.getSeconds();
                return_st = hh + ":" + mm + ":" + ss;
            },
            date: function () {
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                return_st = mm + '/' + dd + '/' + yyyy;
            }
        };
        return return_st;

    }
}