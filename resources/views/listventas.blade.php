@extends('layouts.app')

@section('title')
@endsection

@section('titlecontent')
	Ventas
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
	<div class="col-md-12 col-offset-2" style="margin-top:0px;" id="list">
		<!---div  style="">
			<div class="col-md-2 col-sm-4" style="float:right; display: inline-flex;">
				<div style="background-color: rgba(255,236,51,0.7); border-radius: 10px; padding-right: 20px; padding-top: 10px; padding-left: 10px; margin-bottom: 20px">
					<div class="row" style="display:inline-flex;">
                        <div class="col-xs-2">
                            <i class="fa fa-commenting fa-2x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <div class="">[[ countError ]]</div>
                            <div>SMS Fallidos</div>
                        </div>
                    </div>
				</div>
			</div>
			<div class="col-md-2 col-sm-4" style="float:right; display: inline-flex;">
				<div style="background-color: rgba(115,118,223,0.6); border-radius: 10px; padding-right: 20px; padding-top: 10px; padding-left: 10px; margin-bottom: 20px">
					<div class="row" style="display:inline-flex;">
                        <div class="col-xs-2">
                            <i class="fa fa-commenting fa-2x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <div class="">[[ countSucc ]]</div>
                            <div>SMS Enviados</div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<div-->
			<table class="table table-hover">
			  <thead>
			    <tr>
			      <!--th scope="col"></th-->
			      <th scope="col">Fecha de Ventas</th>
			      <th scope="col">Producto</th>
			      <th scope="col">Nombre Cliente</th>
			      <th scope="col">Documento de Referencia</th>
			      <th scope="col"></th>
			      
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach ( $ventas as $venta)
			  		<tr>
				      <!--th scope="row"><input type="checkbox" name="{{ $venta->id }}"></th-->
				      <td>{{ $venta->fechaVentas }}</td>
				      <td> {{ $venta->tipoproducto->nombreTipoProductos }}</td>
				      <td>{{ $venta->cliente->nombresClientes }}</td>
				      <td>{{ $venta->docuReferencia }}</td>
				      <td><input type="button" @click="sendsms( {{ $venta->id }} )" value="Enviar Mensaje" class="btn btn-primary"> </td>
				    </tr>
			  	@endforeach
			  </tbody>
			</table>
		</div>
	</div>




@endsection

@section('scripts')
	<script type="text/javascript">
		new Vue({
			el:'#list',
			delimiters: ['[[', ']]'],
			data:{
				countError : '',
				countSucc : ''
			},
			methods:{
				sendsms: function(e){
					$id = e;
					axios.post('/alert/only', {
						id : $id
					})
					.then(
						response => {
							this.countError = response.data['countError'];
							this.countSucc = response.data['countSucc'];
							alert(response.data['success']);

					})
				}
			}
		})
	</script>
@endsection