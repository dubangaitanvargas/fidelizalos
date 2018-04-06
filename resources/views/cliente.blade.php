@extends('layouts.app')

@section('title')
	Nuevo-Cliente
@endsection

@section('titlecontent')
	Nuevo Cliente
@endsection

@section('sectionstyle')
<style>
	.formclie{
		margin-right: 15px;
	}
	.paddFlo {
		padding: 0px;
		float: left;
	}
	.noPad-noMarg {
		padding: 0px;
		margin: 0px;
	}
	div .input-group {
		margin-left: 10px;
	}

	.dispinlineBlock-leftFloat{
		display: inline-block;
		float:left;
	}
	.inputgro {
		margin-bottom: 20px;
	}
	.margin-bottom-15{

	}
</style>
@endsection

@section('content')

<form hidden="" style="" role="alert" id='form-errors'>	
</form>

<form hidden="" style="" role="alert" id='form-success'>	
</form>

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
            </div>
		</div>
		<div>

	      <div class="modal-body">
	        <form class="form-group" @submit.prevent="createClient"  id="formclientadd">
	        	{{ csrf_field() }}
	        	<div class="input-group inputgro">
			        <label class="formclie">Numero Identificación </label>
					<input type="text" name="numidenti" class="form-control col-md-4" v-model="numidenti">
				</div>

	        	<div class="input-group inputgro">
			        <label class="formclie">Nombres</label>
					<input type="text" name="nombrecliemodal" class="form-control col-md-8" v-model="nomclie">
				</div>

				<div class='input-group inputgro col-md-6 paddFlo'>
					<label class="formclie">Direccion</label>
		        	<input type='text' name="address" class="form-control" v-model="dirclie"/>
		        </div>
		        <div class="input-group inputgro col-md-4 ">
					<label class="formclie">Celular 1</label>
					<input type="input" name="phone1" class="form-control" v-model="tel1clie">
				</div>
				<div class="input-group inputgro col-md-4 paddFlo">
					<label class="formclie">Celular 2</label>
					<input type="text" name="phone2" class="form-control" v-model="tel2clie">
				</div>
				<div class="input-group inputgro col-md-6">
					<label class="formclie">Email</label>
					<input type="email" name="email" class="form-control" placeholder="Ingrese El Email" v-model="emailclie">
				</div>

				@if ( $user->negocio->ifMuestraSexo )
					<div class="input-group inputgro col-md-4 paddFlo">
						<label class="formclie">Sexo</label>
						<div>
							<input type="radio" value="2" name="" v-model="pickedsex"> Feminino
							<br>
							<input type="radio" value="1" name="" v-model="pickedsex"> Masculino
						</div>
					</div>
				@endif 

				@if ( $user->negocio->ifMuestraFechaNacimiento )
					<div class="col-md-6" style="display: inline-block;" >
						<label class="formclie">Fecha Nacimiento</label>
			        	<div class='input-group date col-md-6 inputgro' style="display: inline-flex; margin:0px; padding: 0px;" data-provide="datepicker" id="datepicker1">
				        	<input type='text' class="datepicker form-control "  value="" id='datepickercli' name="inputf"/>
				        	<span class="input-group-addon">
				            	<span class="fa fa-calendar"></span>
				        	</span>
				        </div>
		        	</div>
				@endif 
				<br>
				<br>
				<br>
				<div >
		        	<button type="button" class="btn btn-danger">Cancelar</button>
			        <button type="submit" class="btn btn-primary">Crear</button>
		      	</div>
	        </form>
	      </div>
		</div>
	</div>




@endsection

@section('scripts')
	<script type="text/javascript">
		new Vue({
			el:'#list',
			data: {
				nomclie : '',
				numidenti : '',
				dirclie : '',
				tel1clie : '',
				tel2clie : '',
				emailclie : '',
				//sexocli : '',
				pickedsex: '',
				fecclie : '',
			},
			methods:{
				createClient: function() {
		        	event.preventDefault(); 
		            // make ajax request and pass the data. I'm not certain how to do it with axios but something along the lines of this
		    		var $fech = $('#datepickercli').val();
		            axios.post('/client/create', {
		            	numIdentificacion : this.numidenti,
		            	nombrecliemodal : this.nomclie,
		            	direccion : this.dirclie,
		            	phone1 : this.tel1clie,
		            	phone2 : this.tel2clie,
		            	email : this.emailclie,
		            	//sex : this.sexocli,
		            	sex : this.pickedsex,
		            	fechNacim : $fech
		            })
		        	.then(
			        	response => {
			        		successHtml = '<div class="alert alert-success" style="color:#155724;">Hecho!<ul>';
							successHtml += '<li>' +  response.data['success'] + '</li>'; //showing only the first error.
							successHtml += '</ul></div>';

							$( '#form-success' ).html( successHtml ); 
							$('#form-success').prop('hidden', false);

							this.numidenti = '',
							this.nomclie = '',
							this.dirclie = '',
							this.tel1clie = '',
							this.tel2clie = '',
							this.emailclie = '',
							//this.sexocli = '',
							this.pickedsex = '',
							this.fecclie = '',

							event.target.reset();
		        			return response.json();
		        	})
		        	.catch(function (error) {
		        		if (error.response) {
		         			console.log(error.response.data['errors_form']);
		         			var errors = error.response.data['errors_form'];
							console.log(errors);
							errorsHtml = '<div class="alert alert-danger" style="color:#721c24;">Error<ul>';

							$.each( errors , function( index, value ) {
								console.log(value);
								errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
							});
							errorsHtml += '</ul></div>';
							$( '#form-errors' ).html( errorsHtml ); 
							$('#form-errors').prop('hidden', false);

						}
					});
		    	},
				cancelar: function() {
						this.nomclie = '',
						this.dirclie = '',
						this.tel1clie = '',
						this.tel2clie = '',
						this.emailclie = '',
						//this.sexocli = '',
						this.pickedsex = '',
						this.fecclie = '',
						this.nombrecliente = '',
				    	this.tipoproduc = '0',
						this.docrefer = '',
						this.recosms = '',
						this.recoemail = '',
						this.fechVenc = '',
						this.id = '',
						this.fechVent = $dateStr

						$('#form-success').prop('hidden', true);
						$('#form-errors').prop('hidden', true);
				},
			},
		})
	</script>
@endsection