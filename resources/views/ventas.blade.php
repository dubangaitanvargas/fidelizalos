
@extends('layouts.app')

@section('content')

<form action="/ventas/create" method="post" id="app">
	<div class="form-group @if ($errors->has('cliente')) has-danger @endif">
		{{ csrf_field() }}

		<label>Tipo de Producto</label>
		<select class="form-control" name="tipoproduc">
			@foreach ( $tipoProductos as $tipoProducto)
				<option> {{ $tipoProducto->NombreTipoProducto }} </option>
			@endforeach
		</select>

		@if ($errors->has('tipoproduc'))
			@foreach ($errors->get('tipoproduc') as $error)
				<div class="form-control-feeback"> {{ $error }}</div>
			@endforeach
		@endif

		<label>Cliente</label>
		<input type="text" name="nombreclie" class="form-control">
		@if ($errors->has('nombreclie'))
			@foreach ($errors->get('nombreclie') as $error)
				<div class="form-control-feeback"> {{ $error }}</div>
			@endforeach
		@endif

		<label> Fecha Venta</label>
		<div class='input-group date' data-provide="datepicker">
        	<input type='text' class="form-control"  value="" id='datepicker'/>
        	<span class="input-group-addon">
            	<span class="glyphicon glyphicon-calendar"></span>
        	</span>
        </div>
		<label> Fecha Vencimiento</label>
		<input type="input" name="fechVenc" class="form-control">
		@if ($errors->has('fechVenc'))
			@foreach ($errors->get('fechVenc') as $error)
				<div class="form-control-feeback"> {{ $error }}</div>
			@endforeach
		@endif
		<label>Documento de referencia</label>
		<input type="text" name="docrefe" class="form-control">
		@if ($errors->has('docrefe'))
			@foreach ($errors->get('docrefe') as $error)
				<div class="form-control-feeback"> {{ $error }}</div>
			@endforeach
		@endif

		<label>	<input type="checkbox" name="recosms" value="Sms"> Recordatorio SMS</label>
		<br>
		<label>	<input type="checkbox" name="recoemail" value="Correo" >Recordatorio Email</label>

		<br>

		<input class="btn btn-success" type="submit" name="" value="Aceptar">

		<input class="btn btn-danger" type="button" name="" value="Cancelar">


	</div>
</form>

@foreach ( $clientes as $cliente)
	<div> {{ $cliente->idClientes }}</div>
	<div> {{ $cliente->NombresClientes }}</div>
	<div> {{ $cliente->Celular1 }}</div>

@endforeach

@endsection

@section('scripts')  
	
	<script type="text/javascript">
		new Vue({
			el: '#app',
		  	data: {
		  		date: ''
	  		},
	  		mounted: function() {
			    var args = {
			        format: 'DD/MM/YYYY'
		    	};
		        this.$nextTick(function() {
		            $('#datepicker').datetimepicker(args)
		        });

		       	this.$nextTick(function() {
		        	$('.time-picker').datetimepicker({
		            format: 'LT'
		          	})
		       	});
		    }
		}


    </script>
@endsection