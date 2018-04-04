@extends('layouts.app')
@section('content')
	
	<div class="col-md-8 offset-md-3" id="nego" style="margin-top: 10%">
			<div style="margin-left: 25px;">
				<label class="offset-sm-1" style="text-align: center; ">
					Seleccione Negocio
				</label>
			</div>
			<form method="post"  @submit.prevent="changeNegocio" >
				<div>
					<select v-model="negocio" name="negocio" class="col-md-6 form-control" >
						<option value="0" disabled selected value>Seleccione...</option>
						@foreach ( $negocios as $negocio)
							@if($negocio->id == 0 )
							@else
								<option value="{{ $negocio->id }}" v-model="">{{ $negocio->nombreNegocios }}</option>
							@endif
						@endforeach
					</select>
				</div>
				<br>
				@if( $negocio->id >0 )
					<input type="submit" name="" class="btn btn-primary" style=" margin-left: 10%"value="Aceptar">
					<input type="button"  href="/" name="" class="btn btn-danger " value="Cancelar">
				@else 
					<input type="submit" name="" class="btn btn-primary offset-md-2" value="Aceptar">
				@endif
			</form>
	</div>
	

@endsection

@section('scripts')
	<script>
		new Vue({
			el:'#nego',
			data:{
				negocio : '0'
			},
			methods : {
				changeNegocio : function(){
					event.preventDefault();
					axios.post('/selectNegocio',{
						Negocio : this.negocio
					})
					.then(
						response=>{
							//alert(response.data['redirect']);
							window.location = response.data['redirect'];
							//window.location = '/';
						}
					)
				}
			}

		})
	</script>
@endsection