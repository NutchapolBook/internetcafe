@extends('layouts.masterCafe')

@section('content')
  <div class="col-sm-12">
      <h2>Booking</h2><br>

      <style type="text/css">
      .ui-accordion .ui-accordion-content {
        padding: 1px;
      }
      </style>



<script id="code">
  // General Parameters for this app, used during initialization
  var AllowTopLevel = true;
  var CellSize = new go.Size(50, 50);
  function init() {
    if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
    var $ = go.GraphObject.make;
    myDiagram =
      $(go.Diagram, "myDiagramDiv",
        {
          grid: $(go.Panel, "Grid",
                  { gridCellSize: CellSize },
                  $(go.Shape, "LineH", { stroke: "lightgray" }),
                  $(go.Shape, "LineV", { stroke: "lightgray" })
                ),
          // support grid snapping when dragging and when resizing
          "draggingTool.isGridSnapEnabled": true,
          "draggingTool.gridSnapCellSpot": go.Spot.Center,
          "resizingTool.isGridSnapEnabled": true,
          allowDrop: true,  // handle drag-and-drop from the Palette
          // For this sample, automatically show the state of the diagram's model on the page
          "ModelChanged": function(e) {
              if (e.isTransactionFinished) {
                document.getElementById("savedModel").textContent = myDiagram.model.toJson();
              }
            },
          "animationManager.isEnabled": false,
          "undoManager.isEnabled": true
        });
    // Regular Nodes represent items to be put onto racks.
    // Nodes are currently resizable, but if that is not desired, just set resizable to false.
    function showMessage(s) {
      document.getElementById("changeMethodsMsg").style.color = "Blue";
      document.getElementById("changeMethodsMsg").textContent = s;
    }

    function showMessagestatus(s) {
      var ss = document.getElementById("changeMethodsMsgstatus");
      if (s == "Busy") {
        ss.style.color = "red";
        ss.textContent = s;
      }
      else if(s == "Available"){
        ss.style.color = "#00FF00";
        ss.textContent = s;
      }
      else{
        ss.style.color = "#CC33CC";
        ss.textContent = s;
      }


    }

    myDiagram.nodeTemplate =
      $(go.Node, "Auto",
      {
        resizable: false, resizeObjectName: "SHAPE",
        // because the gridSnapCellSpot is Center, offset the Node's location
        locationSpot: new go.Spot(0, 0, CellSize.width / 2, CellSize.height / 2),
        // provide a visual warning about dropping anything onto an "item"
        mouseDragEnter: function(e, node) {
          e.handled = true;
          node.findObject("SHAPE").fill = "red";
          highlightGroup(node.containingGroup, false);
        },
        mouseDragLeave: function(e, node) {
          node.updateTargetBindings();
        },
        mouseDrop: function(e, node) {  // disallow dropping anything onto an "item"
          node.diagram.currentTool.doCancel();
        }
      },
        // always save/load the point that is the top-left corner of the node, not the location
        new go.Binding("position", "pos", go.Point.parse).makeTwoWay(go.Point.stringify),
        // this is the primary thing people see
        $(go.Shape, "RoundedRectangle",
          { name: "SHAPE",
            fill: "white",
            strokeWidth: 2 ,
            minSize: CellSize,
            desiredSize: CellSize  // initially 1x1 cell
          },
          new go.Binding("fill", "color"),

          new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify)),


        // with the textual key in the middle
        $(go.TextBlock,
          { alignment: go.Spot.Center, font: 'bold 16px sans-serif',},
          new go.Binding("text", "key")),
          {
            click: function(e, obj)
            {
              if (obj.part.data.color == "red"){
                // var busy = "Busy"
                // var result = busy.fontcolor("red")
                showMessage("" + obj.part.data.key)
                showMessagestatus("Busy");
              }
              else if (obj.part.data.color == '#B2FF59') {
                showMessage("" + obj.part.data.key)
                showMessagestatus("Available");
              }
              else{
                showMessage("" + obj.part.data.key)
                showMessagestatus("None")
              };
              },

              // showMessage("" + obj.part.data.key + " " + status); },
            // selectionChanged: function(part) {
            //   var shape = part.elt(0);
            //   shape.fill = part.isSelected ? "red" : "#B2FF59";
            // }
          }
      );  // end Node


    // Groups represent racks where items (Nodes) can be placed.
    // Currently they are movable and resizable, but you can change that
    // if you want the racks to remain "fixed".
    // Groups provide feedback when the user drags nodes onto them.
    function highlightGroup(grp, show) {
      if (!grp) return;
      if (show) {  // check that the drop may really happen into the Group
        var tool = grp.diagram.toolManager.draggingTool;
        var map = tool.draggedParts || tool.copiedParts;  // this is a Map
        if (grp.canAddMembers(map.toKeySet())) {
          grp.isHighlighted = true;
          return;
        }
      }
      grp.isHighlighted = false;
    }
    var groupFill = "rgba(128,128,128,0.2)";
    var groupStroke = "gray";
    var dropFill = "rgba(128,255,255,0.2)";
    var dropStroke = "red";
    myDiagram.groupTemplate =
      $(go.Group,
        { selectionAdorned: false },
        {
          layerName: "Background",
          resizable: false, resizeObjectName: "SHAPE",
          // because the gridSnapCellSpot is Center, offset the Group's location
          locationSpot: new go.Spot(0, 0, CellSize.width/2, CellSize.height/2)
        },
        // always save/load the point that is the top-left corner of the node, not the location
        new go.Binding("position", "pos", go.Point.parse).makeTwoWay(go.Point.stringify),
        { // what to do when a drag-over or a drag-drop occurs on a Group
          mouseDragEnter: function(e, grp, prev) { highlightGroup(grp, true); },
          mouseDragLeave: function(e, grp, next) { highlightGroup(grp, false); },
          mouseDrop: function(e, grp) {
            var ok = grp.addMembers(grp.diagram.selection, true);
            if (!ok) grp.diagram.currentTool.doCancel();
          }
        },
        $(go.Shape, "Rectangle",  // the rectangular shape around the members
          { name: "SHAPE",
            fill: groupFill,
            stroke: groupStroke,
            minSize: new go.Size(CellSize.width*2, CellSize.height*2)
          },
          new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
          new go.Binding("fill", "isHighlighted", function(h) { return h ? dropFill : groupFill; }).ofObject(),
          new go.Binding("stroke", "isHighlighted", function(h) { return h ? dropStroke: groupStroke; }).ofObject())
      );
    // decide what kinds of Parts can be added to a Group
    myDiagram.commandHandler.memberValidation = function(grp, node) {
      if (grp instanceof go.Group && node instanceof go.Group) return false;  // cannot add Groups to Groups
      // but dropping a Group onto the background is always OK
      return false;
    };
    // what to do when a drag-drop occurs in the Diagram's background
    myDiagram.mouseDragOver = function(e) {
      if (!AllowTopLevel) {
        // but OK to drop a group anywhere
        if (!e.diagram.selection.all(function(p) { return p instanceof go.Group; })) {
          e.diagram.currentCursor = "not-allowed";
        }
      }
    };
    myDiagram.mouseDrop = function(e) {
      if (AllowTopLevel) {
        // when the selection is dropped in the diagram's background,
        // make sure the selected Parts no longer belong to any Group
        if (!e.diagram.commandHandler.addTopLevelParts(e.diagram.selection, true)) {
          e.diagram.currentTool.doCancel();
        }
      } else {
        // disallow dropping any regular nodes onto the background, but allow dropping "racks"
        if (!e.diagram.selection.all(function(p) { return p instanceof go.Group; })) {
          e.diagram.currentTool.doCancel();
        }
      }
    };
    // start off with four "racks" that are positioned next to each other
    myDiagram.model = new go.GraphLinksModel([
      { key: "G1", isGroup: true, pos: "0 0", size: "200 200" },

    ]);
    // this sample does not make use of any links
    jQuery("#accordion").accordion({
      activate: function(event, ui) {
        myPaletteSmall.requestUpdate();
      }
    });


    var selectionButton = document.getElementById("seatname");
    selectionButton.addEventListener("click", function() {
    myDiagram.startTransaction("get key");
    var it = myDiagram.selection.iterator;
    while (it.next()) {
      var node = it.value;
      var shape = node.findObject("SHAPE");
      var key = node.data.key;
      document.getElementById("seatname").value = key;
    }
    myDiagram.commitTransaction("get key");
  });

  load();


    // initialize the first Palette
    myPaletteSmall =
      $(go.Palette, "myPaletteSmall",
        { // share the templates with the main Diagram
          nodeTemplate: myDiagram.nodeTemplate,
          groupTemplate: myDiagram.groupTemplate,
          layout: $(go.GridLayout)
        });
    var green = '#B2FF59';
    var blue = '#81D4FA';
    var yellow = '#FFEB3B';
    // specify the contents of the Palette
    myPaletteSmall.model = new go.GraphLinksModel([
      { key: "Seat", color: yellow }
    ]);


  }


    function load() {
      // var tjs = document.getElementById("tjs").value
      var tjs = sessionStorage.getItem("SelectedItem");
      myDiagram.model = go.Model.fromJson(tjs);
        }




  function flash() {
     var model = myDiagram.model;
     // all model changes should happen in a transaction
     model.startTransaction("flash");
     var data = model.nodeDataArray[3];  // get the first node data
     model.setDataProperty(data, "highlight", !data.highlight);
     model.commitTransaction("flash");
  }

    function loop() {
        setTimeout(function() { flash(); loop(); }, 500);
      }



