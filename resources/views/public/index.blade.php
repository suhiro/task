@extends('layouts.app')
@section('content')


<div class="row">
	<div class="col-3">
		
		<flat-pickr v-model="pickrDate" @on-change="updateDate" class="form-control" placeholder="Select date"></flat-pickr>
		
	</div>
</div>

<chart-component :data="log_data"></chart-component>


<div>

</div>

@endsection

@section('initScript')
<script>


	window.vueMixin = {
		data(){
			return {
				pickrDate:'{{now()->toDateString()}}',
				log_data:@json($data),
			}
		},
		methods:{
			updateDate(selectedDates,dateStr,instance){
				axios.post('/api/ds/logs/fetch',{
					date: dateStr
				}).then(res => {
					console.log(res.data)
					this.deviceData = res.data;
				})
			}
		},
		mounted(){
            console.log('this is from initScript')
		}
	}
</script>
@endsection






