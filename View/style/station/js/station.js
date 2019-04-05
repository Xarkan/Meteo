
function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      if (oldonload) {
        oldonload();
      }
      func();
    }
  }
}

function loadChart() {

}


function setChart(data, idchart) {
    let name = data.shift();
    let unit;
    if (name[1].unit == 'degC') {
        unit = '°C';
    }else{
        unit = name[1].unit;
    }
    let array = [];
    for (var i = 0; i < data.length; i++) {
        let str = data[i][0].split(' ');
        let date = str[0].split('-');
        let time = str[1].split(':');
        if (data[i][1] == null) {
            yVal = null;
        }else{
            yVal = Number(data[i][1]);
        }
        array[i] = { x: new Date(date[0],date[1],date[2],time[0],time[1]), y: yVal};   
    }

    if (data.length == 0) {
        name[0].variable = 'no data in this period';
    }

    let red = Math.floor(Math.random() * 255) + 50;
    let green = Math.floor(Math.random() * 255) + 50;
    let blue = Math.floor(Math.random() * 255) + 50;

    var chart = new CanvasJS.Chart("chartContainer"+idchart, {
        animationEnabled: true,
        zoomEnabled: true,
        theme: "light2",
        axisX:{
            title: name[0].variable
        },
        axisY:{
            title: name[1].variable,
            includeZero: false,
            suffix: unit
        },
        data: [{        
            type: "line",
            color: "rgb("+red+","+green+","+blue+")",
            connectNullData: true,
            //nullDataLineDashType: "solid",
            xValueType: "dateTime", 
            xValueFormatString: "HH:mm",
            yValueFormatString: "######.# "+unit,      
            dataPoints: array  
        }]
    });
chart.render();
}

function getData(id, idchart, params) {
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(xmlhttp.responseText);
            setChart(response, idchart);        //idchart   
        }
    };
    xmlhttp.open("POST","/Meteo/JSON/station/"+id, true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send(params);
}


function loadPage(id, chartlimit) {
    let d = new Date();
    let m;
    let day;
    if (d.getMonth() > 9 ) {
        m = d.getMonth() + 1;
    }else{
        m = '0'+(d.getMonth() + 1);
    }
    if (d.getDate() > 9 ) {
        day = d.getDate() + 1;
    }else{
        day = '0'+(d.getDate() + 1);
    }
    //let n = d.getFullYear()+'-'+m+'-'+day;
    let n = '2019-03-01';

    document.getElementById("from-date").value = n;
    document.getElementById("to-date").value = n;
    for (var i = 0; i < chartlimit; i++) {
        let vElem = document.getElementById("variable"+(i+1)).options[i].text;
        document.getElementById("variable"+(i+1)).options[i].selected = 'selected';
        params = 'from-date='+n+'&to-date='+n+'&variable='+vElem;
        getData(id, i+1, params);
    }

    document.getElementById('load-btn').onclick = function() {
        for (var i = 1; i <= chartlimit; i++) {
            let p = getSelectedValues(i);
            getData(id, i, p);
        }
    };

}

function getSelectedValues(idchart = 0) {
    let from = 'from-date='+document.getElementById("from-date").value;
    let to = 'to-date='+document.getElementById("to-date").value;
    let variable = '';
    if (idchart > 0) {
        let v = document.getElementById("variable"+idchart);
        variable = '&variable='+v.options[v.selectedIndex].text;
    } 
    params = from+'&'+to+variable;
    return params;
}

function addChart(id, idchart) {
    //html del nuovo grafico
    let html;
    document.getElementById('chart-container'+idchart+1).innerHTML = html;
    document.getElementById('chart-btn'+idchart).setAttribute('display', 'none');
    listener(id, idchart+1);

}

function selectCard(id, string) {
    if (string == 'charts') {
        document.getElementById('nav-item-charts').className = "nav-link active";
        document.getElementById('nav-item-photos').className = "nav-link";
        document.getElementById('nav-item-table').className = "nav-link";

        document.getElementById('variable1').style.disabled = false;
        document.getElementById('card-charts').style.display = "block";
        document.getElementById('card-photos').style.display = "none";
        document.getElementById('card-table').style.display = "none";
        document.getElementById('load-btn').onclick = function() {
            for (var i = 1; i <= 2; i++) { //dovrebbe essere chartlimit
                let p = getSelectedValues(i);
                getData(id, i, p);
            }
        };
    }
    if (string == 'photos') {
        document.getElementById('nav-item-charts').className = "nav-link";
        document.getElementById('nav-item-photos').className = "nav-link active";
        document.getElementById('nav-item-table').className = "nav-link";

        document.getElementById('variable1').style.disabled = true;
        document.getElementById('card-charts').style.display = "none";
        document.getElementById('card-photos').style.display = "block";
        document.getElementById('card-table').style.display = "none";
        document.getElementById('load-btn').onclick = function() {
            //load delle foto
        };
    }
    if (string == 'table') {
        document.getElementById('nav-item-charts').className = "nav-link";
        document.getElementById('nav-item-photos').className = "nav-link";
        document.getElementById('nav-item-table').className = "nav-link active";

        document.getElementById('variable1').style.disabled = true;
        document.getElementById('card-charts').style.display = "none";
        document.getElementById('card-photos').style.display = "none";
        document.getElementById('card-table').style.display = "block";
        document.getElementById('load-btn').onclick = function() {
            params = getSelectedValues();
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                var response = xmlhttp.responseText;
                    document.getElementById('table-container').innerHTML = response;
                }
            };
            xmlhttp.open("POST","/Meteo/HTML/station/"+id, true); 
            xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xmlhttp.send(params);
        };
    }

}

function loadCharts(id, chartlimit) {
    let f = document.getElementById("from-date").value;
    let t = document.getElementById("to-date").value;

    for (var i = 0; i < chartlimit; i++) {
        let v = document.getElementById("variable"+(i+1)).options[i].text;
        document.getElementById("variable"+(i+1)).options[i].selected = 'selected';
        params = 'from-date='+f+'&to-date='+t+'&variable='+v;
        getData(id, i+1, params);
    }
}

function loadPhotos(id, params = 0) {
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(xmlhttp.responseText);
            //photo code
        }
    };
    xmlhttp.open("POST","/Meteo/JSON/station/"+id, true); //altro path?
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send(params);
}

function loadTable(id) {
    let f = document.getElementById("from-date").value;
    let t = document.getElementById("to-date").value;
    params = 'from-date='+f+'&to-date='+t;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        var response = xmlhttp.responseText;
            document.getElementById('table-container').innerHTML = response;
        }
    };
    xmlhttp.open("POST","/Meteo/HTML/station/"+id, true); 
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send(params);
}