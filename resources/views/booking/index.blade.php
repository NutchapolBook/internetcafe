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
  var AllowTopLevel = false;
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
      else{
        ss.style.color = "#00FF00";
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
          new go.Binding("fill", "highlight", function(v) { return v ? "red" : "#B2FF59"; }),
          new go.Binding("stroke", "highlight", function(v) { return v ? "black" : "black"; }),
          new go.Binding("stroke", "isSelected", function(sel) {
              return sel ? "black" : "black";
            }).ofObject(),
          new go.Binding("fill", "color")),  // no name means bind to the whole Part


        // with the textual key in the middle
        $(go.TextBlock,
          { alignment: go.Spot.Center, font: 'bold 16px sans-serif' },
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
              else{
                showMessage("" + obj.part.data.key)
                showMessagestatus("Available")
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
    var tjs = document.getElementById("tjs").value
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
  <div class="form-group">

  </div>


<body onload="init()">
<form action="{{route('cafe.booking.update',  $cafename)}}" method="post">
    {{ csrf_field() }}

  <div class="form-group">
      <strong for="date">Date  </strong>:
      <span style="font-size:30px;" id="dates"></span>
      <br>
      <strong for="time">Time  </strong>:
      <span style="font-size:30px;" id="clock"></span>
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
      <strong for="time">Hours: </strong>
      <select  id="time" name="time" onchange="calculateAmount(this.value)" required>
        <option value="" disabled selected>Choose your time</option>
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
      </select>


      <br>
      <strong>Amount (THB)</strong>: <input type="text" name="amount" id="amount" readonly >
      <br>
      <script>
      function calculateAmount(val)
      {
      var price = val * 12;
      //display the result
      var timeplay=price;
      var divobj = document.getElementById('amount');
      divobj.value = timeplay;
      }
      </script>

      <input type="hidden" name="starttime" id="starttime" value="" >
      <input type="hidden" name="endtime" id="endtime" value="" >
      <input type="hidden" name="date" id="date" value="" >
      <input type="hidden" name="status" id="status" value="" >



  </div>


  <div class="form-group">
  <input type="hidden" name="tjs" id="tjs" class="form-control" value="{{$user[0]->tojson}}">
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

    var timeplay = parseInt(document.getElementById("time").value);
    var endtime = "";

    if (mm < 10) {
      if (hh+timeplay < 24) {
        if(hh+timeplay < 10){
          endtime = "0"+(hh+timeplay)+":"+"0"+mm+":"+ss;
        }
        else{
          endtime = (hh+timeplay)+":"+"0"+mm+":"+ss;
        }
      }
      else if (hh+timeplay > 24) {
        if (hh+timeplay-24 < 10) {
          var check = "0"+(hh+timeplay-24);
          endtime = (check)+":"+"0"+mm+":"+ss;
        }
        else{
          var check = (hh+timeplay-24);
          endtime = (check)+":"+"0"+mm+":"+ss;
        }
      }
      else{
        var check = "00";
        endtime = (check)+":"+"0"+mm+":"+ss;
      }
    }

    else if(mm >= 10){
      if (hh+timeplay < 24) {
        if(hh+timeplay < 10){
          endtime = "0"+(hh+timeplay)+":"+mm+":"+ss;
        }
        else{
          endtime = (hh+timeplay)+":"+mm+":"+ss;
        }
      }
      else if (hh+timeplay > 24) {
        if (hh+timeplay-24 < 10) {
          var check = "0"+(hh+timeplay-24);
          endtime = (check)+":"+mm+":"+ss;
        }
        else{
          var check = (hh+timeplay-24);
          endtime = (check)+":"+mm+":"+ss;
        }
      }
      else{
        var check = "00";
        endtime = (check)+":"+mm+":"+ss;
      }
    }

      document.getElementById("starttime").value = time;
      document.getElementById("endtime").value = endtime;
      document.getElementById("date").value = date;
      document.getElementById("status").value = status;




    // dt.setHours(10, 30, 53);
    // var endTime = (strtotime(selectedTime . +1 hours));

    if (bal >= amt && document.getElementById("amount").value != "" && status == "Available") {
        // alert(endtime);
        alert("Your select seat "+seatname+" is complete \nStart at "+date+" time "+time+" "+"to"+" "+endtime);

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
        myDiagram.commitTransaction("change color");

      }
      // else if(document.getElementById("seatname").value == "1"){
      //     alert(document.getElementById("changeMethodsMsg").value);
      //     alert("Please select your seat");
      // }
      else if (document.getElementById("amount").value == "" &&  document.getElementById("seatname").value == "") {
          alert("Please select seat and your time play");
        }
      else if(status == "Busy"){
          alert("This seat is busy try to select other seat")
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
