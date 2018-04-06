
@extends('layouts.app')

@section('sectionstyle')
	
	<style type="text/css">
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

@section('titlecontent')

	Nueva Venta

@endsection

@section('content')

<!-- modal add cliente -->
<!--button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaladd">Large modal</button-->
<div id="app">
<div class="modal fade bs-example-modal-lg" tabindex="0" role="dialog" aria-labelledby="myLargeModalLabel" id="modaladd">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
       <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Nuevo Cliente </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <!--form class="form-group" action="/client/create" method="post" id="formclientadd"-->
        <form class="form-group" @submit.prevent="createClient"  id="formclientadd">
        	{{ csrf_field() }}
        	<div class="input-group inputgro">
		        <label class="formclie">Numero Identificación </label>
				<input type="text" name="numidenti" class="form-control col-md-4" v-model="numidenti">
			</div>

        	<div class="input-group inputgro">
		        <label class="formclie">Nombres</label>
				<input type="text" name="nombrecliemodal" class="form-control col-md-8" v-model="nomclie">
				
				@if ($errors->has('nombrecliemodal'))
					@foreach ($errors->get('nombrecliemodal') as $error)
						<div class="form-control-feeback"> {{ $error }}</div>
					@endforeach
				@endif
			</div>

			<div class='input-group inputgro col-md-6 paddFlo'>
				<label class="formclie">Direccion</label>
	        	<input type='text' name="address" class="form-control" v-model="dirclie"/>
	        	@if ($errors->has('address'))
					@foreach ($errors->get('address') as $error)
						<div class="form-control-feeback"> {{ $error }}</div>
					@endforeach
				@endif
	        </div>
	        <div class="input-group inputgro col-md-4 ">
				<label class="formclie">Celular 1</label>
				<input type="input" name="phone1" class="form-control" v-model="tel1clie">
				@if ($errors->has('phone1'))
					@foreach ($errors->get('phone1') as $error)
						<div class="form-control-feeback"> {{ $error }}</div>
					@endforeach
				@endif
			</div>
			<div class="input-group inputgro col-md-4 paddFlo">
				<label class="formclie">Celular 2</label>
				<input type="text" name="phone2" class="form-control" v-model="tel2clie">
			</div>
			<div class="input-group inputgro col-md-6">
				<label class="formclie">Email</label>
				<input type="email" name="email" class="form-control" placeholder="Ingrese El Email" v-model="emailclie">
				@if ($errors->has('email'))
					@foreach ($errors->get('email') as $error)
						<div class="form-control-feeback"> {{ $error }}</div>
					@endforeach
				@endif
			</div>

			@if ( $user->negocio->ifMuestraSexo )
				<div class="input-group inputgro col-md-4 paddFlo">
					<label class="formclie">Sexo</label>
					<div>
						<input type="radio" value="2" name="" v-model="pickedsex"> Feminino
						<br>
						<input type="radio" value="1" name="" v-model="pickedsex"> Masculino
					</div>
					<!--select name="sex" class="form-control" v-model="sexocli">
						<option value="1"> Masculino </option>
						<option value="2"> Femenino </option>
					</select-->
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
			<div class="modal-footer" >
	        	<button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelar">Cancelar</button>
		        <button type="submit" class="btn btn-primary">Crear</button>
	      	</div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="0" role="dialog" aria-labelledby="myModalLabel" id="modalsearchclien">
	<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
       <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Buscar Cliente </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <!--form class="form-group" action="/client/create" method="post" id="formclientadd"-->
        <div id="successClient" hidden="true">

        </div>
        <div id="errorClient" hidden="true">
        	
        </div>
      </div>
      
    </div>
  </div>
</div>
<!-- /modal add cliente -->

<form hidden="" style="" role="alert" id='form-errors'>	
</form>

<form hidden="" style="" role="alert" id='form-success'>	
</form>

