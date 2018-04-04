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
	<div class="col-md-12 col-offset-2" style="margin-top: 20px;" id="list">
		<div>
			<div class="col-lg-3 col-md-6" style="float:right;">
                    <!--<div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-commenting fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div>SMS Fallidos</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div> -->
                    <!--<div>
                    	<button></button>
                    </div>-->
            </div>
			<!--<div>
				<label>Enviados</label>
				<em class="fa fa-commenting" style="color:blue;"></em>
			</div>
			<div>
				<label>Error Sms</label>
				<em class="fa fa-commenting" style="color:red; font-size: 150%;"></em>
			</div>-->
		</div>
		<div>
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
			methods:{
				sendsms: function(e){
					$id = e;
					axios.post('/alert/only', {
						id : $id
					})
					.then(
						response => {
							alert(response.data['success']);
					})
				}
			},
		})
	</script>
@endsection