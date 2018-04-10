@extends('layouts.app')

@section('title')
	Parametros|SMS
@endsection

@section('titlecontent')
	Parametros/SMS
@endsection

@section('sectionstyle')
<style>
	.panel {
	    margin: 0 0 21px;
	}
	.panel-content {
	    background-color: #EDEFF2;
	    padding: 16px;
	}
	.panel-red {
	  border-color: #d9534f;
	}
	.panel-red > .panel-heading {
	  border-color: #d9534f;
	  color: white;
	  background-color: #d9534f;
	}
	.panel-red > a {
	  color: #d9534f;
	}
	.panel-red > a:hover {
	  color: #b52b27;
	}
</style>
@endsection

@section('content')
<div id="app">
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Buscar @yield('TitleModal') </h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        VENTAS
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <!--button type="button" class="btn btn-primary"></button-->
		      </div>
		    </div>
		  </div>
		</div>
	    <!--/modal -->

	<div>
		<!--label><input type="checkbox" name="allselect"> Seleccionar todos </label-->
	</div>
	<div class="col-md-12 col-offset-2" style="margin-top:-25px;" id="list">
			
		<div style="float: right;" class="col-md-4" >
			<div style="height: 180px; display: inline-block;">
				<label>IMPORTANTE</label>
				<p>Parara la configuracion de SMS, 
					puede escribir en el cuadro de la izquiera, si desea
					escribir parametros como nombres de cliente, producto, puede escribir las siguientes palabras claves:
				</p>
				<table class="table table-hover" style="font-size: 11px;">
				  <thead>
				    <tr>
				      <th scope="col">Palabra clave</th>
				      <th scope="col">Definicion</th>
				    </tr>
				  </thead>
				  <tbody>
				  		<tr>
					      <td>NAME_CLIEN</td>
					      <td>nombre del cliente</td>
					    </tr>
				  		<tr>
					      <td>NUM_PHONE1</td>
					      <td>Numero de celular 1 del cliente</td>
					    </tr>
				  		<tr>
					      <td>NUM_PHONE2</td>
					      <td>Numero de celular 2 del cliente</td>
					    </tr>
					    <tr>
					      <td>PRODUC_COMP</td>
					      <td>producto comprado</td>
					    </tr>
					    <tr>
					      <td>DATE_VEN</td>
					      <td>Fecha de vencimiento</td>
					    </tr>
					    <tr>
					      <td>DATE_COMP</td>
					      <td>Fecha de compra</td>
					    </tr>
					    <tr>
					      <td>NAME_NEGO</td>
					      <td>Nombre del negocio</td>
					    </tr>
				  </tbody>
				</table>
			</div>
		</div>

		<div>
			<label></label>
			<div>
				<label> Configuracion actual:</label>
				<div class="alert col-md-7" style="background-color: #d6d8d9; color:black;" >
					[[ confsms ]]
				</div>
			</div>
			<form @submit.prevent="paramSms">
				{{ csrf_field() }}
				
				<div id="" style="margin-bottom: 25px;">
					<textarea type="textarea" class="" cols="50" rows="5" v-model="txtsms"> </textarea>
				</div>

				<div >
					<input type="submit" class="btn btn-danger" name="" value="cancelar">
					<input type="submit" class="btn btn-primary" name="" value="Guardar">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('scripts')

	<script type="text/javascript">

		new Vue({
			el:'#app',
			delimiters: ['[[', ']]'],
			data:{
				countError : '',
				countSucc : '',
				txtsms : '{{ $negocios->confsms }}',
				confsms : '{{ $negocios->confsms }}' ,
			},
			methods:{
				paramSms: function(){
/*					$cel1 = 0;
					$cel2 = 0
					if ($('#cel1').prop('checked')) {
		    			$cel1 = 1;
		    		}
		    		if ($('#cel2').prop('checked')) {
		    			$cel2 = 1;
		    		}
		    		<div>
					<label>Destinos:</label>
					<div style="margin-left: 15px; margin-bottom: 20px;">
					@if($negocios->ifenvcelular1)
						<input type="checkbox" value="" checked="True" name="" id="cel1" > Celular 1
						
					@else
						<input type="checkbox" value=""  name=""  id="cel1"> Celular 1
						
					@endif
					<br>
					@if ($negocios->ifenvcelular2 )
						<input type="checkbox" value="" checked="True" id="cel2"> Celular 2
					@else
						<input type="checkbox" value="" id="cel2" > Celular 2
					@endif
					</div>
				</div>*/
					
					event.preventDefault(); 
					axios.post('/params/smssave', {
						confsms : this.txtsms,
						//cel1 : $cel1,
						//cel2 : $cel2
					})
					.then(
						response => {
							this.confsms = response.data['param'],
							this.txtsms = response.data['param']
							alert(response.data['success'])
					});
				},

			},
		})
	</script>
@endsection