<!--form action="/ventas/create"  method="post" id="app"-->
<form  @submit.prevent="createvent" method="post">
	<div class="form-group @if ($errors->has('cliente')) has-danger @endif">
		{{ csrf_field() }}
		
		<label class="col-md-2 col-sm-2 dispinlineBlock-leftFloat">Tipo de Producto</label>
		<select class="col-md-7 form-control inputgro" style="margin-left: 10px; " @change="chanceprod" name="tipoproduc" v-model="tipoproduc">
			<option value="0">Seleccione...</option>
			@foreach ( $tipoproductos as $tipoproducto)
				<option value="{{ $tipoproducto->id }}"> {{ $tipoproducto->nombreTipoProductos }} </option>
			@endforeach
		</select>
		
		@if ($errors->has('tipoproduc'))
			@foreach ($errors->get('tipoproduc') as $error)
				<div class="form-control-feeback"> {{ $error }}</div>
			@endforeach
		@endif
		
		<label class="col-md-2 col-sm-2 dispinlineBlock-leftFloat">Cliente</label>
		<div class="col-md-7 input-group noPad-noMarg inputgro">
			<!-- -->
			<input type="text" name="identif" id="identif" @keyup="validClient" class="form-control identif col-md-4" placeholder="Numero de Identificacion" v-model="identif">
			<input type="button" data-toggle="modal" @click="identcli" data-target="#modaladd" name="more" class="btn btn-success" style="margin-left: 5px;" value="+">
			<button name="more" @click="searchclie" data-toggle="modal" data-target="#modalsearchclien" class="btn btn-success" style="margin-left: 5px;" ><em class="fa fa-search"></em></button>
			<input type="text" name="nombreclie" placeholder="Nombre Cliente" disabled="true" style="margin-left: 10px;" class="form-control nombreclie" v-model="nombrecliente" :id=" id">
		</div>
		
		
		<label class="col-md-2 col-sm-2 dispinlineBlock-leftFloat"> Fecha Venta</label>
		<div class='input-group date col-md-2 noPad-noMarg inputgro' style="display:inline-flex; float:left; margin-left:0;" data-provide="datepicker" >
        	<input type='text' class="datepicker form-control"  value="" id='datepickerventa' v-model="fechVent"/>
        	<span class="input-group-addon">
            	<span class="fa fa-calendar"></span>
        	</span>
        </div>
        
        
		<label class="col-md-2 col-sm-2 offset-md-1 dispinlineBlock-leftFloat"> Fecha Vencimiento</label>
		<div class='input-group date col-md-2 noPad-noMarg inputgro' data-provide="datepicker">
        	<input type='text' class="form-control datepicker"  value="" id='datepickervenci' v-model="fechVenc"/>
        	<span class="input-group-addon">
            	<span class="fa fa-calendar"></span>
        	</span>
        </div>
        
		<br>
		<label class="col-md-2 col-sm-2 dispinlineBlock-leftFloat ">Referencia</label>
		<input type="text" name="docrefer" class="col-md-7 form-control inputgro" style="margin-left: 10px;" v-model="docrefer">

		<br>
		<label class="col-md-3 col-sm-2" style="display: block"><input type="checkbox" name="recosms" value="Sms" v-model="recosms"> Recordatorio SMS</label>

		<label class="col-md-3 col-sm-2"><input type="checkbox" name="recoemail"  value="Correo" v-model="recoemail" > Recordatorio Email</label>

		<br>
		<br>

		<input class="btn btn-danger" type="button"  v-on:click="cancelar" name="" value="Cancelar">

		<input class="btn btn-primary" type="submit" name="" value="Crear">

	</div>
</form>
</div>


@endsection

