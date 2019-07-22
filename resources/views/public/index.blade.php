@extends('layouts.app')
@section('content')


<chart-component :date="pickrDate" :dsid="12522" :devices='@json($devices)'></chart-component>


<div>

</div>

@endsection

@section('initScript')
<script>


	window.vueMixin = {
		data(){
			return {
				pickrDate: Vue.moment().format('YYYY-MM-DD'),
				{{--log_data:@json($data),--}}
			}
		},
		methods:{
		},
		watch:{
			pickrDate(newVal, oldVal){
				console.log(this.pickrDate);
			}
		},
		mounted(){
            console.log('this is from initScript')
		}
	}
</script>
@endsection






