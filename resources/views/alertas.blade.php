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
		Generar Alertas
	</div>
	<div class="col-md-12 col-offset-2" style="margin-top: 40px;">
		<div class="row">

				<div class="col-md-4">
					<div class="col-md-3" style="padding: 0px;" >
						<label style="font-size: 18px;"> Producto </label>
					</div>
					<form>	
					<div class="col-md-6" id="radioButton">
						<input type="radio" name="producto" value="SOAT ">SOAT <br>	
						<input type="radio" name="producto" value="TecnicoMecanica ">TecnicoMecanica <br>	
						<input type="radio" name="producto" value="Licencia ">Licencia <br>	
					</div>
					</form>
				</div>
				<div class="col-md-4">
					<div class="col-md-10">
						<label>Fecha Compra:</label>
					<div class='input-group date' data-provide="datepicker" id='datepicker'>
                    	<input type='text' class="form-control" />
                    	<span class="input-group-addon">
                        	<span class="glyphicon glyphicon-calendar"></span>
                    	</span>
                	</div>
                	</div>
                	<br>
                	<br>
                	<div class="col-md-10">
						<label>Fecha Vencimiento:</label>				
					<div class='input-group date' data-provide="datepicker" id='datepicker'>
                    	<input type='text' class="form-control" />
                    	<span class="input-group-addon">
                        	<span class="glyphicon glyphicon-calendar"></span>
                    	</span>
                	</div>
                	</div>
				</div>
		</div>
		<br>
		<br>

		<div class="row" >
			<label style="font-size: 18px;">Cliente</label>
			<div class="form-group" style="margin-left: 20px" style="border: 2px solid black; border-radius: 10px;">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-xm-8">
						<div class="input-group">
							<label class="input-group-addon" for="namecli">Nombres:</label>
							<input type="text" class="form-control" aria-describedby="basic-addon1" id="namecli">
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-8 col-md-8 col-xm-8">
						<div class="input-group">
							<label class="input-group-addon" for="number">Numero Celular:</label>
							<input type="text" class="form-control" aria-describedby="basic-addon1" id="number">
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-8 col-md-8 col-xm-8">
						<div class="input-group">
							<label class="input-group-addon" for="email">Email:</label>
							<input type="text" class="form-control" aria-describedby="basic-addon1" id="email">
						</div>
					</div>
				</div>
			</div>
		</div>

		<button class="btn btn-secondary" onclick="sendSms($('#number').val(), $('#namecli').val());" >Enviar SMS</button>
		<button class="btn btn-primary" onclick="inhabilitado();" >Guardar</button>
		<button class="btn btn-danger" onclick="inhabilitado();" >Salir</button>
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

		$('.datepicker').datepicker({
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