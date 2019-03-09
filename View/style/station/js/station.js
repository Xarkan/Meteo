
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


function setData(data, idchart) {
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
    console.log(data);
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
            setData(response, idchart);        //idchart   
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
    let var1 = document.getElementById("variable1").options[0].text;
    let var2 = document.getElementById("variable2").options[1].text;
    document.getElementById("variable2").options[1].selected = 'selected';
    document.getElementById("from-date").value = n;
    document.getElementById("to-date").value = n;
    params1 = 'from-date='+n+'&to-date='+n+'&variable='+var1+'&resolution=max';
    params2 = 'from-date='+n+'&to-date='+n+'&variable='+var2+'&resolution=max';
    getData(id, 1, params1);
    getData(id, 2, params2);
    for (var i = 1; i <= chartlimit; i++) {
        listener(id,i);
    }
}

function listener(id, idchart) {
    var from = '';
    var to = '';
    from = 'from-date='+document.getElementById("from-date").value;
    document.getElementById("from-date").addEventListener("change", function() {
        from = 'from-date='+this.value;
    });
    to = 'to-date='+document.getElementById("to-date").value;
    document.getElementById("to-date").addEventListener("change", function() {
        to = 'to-date='+this.value;
        var tdate = this.value;
        var tdateEntered = new Date(tdate);
        console.log(tdate); //e.g. 2015-11-13
    });

    document.getElementById('load-btn'+idchart).addEventListener("click", function() {
        var v = document.getElementById("variable"+idchart);
        var vstrUser = v.options[v.selectedIndex].text;
        var r = document.getElementById("resolution");
        var rstrUser = r.options[r.selectedIndex].text;

        params = from+'&'+to+'&variable='+vstrUser+'&resolution='+rstrUser;

        getData(id, idchart, params);     
    });
}

function addChart(id, idchart) {
    //html del nuovo grafico
    let html;
    document.getElementById('chart-container'+idchart+1).innerHTML = html;
    document.getElementById('chart-btn'+idchart).setAttribute('display', 'none');
    listener(id, idchart+1);

}

function selectCard(string) {
    if (string == 'charts') {
        document.getElementById('nav-item-charts').className = "nav-link active";
        document.getElementById('nav-item-photos').className = "nav-link";
        document.getElementById('nav-item-table').className = "nav-link";

        document.getElementById('card-charts').style.display = "block";
        document.getElementById('card-photos').style.display = "none";
        document.getElementById('card-table').style.display = "none";
    }
    if (string == 'photos') {
        document.getElementById('nav-item-charts').className = "nav-link";
        document.getElementById('nav-item-photos').className = "nav-link active";
        document.getElementById('nav-item-table').className = "nav-link";

        document.getElementById('card-charts').style.display = "none";
        document.getElementById('card-photos').style.display = "block";
        document.getElementById('card-table').style.display = "none";
    }
    if (string == 'table') {
        document.getElementById('nav-item-charts').className = "nav-link";
        document.getElementById('nav-item-photos').className = "nav-link";
        document.getElementById('nav-item-table').className = "nav-link active";

        document.getElementById('card-charts').style.display = "none";
        document.getElementById('card-photos').style.display = "none";
        document.getElementById('card-table').style.display = "block";
    }

}
