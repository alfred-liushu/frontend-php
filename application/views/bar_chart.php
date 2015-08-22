<!--
Draw bar chart with d3.js
@author	liushu@qinggukeji.com
//-->

<script src="//cdn.bootcss.com/d3/3.5.6/d3.min.js"></script>

<style>
  .axis path,
  .axis line{
    fill: none;
    stroke: black;
    shape-rendering: crispEdges;
  }

  .axis text {
    font-family: sans-serif;
    font-size: 11px;
  }

  .rect-barchart {
    fill: steelblue;
  }

  .text-barchart {
    fill: white;
    text-anchor: middle;
  }
</style>

<script>
  var width = 600, height = 360;
  var margin = {left:20, right:20, top:20, bottom:40};
  var rectmargin = 2;
  var textmargin = 20;

  var svg = d3.select("<?=$selection?>")
    .append("svg")
    .attr("width", width)
    .attr("height", height);

  var index = [<?php foreach ($data as $key => $value) echo '"' . $key . '",'; ?>];
  var dataset = [<?php foreach ($data as $key => $value) echo $value . ','; ?>];

  var xScale = d3.scale.ordinal()
    .domain(index)
    .rangeRoundBands([0, width - margin.left - margin.right]);

  var yScale = d3.scale.linear()
    .domain([0,d3.max(dataset)])
    .range([height - margin.top - margin.bottom, 0]);

  var xAxis = d3.svg.axis()
    .scale(xScale)
    .orient("bottom");

  var yAxis = d3.svg.axis()
    .scale(yScale)
    .orient("left");

  var rects = svg.selectAll(".rect-barchart")
    .data(dataset)
    .enter()
    .append("rect")
    .attr("class", "rect-barchart")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
    .attr("x", function(d,i){
        return xScale(index[i]) + rectmargin;
    })
    .attr("y", function(d){
        return yScale(d);
    })
    .attr("width", xScale.rangeBand() - rectmargin*2)
    .attr("height", function(d){
        return height - margin.top - margin.bottom - yScale(d);
    });

  var texts = svg.selectAll(".text-barchart")
    .data(dataset)
    .enter()
    .append("text")
    .attr("class","text-barchart")
    .attr("transform","translate(" + margin.left + "," + margin.top + ")")
    .attr("x", function(d,i){
        return xScale(index[i]) + rectmargin;
    })
    .attr("y",function(d){
        return yScale(d);
    })
    .attr("dx",function(){
        return xScale.rangeBand()/2 - rectmargin;
    })
    .attr("dy",function(d){
        return textmargin;
    })
    .text(function(d){
        return d;
    });

  svg.append("g")
    .attr("class","axis")
    .attr("transform","translate(" + margin.left + "," + (height - margin.bottom) + ")")
    .call(xAxis); 

  svg.append("g")
    .attr("class","axis")
    .attr("transform","translate(" + margin.left + "," + margin.top + ")")
    .call(yAxis);
</script>