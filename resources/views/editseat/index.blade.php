
@extends('layouts.masterCafe')

@section('content')
  <div class="col-sm-12">
      <h2>Edit Seat</h2><br>

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
    myDiagram.nodeTemplate =
      $(go.Node, "Auto",
        {
          resizable: true, resizeObjectName: "SHAPE",
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
        $(go.Shape, "Rectangle",
          { name: "SHAPE",
            fill: "white",
            minSize: CellSize,
            desiredSize: CellSize  // initially 1x1 cell
          },
          new go.Binding("fill", "color"),
          new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify)),
        // with the textual key in the middle
        $(go.TextBlock,
          { alignment: go.Spot.Center, font: 'bold 16px sans-serif' },
          new go.Binding("text", "key"))
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
        {
          layerName: "Background",
          resizable: true, resizeObjectName: "SHAPE",
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
      return true;
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
      { key: "G1", isGroup: true, pos: "0 0", size: "400 400" },

    ]);
    // this sample does not make use of any links
    jQuery("#accordion").accordion({
      activate: function(event, ui) {
        myPaletteSmall.requestUpdate();
      }
    });

    // when the document is modified, add a "*" to the title and enable the "Save" button
    myDiagram.addDiagramListener("Modified", function(e) {
      var button = document.getElementById("SaveButton");
      if (button) button.disabled = !myDiagram.isModified;
      var idx = document.title.indexOf("*");
      if (myDiagram.isModified) {
        if (idx < 0) document.title += "*";
      } else {
        if (idx >= 0) document.title = document.title.substr(0, idx);
      }
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
  // var tjs =   document.getElementById("savedModel").value;
  //
  // function save() {
  // tjs = myDiagram.model.toJson();
  // myDiagram.isModified = true;
  //     }
  function load() {
    var tjs = document.getElementById("tjs").value
    myDiagram.model = go.Model.fromJson(tjs);
      }

</script>

</head>

<body onload="init()">
<form action="{{route('cafe.editseat.update',  $cafename)}}" method="post">
  {{ csrf_field() }}


<div class="form-group">
  <input type="hidden" name="tjs" id="tjs" class="form-control" value="{{$user[0]->tojson}}">
  <button onclick="myFunctionupdate()">Update</button>
  <!-- <button onclick="myFunctionload()">Load</button> -->
<script>
function myFunctionupdate() {
    document.getElementById("tjs").value = myDiagram.model.toJson();
}
</script>

<!-- <script>
function myFunctionload() {
    var tjs = document.getElementById("tjs").value
    myDiagram.model = go.Model.fromJson(tjs);
}
</script> -->

  <!-- <input type="text" name="load" id="loadtjs" class="form-control" value="{{$user[0]->tojson}}">
  <button onclick="myFunction()">Load</button>
<script>
function myFunction() {
    var tjs = document.getElementById("loadtjs").value
    myDiagram.model = go.Model.fromJson(tjs);
}
</script> -->

</div>
</form>




<div id="sample">
  <div style="width: 100%; display: flex; justify-content: space-between">
    <div style="width: 135px; margin-right: 2px; background-color: whitesmoke; border: solid 1px black">
      <div id="accordion">
        <h4>Drag a seat</h4>
        <div>
          <div id="myPaletteSmall" style="width: 140px; height: 360px"></div>
        </div>
      </div>
    </div>
    <div id="myDiagramDiv" style="flex-grow: 1; height: 500px; border: solid 1px black"></div>
  </div>

  <div>
    <!-- <button id="SaveButton" onclick="save()">Save</button>
    <button onclick="load()">Load</button> -->
    Diagram Model saved in JSON format, automatically updated after each transaction:
    <pre id="savedModel" style="height:250px" ></pre>
  </div>

</div>




      @include('layouts.error')

  </div>

@endsection
