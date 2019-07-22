<template>
  <div>
    <div class="row justify-content-between">
      <div class="col-5">
        <select class="custom-select" v-model="selectedDevice" @change="updateChart">
          <option v-for="device in devices" :value="device.dsid" v-text="device.full_name"></option>
        </select>
      </div>

      <div class="col-3">
        <flat-pickr v-model="pickrDate" class="form-control bg-white" placeholder="Select date"></flat-pickr>
      </div>

    </div>
    <div class="chart" ref="chartdiv">
    </div>
  </div>

</template>

<script>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";


am4core.useTheme(am4themes_animated);


export default {
  name: 'chart-component',
  props: ['date','dsid','devices'],
    data() {
      return {
          logs:this.data,
          pickrDate: this.date,
          chart: null,
          dateAxis: null,
          deviceName:'',
          selectedDevice:this.dsid,
      }

    },
  methods:{
    updateChart(){
      axios.post('/api/ds/logs/fetch',{
        date: this.pickrDate,
        dsid: this.selectedDevice,
      }).then(res => {
        console.log(res.data)
        this.logs = res.data.data;
        this.deviceName = res.data.device.full_name;
        this.processData();
        this.dateAxis.max = Vue.moment(this.pickrDate).format('X')
        this.chart.data = this.logs;
      })
    },
    processData(){
      _.forEach(this.logs, value => {
        if(value.on == 1){
          value.color = '#2dce89'
        } else {
          value.color = '#e9ecef'
        }
      });
    }
  },
  watch:{
    pickrDate(newVal,oldVal){
      this.updateChart();
    }
  },
  mounted() {
    // this.processData();

    // console.log(this.logs)
    this.updateChart();

    this.chart = am4core.create(this.$refs.chartdiv, am4charts.XYChart);
    this.chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    this.chart.paddingRight = 30;
    this.chart.dateFormatter.inputDateFormat = "yyyy-MM-dd HH:mm:ss";


    this.chart.data = this.data;

  var categoryAxis = this.chart.yAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = 'dsid';
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.inversed = true;

  this.dateAxis = this.chart.xAxes.push(new am4charts.DateAxis());
  this.dateAxis.dateFormatter.dateFormat = "yyyy-MM-dd HH:mm";
  this.dateAxis.renderer.minGridDistance = 60;
  this.dateAxis.baseInterval = { count: 1, timeUnit: "minute" };
  // dateAxis.max = new Date().getTime();
      this.dateAxis.max = new Date('2019-07-02').getTime();
  this.dateAxis.strictMinMax = false;
  this.dateAxis.renderer.tooltipLocation = 0;

  var series1 = this.chart.series.push(new am4charts.ColumnSeries());
  series1.columns.template.width = am4core.percent(80);
  series1.columns.template.tooltipText = "{name}: {openDateX} - {dateX}";

  series1.dataFields.openDateX = "start";
  series1.dataFields.dateX = "end";
  series1.dataFields.categoryY = "dsid";

  series1.columns.template.propertyFields.fill = "color"; // get color from data
  series1.columns.template.propertyFields.stroke = "color";
  series1.columns.template.strokeOpacity = 1;
  series1.columns.template.events.on('hit', ev => {
    console.log('clicked on', ev.target)
    alert('clicked on', ev.target)
  },this)

    this.chart.scrollbarX = new am4core.Scrollbar();

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
  height: 150px;
}
</style>
