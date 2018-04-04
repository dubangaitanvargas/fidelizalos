@extends('layouts.app')

@section('title')
@endsection

@section('titlecontent')
    Alertas.
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
		        LISTA DE CLIENTES
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
		<label><input type="checkbox" name="allselect"> Seleccionar todos </label>
	</div>
	<div class="col-md-12 col-offset-2" style="margin-top: 40px;">
		<div>
			<table class="table table-hover">
			  <thead>
			    <tr>
			      <th scope="col"></th>
			      <th scope="col" style="width: 50%;">Nombre</th>
			      <th scope="col">Telefono</th>
			      <th scope="col">Fecha</th>
			      <th scope="col">TipoProducto</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach ( $clientes as $cliente)
			  		<tr>
				      <th scope="row"><input type="checkbox" name="{{ $cliente->id }}"></th>
				      <td> {{ $cliente->nombresClientes }}</td>
				      <td>{{ $cliente->celular1 }}</td>
				      <td>
				      	<input type="button" name="" class="btn btn-primary" value="Enviar">
				      	<input type="button" name="" class="btn btn-secondary" value="Editar">
				      </td>
				    </tr>
			  	@endforeach
			  </tbody>
			</table>
		</div>




@endsection

@section('scripts')
	<script type="text/javascript">
		$('#myModal').on('shown.bs.modal', function () {
  			$('#myInput').focus()
		})

		$.ajaxSetup({
        	headers: {
	 	       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $('#datepicker').val('<?php echo date("m/d/Y"); ?>');
	    /*function datapickerToday(){
	    };*/

	    $('#datepicker2').val('<?php echo date("m/d/Y", strtotime("+1 year")); ?>');
			
		/*function dateinputVenci(){
			//date = <?php $date = mktime(0,0,0, date("m"),   date("d"),   date("Y")+1); ?>
		}*/

		/*$.datepicker.setDefaults($.datepicker.regional["es"]);*/
		/*$( "#datepicker" ).datepicker({ defaultDate: new Date() });*/
    	/*$("#datepicker").datepicker({	}).datepicker("setDate", new Date());*/
		$('.datepicker').datepicker({
			"setDate": new Date(),
        	"autoclose": true
		});

		function inhabilitado(){
			 alert('Esta es una version de prueba, por el momento esta funcion esta inhabilitada');
		}



		function sendSms(phone, namecli){
			
			var prod = $('input:radio[name=producto]:checked').val();
			var parameters = {
				'phone'	: phone,
				'namecli' : namecli,
				'product' : prod
			};

		    $.ajax({
			    // aqui va la ubicación de la página PHP
		      	type: 'POST',
		    	url: '/alertas',
		    	data: parameters,


		    	//data: { condicion: "ejecutarFuncion"},
		    	success:function(resultado){
		       // imprime "resultado Funcion"
		    		alert(resultado);
		    	}
			});
		  console.log('logrado');
		}
	</script>
@endsection