@section('scripts')  

	<script>
		//**** Validation input Identificacion  number ****//

		var $d = new Date();
		var $currDate = $d.getDate();
		var $currMonth = $d.getMonth() +1;
		var $currYear = $d.getFullYear();
		var $dateStr = $currYear + "/" + $currMonth +  "/" + $currDate;
		$.fn.datepicker.defaults.autoclose = true;
		$.fn.datepicker.defaults.format = 'yyyy/mm/dd';
		new Vue({
	   	    el: '#app',
	   	    delimiters: ['[[', ']]'],
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


			    	nombrecliente : '',
			    	identif : '',
			    	tipoproduc : '0',
					docrefer : '',
					recosms : 'true',
					recoemail : 'true',
					fechVenc : '',
					id : '',
					fechVent : $dateStr,


					snomclie : '',
					sdirclie : '',
					stel1clie : '',
					stel2clie : '',
					semailclie : '',
					ssexocli : ''

			},

		    methods: {
		        createvent: function() {
		        	event.preventDefault(); 
		            // make ajax request and pass the data. I'm not certain how to do it with axios but something along the lines of this
					$('#form-errors').attr('hidden', true);
					$('#form-success').attr('hidden', true);

		            var $sms = 0;
		            var $email = 0;
		    		var $fechvent = $('#datepickerventa').val();
		    		var $idclie = $('[name="nombreclie"]').attr('id');
		    		var $fechvenci = $('#datepickervenci').val();
		    		if ($('[name="recosms"]').prop('checked')) {
		    			$sms = 1;
		    		}
		    		if ($('[name="recoemail"]').prop('checked')) {
		    			$email = 1;
		    		}
		    		if(this.tipoproduc == 0){
		    			this.tipoproduc = '';
		    		}

		    		if($)

		            axios.post('/ventas/create', {
		            	tipoproduct : this.tipoproduc,
		            	idclient : $idclie,
		            	fechVenta : $fechvent,
		            	fechVenc : $fechvenci,
		            	DocuReferencia : this.docrefer,
		            	recosms : $sms,
		            	recoemail : $email
		            })
		         	.then( 
		        		response => {
							successHtml = '<div class="alert alert-success" style="color:#155724;">Hecho!<ul>';
							successHtml += '<li>' +  response.data['success'] + '</li>'; //showing only the first error.
							successHtml += '</ul></div>';

							$( '#form-success' ).html( successHtml ); 
							$('#form-success').prop('hidden', false);

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

							event.target.reset();

		        			return response.json();
		        	})


		        	.catch(function (error) {
    					if (error.response) {
		         			console.log(error.response.data);

		         			var errors = error.response.data['errors_form']
							console.log(errors)
							errorsHtml = '<div class="alert alert-danger" style="color:#721c24;">Errores <ul>';

							$.each( errors , function( index, value ) {
								console.log(index + value);
								errorsHtml += '<li>' +  value[0] + '</li>'; //showing only the first error.
							});
							errorsHtml += '</ul></div>';
							$( '#form-errors' ).html( errorsHtml ); 
							$('#form-errors').prop('hidden', false);

						}
					});
				},

				chanceprod: function(){

					$('#form-success').prop('hidden', true);
					$('#form-errors').prop('hidden', true);
		    		if(this.tipoproduc == 0){
		    			alert('Escoja un tipo de producto Valido');
		    		}else{
		    			axios.post('/ventas/obtfechVenc',{
		    			tipoproduct : this.tipoproduc
		    			
		    			})
		    			.then( 
			        		response => {
								$feVenci = response.data['feVenci'];

								
								$f = $("#datepickerventa").val();
								$fecha = moment($f).format('YYYY/MM/DD');

								$fecha = moment($fecha).add($feVenci, 'days');
								$fecha = $fecha.format("YYYY/MM/DD");

								this.fechVenc = $fecha;
		        		});
		        	}
		    	},

		    	identcli: function(){
		    		this.numidenti = this.identif;
		    	},

		    	selectClient: function(e){
					//console.log(e.parentNode.id);
					this.nombrecliente = e.name;
					this.id = e.id;
					this.identif = e.parentNode.id
				},

		    	searchclie:function(){
		    		event.preventDefault();
		    		successHtml= '';
		    		if(this.identif == ''){
		    			successHtml += '<div style="color:black;" class="col-md-8 offset-md-2 alert alert-warning" role="alert">Por favor Digite la Identificacion';
		        		$('#errorClient').html( successHtml ); 
						$('#successClient').prop('hidden', true);
						$('#errorClient').prop('hidden', false);
					}else{
			    		axios.post('client/searchList',{
			    			numident : this.identif
			    		}).then(
			    			response => {
			    				/*selectClient = function(e){
			    					console.log(this.nombrecliente);
			    					return (e.name);
									/*this.nombrecliente = e.name;
									this.id = e.id;
								},*/

			    				$("#successClient").on("click", "tr", (event) => {
									//console.log(nombrecliente);
									this.selectClient(event.target);
								});
			    				successHtml += '<table class="table table-hover"> <thead><tr> <th scope="col">Identificacion</th> <th></th><th scope="col" style="width: 50%;">Nombre</th><th scope="col">Telefono</th><th scope="col">Escoger</th></tr></thead><tbody>';
			    				$.each(response.data, function( index, value ) {
			    					
			    					successHtml +='<tr> <th scope="row">'+ response.data[index]["numIdentificacion"] +'</th> <td>' + response.data[index]["id"] + '</td> <td>' + response.data[index]["nombresClientes"] + '</td> <td> ' + response.data[index]["celular1"] + '</td><td id="'+ response.data[index]["numIdentificacion"] +'"><input type="button" name="' + response.data[index]["nombresClientes"] + '" class="btn btn-primary" data-dismiss="modal" id="' + response.data[index]["id"] + '" value="Escoger"> </td> </tr>';
			    					/*console.log(response.data[index]['id'])*/
								});
								$( '#successClient' ).html( successHtml ); 
								$('#successClient').prop('hidden', false);
								$('#errorClient').prop('hidden', true);
			    			}
			    		)
			    		.catch(
				        	errors => {
				        		successHtml += '<div style="color:black;" class="col-md-8 offset-md-2 alert alert-warning" role="alert"> No se encontraron clientes';
				        		$('#errorClient').html( successHtml ); 
								$('#successClient').prop('hidden', true);
								$('#errorClient').prop('hidden', false);
						});
		    		}
		    	},

		    	
		    	validClient: function(e){
						
						var val = this.identif;
						this.identif = val.replace(/\D|\-/,'');
		    			if(isNaN(val)){
		    				console.log('text');
		    				this.nombrecliente = '';
			        		this.id = '';
		    			};

						axios.post('/client/search',{
							numident : this.identif
						}).then(
				        	response => {
				        		if(val == ''){
									this.nombrecliente = '';
					        		this.id = '';
								}else{
					        		this.nombrecliente = response.data['nombre'];
					        		this.id = response.data['id'];

				        		}
			        	})
			        	.catch(
			        		errors => {
			        			this.nombrecliente = 'NO EXISTE';
			        			this.id = '';
						});
		    	},

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
			        		this.nombrecliente = response.data['nombre'];
			        		this.id = response.data['id'];
			        		this.identif = response.data['numIdentificacion'];

		        	});
		        	/*.catch(
		        		errors => {
		        			console.log(error)
					});*/

		        	event.target.reset();
		        	$('#modaladd').modal('toggle');
		    	},

				mounted: function () {

						this.fechVent = $dateStr;
						$.fn.datepicker.noConflict

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
				}
		    }, 
		})


    </script>
@endsection