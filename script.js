
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBI6R8sVevfH7BRenzNJl8adVqk0-n7c6g",
    authDomain: "pyrologger-1494215723717.firebaseapp.com",
    databaseURL: "https://pyrologger-1494215723717.firebaseio.com",
    projectId: "pyrologger-1494215723717",
    storageBucket: "pyrologger-1494215723717.appspot.com",
    messagingSenderId: "994783014875"
  };
  firebase.initializeApp(config);



Date.prototype.addHours = function(h) {    
   this.setTime(this.getTime() + (h*60*60*1000)); 
   return this;   
}

// Shortcuts to DOM Elements.
var containerDiv = document.getElementById('container');
var tempLabel = document.getElementById('templabel');


$.getJSON('data.php?callback=?', function (data) {

    Highcharts.chart('container', {
        chart: {
            zoomType: 'x'
        },
        title: {
            text: 'Mill Creek Pottery Kiln Temp'
        },
        subtitle: {
            text: 'Data Logging brought to you by chewing gum and bailing wire.'
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%e. %b',
                year: '%b'
            },
            title: {
                text: 'Date'
            }
        },
        yAxis: {
            title: {
                text: 'Kiln Temp (F)'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, '#ff0000'],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 1,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series: [{
            type: 'area',
            name: 'Workshop Firing',
            data: data
        }]
    });
}); 




$(function() {
   
    // Get a reference to the database service
    //var database = firebase.database();

    var commentsRef = firebase.database().ref('logger/510038000c51353432393339/');
    // Retrieve new posts as they are added to Firebase
    commentsRef.limitToLast(1).on("child_added", function(data) {
        var dataEvent = data.val();
        tempLabel.innerText = dataEvent.data + " degrees";
        $("#templabel").fadeOut(500).fadeIn(100);
        var t = dataEvent.time.split(/[- :T]/);
        var d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
        console.log(d);
//        $("#lastupdated").text(d.toUTCString());
        $("#lastupdated").text(d.addHours(5).toLocaleString("en-US", {timeZone: "America/Chicago"}));
        $("#templabel").fadeOut(500).fadeIn(100);
        $("#lastupdated").fadeOut(500).fadeIn(100);
        // $('#container').highcharts().series[0].addPoint({
        //     //x: new Date(dataEvent.time),
        //     x: d,
        //     y: dataEvent.data
        // }, false);

        // // added points; redraw
        // $('#container').highcharts().redraw();

      
      console.log(dataEvent);
      
    });
});



// Analytics
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48607929-4', 'auto');
  ga('send', 'pageview');
