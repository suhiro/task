@extends('layouts.app')
@section('content')




<chart-component :data="log_data"></chart-component>


<div>

</div>

@endsection

@section('initScript')
<script>


	window.vueMixin = {
		data(){
			return {

				log_data:@json($data),
			}
		},
		methods:{

		},
		mounted(){
            console.log('this is from initScript')
		}
	}
</script>
@endsection






