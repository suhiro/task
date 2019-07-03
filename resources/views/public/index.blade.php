@extends('layouts.app')
@section('content')


<div class="row">
	<div class="col-3">
		
		<flat-pickr v-model="pickrDate" @on-change="updateDate" class="form-control" placeholder="Select date"></flat-pickr>
		
	</div>
</div>

<chart-component :data="deviceData"></chart-component>

<div>
	@{{ deviceData }}
</div>

@endsection

@section('initScript')
<script>
	console.log('this is from initScript')

	window.vueMixin = {
		data(){
			return {
				pickrDate:'2019-07-04',
				deviceData:@json($data),
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
			console.log('moutned')
		}
	}
</script>
@endsection