</script>
</head>
  <!-- <div class="form-group">
    <p align="center">
    <form name="jump" class="center">
    <select name="menu" onchange="gotoPage(this)">
    <option value="#">Select an option</option>
    <option value="/cafe/{{$user1[0]->cafename}}/booking/">Link 1</option>
    <option value="/cafe/{{$user1[0]->cafename}}/booking/booking2">Link 2</option>

    </select>
    <input type="button" onClick="location=document.jump.menu.options[document.jump.menu.selectedIndex].value;" value="GO">
    </form>
    </p>

    <script type="text/javascript">
    function gotoPage(select){
        window.location = select.value;
    }
    </script>
  </div> -->

  <div>
  <h2 align="center" id="showtime"></h2>
  </div>



  <!-- onchange="options[selectedIndex].value&&self.location.reload(true);" -->
  <strong for="date">Time to play  </strong>:
  <select id="target" >
            <option value="" selected="selected">Selecting Time</option>
            <option value="{{$user[0]->tojson}}">00.00 - 01.00</option>
            <option value="{{$user[0]->tojson2}}">01.00 - 02.00</option>
            <option value="{{$user[0]->tojson3}}">02.00 - 03.00</option>
            <option value="{{$user[0]->tojson4}}">03.00 - 04.00</option>
            <option value="{{$user[0]->tojson5}}">04.00 - 05.00</option>
            <option value="{{$user[0]->tojson6}}">05.00 - 06.00</option>
            <option value="{{$user[0]->tojson7}}">06.00 - 07.00</option>
            <option value="{{$user[0]->tojson8}}">07.00 - 08.00</option>
            <option value="{{$user[0]->tojson9}}">08.00 - 09.00</option>
            <option value="{{$user[0]->tojson10}}">09.00 - 10.00</option>
            <option value="{{$user[0]->tojson11}}">10.00 - 11.00</option>
            <option value="{{$user[0]->tojson12}}">11.00 - 12.00</option>
            <option value="{{$user[0]->tojson13}}">12.00 - 13.00</option>
            <option value="{{$user[0]->tojson14}}">13.00 - 14.00</option>
            <option value="{{$user[0]->tojson15}}">14.00 - 15.00</option>
            <option value="{{$user[0]->tojson16}}">15.00 - 16.00</option>
            <option value="{{$user[0]->tojson17}}">16.00 - 17.00</option>
            <option value="{{$user[0]->tojson18}}">17.00 - 18.00</option>
            <option value="{{$user[0]->tojson19}}">18.00 - 19.00</option>
            <option value="{{$user[0]->tojson20}}">19.00 - 20.00</option>
            <option value="{{$user[0]->tojson21}}">20.00 - 21.00</option>
            <option value="{{$user[0]->tojson22}}">21.00 - 22.00</option>
            <option value="{{$user[0]->tojson23}}">22.00 - 23.00</option>
            <option value="{{$user[0]->tojson24}}">23.00 - 00.00</option>

    </select>

      <script>

      // $("#target").on('change', function () {
      //   var check = ($(this).find('option:selected').attr('id'));
      //   alert(check);
      // });

      // var i = selMovType.selectedIndex;
      // aleart(selMovType.options[i].text);

      // var selectedItem = sessionStorage.getItem("SelectedItem");
      // alert(selectedItem);




      // $("#target").change(function() {
      //   var id = $("#target option:selected").attr("id")
      //   id = selectedItem;
      // });
      // $("select#target option[value="+dropVal+"]").attr('selected', true);
      var selMovType = document.getElementById('target');
      var selecteditem = sessionStorage.getItem('SelectedItem');
      var selectedID = sessionStorage.getItem('Selectedid');
      var check = sessionStorage.getItem('test');

      var checks = sessionStorage.getItem('timplay');

      // document.getElementById('showtime').textContent = checks;
        document.getElementById('showtime').textContent = checks;
        // document.getElementById('amount').textContent = amount;


      // if(check == selectedID){

        // selMovType.value = selecteditem;
      // }




      $('#target').change(function() {
        var dropVal = $(this).val();
        var dropValid = $("#target option:selected").attr("id");
        var myvar = selMovType.options[selMovType.selectedIndex].id;

        sessionStorage.setItem("SelectedItem", dropVal);
        sessionStorage.setItem("Selectedid", dropValid);
        sessionStorage.setItem("test", myvar);

        var index = document.getElementById("target").selectedIndex;
        var result = document.getElementById("target").options[index].text;


        sessionStorage.setItem("timplay", result);


        window.location.reload(true);

        // alert("value =" + document.getElementById("target").value); // show selected value
        // alert("text =" + result); // show selected text

      });

      </script>


