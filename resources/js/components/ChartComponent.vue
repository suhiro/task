<template>
  <div class="chart" ref="chartdiv">
  </div>
</template>

<script>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

am4core.useTheme(am4themes_animated);


export default {
  name: 'chart-component',
  props: ['data'],
    data() {
      return {
          logs:this.data
      }

    },
  mounted() {
      var colorSet = new am4core.ColorSet();
      colorSet.saturation = 0.4;

      _.forEach(this.logs, value => {
         if(value.on == 1){
             value.color = 'blue'
         } else {
             value.color = 'grey'
         }
      });
    console.log(this.logs)

    let chart = am4core.create(this.$refs.chartdiv, am4charts.XYChart);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.paddingRight = 30;
chart.dateFormatter.inputDateFormat = "yyyy-MM-dd HH:mm:ss";



// chart.data = [
//   {
//     dsid: "Device 1",
//     start: "2018-01-01 08:00",
//     end: "2018-01-01 08:05",
//
//   },
//   {
//     dsid: "Device 1",
//     start: "2018-01-01 12:00",
//     end: "2018-01-01 15:00",
//
//   },
//   {
//     dsid: "Device 1",
//     start: "2018-01-01 15:30",
//     end: "2018-01-01 21:30",
//
//   },
//
// ];

  chart.data = this.data;

  var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = 'dsid';
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.inversed = true;

  var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
  dateAxis.dateFormatter.dateFormat = "yyyy-MM-dd HH:mm";
  dateAxis.renderer.minGridDistance = 60;
  dateAxis.baseInterval = { count: 1, timeUnit: "minute" };
  // dateAxis.max = new Date().getTime();
      dateAxis.max = new Date('2019-07-02').getTime();
  dateAxis.strictMinMax = false;
  dateAxis.renderer.tooltipLocation = 0;

  var series1 = chart.series.push(new am4charts.ColumnSeries());
  series1.columns.template.width = am4core.percent(80);
  series1.columns.template.tooltipText = "{name}: {openDateX} - {dateX}";

  series1.dataFields.openDateX = "start";
  series1.dataFields.dateX = "end";
  series1.dataFields.categoryY = "dsid";

  series1.columns.template.propertyFields.fill = "color"; // get color from data
  series1.columns.template.propertyFields.stroke = "color";
  series1.columns.template.strokeOpacity = 1;

  chart.scrollbarX = new am4core.Scrollbar();    

  },

  beforeDestroy() {
    if (this.chart) {
      this.chart.dispose();
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.chart {
  width: 100%;
  height: 200px;
}
</style>