<body onload="init()">
<form action="{{route('cafe.booking.update',  $cafename)}}" method="post">
    {{ csrf_field() }}


    <!-- <select  id="booktjs" name="booktjs" onchange="bjson(this.value)">
      <option value="" disabled selected>Choose your time</option>
      <option value="{{$user[0]->tojson}}">00.00-01.00</option>
      <option value="">01.00-02.00</option>
      <option value="">02.00-03.00</option>

    </select>
    <script>
    function bjson(val)
    {

    var btjs=val;
    var divobj = document.getElementById('tjs');
    divobj.value = btjs;
    document.location = '/cafe/test_cafe/booking';
    }
    </script> -->




  <div class="form-group">

      <strong for="date">Date  </strong>:
      <span style="font-size:30px;" id="dates"></span>
      <br>
      <strong for="time">Time  </strong>:
      <span style="font-size:30px;" id="clock"></span>
      <br>
      <script>
      (function () {

        var clockElement = document.getElementById( "clock" );
        function updateClock ( clock ) {
          clock.innerHTML = new Date().toLocaleTimeString();

        }

        setInterval(function () {
          updateClock( clockElement );
        }, 1);

        var dateElement = document.getElementById( "dates" );
        function updateTime ( clock ) {
          clock.innerHTML = new Date().toDateString();

        }

        setInterval(function () {
          updateTime( dateElement );
        }, 1);

      }());
      </script>
      <input type="hidden" name="amount" id="amount" value="{{$cafe[0]->price}}">
      <strong>Amount </strong>: <span style="font-size:20px;" id="cafeprice"></span>
      <script >
          var amounts = document.getElementById("amount").value;
          cafeprice.innerHTML = amounts+ " Baht/hour";
      </script>

      <br>
      <strong for="name">Seat Number </strong>: <input type="hidden" name="seatname" id="seatname" value="" >
      <span id="changeMethodsMsg" style="font-size:25px;"></span>
      <br>
      <strong for="name">Status </strong>:
      <!-- style="display:none" -->
      <span style="font-size:25px;" id="changeMethodsMsgstatus"></span>



      <!-- <script>
      var span_Text = document.getElementById("changeMethodsMsgstatus").innerText;
      </script> -->

      <br>
      <!-- <strong for="time">Hours: </strong> -->
      <input hidden  id="time" name="time" value="1">
        <!-- <option value="" disabled selected>Choose your hours</option>
        <option value="1">1 hr</option>
        <option value="2">2 hrs</option>
        <option value="3">3 hrs</option>
        <option value="4">4 hrs</option>
        <option value="5">5 hrs</option>
        <option value="6">6 hrs</option>
        <option value="7">7 hrs</option>
        <option value="8">8 hrs</option>
        <option value="9">9 hrs</option>
        <option value="10">10 hrs</option>
        <option value="11">11 hrs</option>
        <option value="12">12 hrs</option>
        <option value="13">13 hrs</option>
        <option value="14">14 hrs</option>
        <option value="15">15 hrs</option>
        <option value="16">16 hrs</option>
        <option value="17">17 hrs</option>
        <option value="18">18 hrs</option>
        <option value="19">19 hrs</option>
        <option value="20">20 hrs</option>
        <option value="21">21 hrs</option>
        <option value="22">22 hrs</option>
        <option value="23">23 hrs</option>
        <option value="24">24 hrs</option>
      </select> -->


      <!-- <br> -->
      <!-- <script>
      function calculateAmount(val)
      {
      var price = val * document.getElementById('cafeprice').value;
      //display the result
      var timeplay=price;
      var divobj = document.getElementById('amount');
      divobj.value = timeplay;
      }
      </script> -->

      <input type="hidden" name="starttime" id="starttime" value="" >
      <input type="hidden" name="endtime" id="endtime" value="" >
      <input type="hidden" name="date" id="date" value="" >
      <input type="hidden" name="status" id="status" value="" >
      <input type="hidden" name="showtime2" id="showtime2" value="" >



  </div>


  <div class="form-group">
    <!-- type="hidden" -->
  <input type="hidden" name="tjs" id="tjs" class="form-control" value="" >
  <!-- <input type="hidden" name="tjs2" id="tjs2" class="form-control" value = "{{$user[0]->tojson2}}">
  <input type="hidden" name="tjs3" id="tjs3" class="form-control" value = "{{$user[0]->tojson3}}">
  <input type="hidden" name="tjs4" id="tjs4" class="form-control" value = "{{$user[0]->tojson4}}">
  <input type="hidden" name="tjs5" id="tjs5" class="form-control" value = "{{$user[0]->tojson5}}">
  <input type="hidden" name="tjs6" id="tjs6" class="form-control" value = "{{$user[0]->tojson6}}">
  <input type="hidden" name="tjs7" id="tjs7" class="form-control" value = "{{$user[0]->tojson7}}">
  <input type="hidden" name="tjs8" id="tjs8" class="form-control" value = "{{$user[0]->tojson8}}">
  <input type="hidden" name="tjs9" id="tjs9" class="form-control" value = "{{$user[0]->tojson9}}">
  <input type="hidden" name="tjs10" id="tjs10" class="form-control" value = "{{$user[0]->tojson10}}">
  <input type="hidden" name="tjs11" id="tjs11" class="form-control" value = "{{$user[0]->tojson11}}">
  <input type="hidden" name="tjs12" id="tjs12" class="form-control" value = "{{$user[0]->tojson12}}">
  <input type="hidden" name="tjs13" id="tjs13" class="form-control" value = "{{$user[0]->tojson13}}">
  <input type="hidden" name="tjs14" id="tjs14" class="form-control" value = "{{$user[0]->tojson14}}">
  <input type="hidden" name="tjs15" id="tjs15" class="form-control" value = "{{$user[0]->tojson15}}">
  <input type="hidden" name="tjs16" id="tjs16" class="form-control" value = "{{$user[0]->tojson16}}">
  <input type="hidden" name="tjs17" id="tjs17" class="form-control" value = "{{$user[0]->tojson17}}">
  <input type="hidden" name="tjs18" id="tjs18" class="form-control" value = "{{$user[0]->tojson18}}">
  <input type="hidden" name="tjs19" id="tjs19" class="form-control" value = "{{$user[0]->tojson19}}">
  <input type="hidden" name="tjs20" id="tjs20" class="form-control" value = "{{$user[0]->tojson20}}">
  <input type="hidden" name="tjs21" id="tjs21" class="form-control" value = "{{$user[0]->tojson21}}">
  <input type="hidden" name="tjs22" id="tjs22" class="form-control" value = "{{$user[0]->tojson22}}">
  <input type="hidden" name="tjs23" id="tjs23" class="form-control" value = "{{$user[0]->tojson23}}">
  <input type="hidden" name="tjs24" id="tjs24" class="form-control" value = "{{$user[0]->tojson24}}"> -->


  <input type="hidden" name="balance" id="balance" class="form-control" value="{{$user1[0]->balance}}">

     <!-- date_default_timezone_set("Asia/Bangkok");
    $checktime = document.getElementById('clock').textContent;
    echo date("h:i:sa", $checktime); -->


  <button  id="selectionButton" >Purchase</button>
  <script>

  var selectionButton = document.getElementById("selectionButton");
  selectionButton.addEventListener("click", function() {
    var bal = parseInt(document.getElementById("balance").value);
    var amt = parseInt(document.getElementById("amount").value);
    var status = document.getElementById('changeMethodsMsgstatus').textContent;
    var seatname = document.getElementById('changeMethodsMsg').textContent;
    var time = document.getElementById('clock').textContent;
    var dd = new Date();
    var date = dd.toDateString();
    var hh = parseInt(dd.getHours());
    var mm = dd.getMinutes();
    var ss = dd.getSeconds();
    var test =dd.toLocaleTimeString();


    // var timeplay = parseInt(document.getElementById("time").value);
    var endtime = document.getElementById('showtime').textContent;

    // if (mm < 10) {
    //   if (hh+timeplay < 24) {
    //     if(hh+timeplay < 10){
    //       endtime = "0"+(hh+timeplay)+":"+"0"+mm+":"+ss;
    //     }
    //     else{
    //       endtime = (hh+timeplay)+":"+"0"+mm+":"+ss;
    //     }
    //   }
    //   else if (hh+timeplay > 24) {
    //     if (hh+timeplay-24 < 10) {
    //       var check = "0"+(hh+timeplay-24);
    //       endtime = (check)+":"+"0"+mm+":"+ss;
    //     }
    //     else{
    //       var check = (hh+timeplay-24);
    //       endtime = (check)+":"+"0"+mm+":"+ss;
    //     }
    //   }
    //   else{
    //     var check = "00";
    //     endtime = (check)+":"+"0"+mm+":"+ss;
    //   }
    // }
    //
    // else if(mm >= 10){
    //   if (hh+timeplay < 24) {
    //     if(hh+timeplay < 10){
    //       endtime = "0"+(hh+timeplay)+":"+mm+":"+ss;
    //     }
    //     else{
    //       endtime = (hh+timeplay)+":"+mm+":"+ss;
    //     }
    //   }
    //   else if (hh+timeplay > 24) {
    //     if (hh+timeplay-24 < 10) {
    //       var check = "0"+(hh+timeplay-24);
    //       endtime = (check)+":"+mm+":"+ss;
    //     }
    //     else{
    //       var check = (hh+timeplay-24);
    //       endtime = (check)+":"+mm+":"+ss;
    //     }
    //   }
    //   else{
    //     var check = "00";
    //     endtime = (check)+":"+mm+":"+ss;
    //   }
    // }

      document.getElementById("starttime").value = time;
      document.getElementById("endtime").value = endtime;
      document.getElementById("date").value = date;
      document.getElementById("status").value = status;
      document.getElementById("showtime2").value = checks;



    // dt.setHours(10, 30, 53);
    // var endTime = (strtotime(selectedTime . +1 hours));

    if (bal >= amt && status == "Available") {
      if (confirm("Confirm Seat")) {
        alert("Your select seat "+seatname+" is complete \nStart at "+date+" time "+checks);

        myDiagram.startTransaction("change color");
        var it = myDiagram.selection.iterator;


        while (it.next()) {
          var node = it.value;
          var shape = node.findObject("SHAPE");
          // If there was a GraphObject in the node named SHAPE, then set its fill to red:
          if (shape !== null) {
            shape.fill = "red";
          }
          myDiagram.model.setDataProperty(node.data, "color", "red");
        }
        

        document.getElementById("tjs").value = myDiagram.model.toJson();
        sessionStorage.setItem('SelectedItem', document.getElementById("tjs").value);
        myDiagram.commitTransaction("change color");


        }
        else{
          document.getElementById("status").value = "Busy";
        }
      }
      // else if(document.getElementById("seatname").value == "1"){
      //     alert(document.getElementById("changeMethodsMsg").value);
      //     alert("Please select your seat");
      // }

        else if (status == "") {

            alert("Please select seat");

          }
        else if(status == "Busy"){
            alert("This seat is busy try to selecting another seat")
        }
        else if(status == "None"){
          alert("Try to selecting a seat")
        }
        else{
        alert("Your balance has not enough");
        }


    });


  </script>

  <script>
  var selectionButton = document.getElementById("selectionButton");
  selectionButton.addEventListener("click", function() {
  myDiagram.startTransaction("get key");
  var it = myDiagram.selection.iterator;
  while (it.next()) {
    var node = it.value;
    var shape = node.findObject("SHAPE");
    var key = node.data.key;
    document.getElementById("seatname").value = key;
  }
  myDiagram.commitTransaction("get key");
  })
  </script>



  </div>



<div id="sample">
  <div style="width: 100%; display: flex; justify-content: space-between">

    <div  id="myDiagramDiv" style="flex-grow: 1; height: 500px; border: solid 1px black"></div>
  </div>

  <div>
    <pre hidden id="savedModel" style="height:250px"></pre>
  </div>

</div>




      @include('layouts.error')

  </div>

@endsection
