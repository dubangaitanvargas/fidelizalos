
@extends('layouts.app')

@section('content')

<form action="/ventas/create" method="post">
	<div class="form-group @if ($errors->has('cliente')) has-danger @endif">
		{{ csrf_field() }}

		<label>Tipo de Producto</label>
		<select class="form-control" name="tipoproduc">
			<option>Seleccione</option>
			<option>SOAT</option>
			<option>Tecnomecanica.</option>
			<option>Licencia De Conduccion</option>
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
		<input type="date" name="fechVenta" class="form-control">
		<label> Fecha Vencimiento</label>
		<input type="date" name="fechVenc" class="form-control">
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

		<input class="btn btn-info" type="submit" name="" value="Limpiar">


	</div>
</form>

@foreach ( $clientes as $cliente)
	<div> {{ $cliente->idClientes }}</div>
	<div> {{ $cliente->NombresClientes }}</div>
	<div> {{ $cliente->Celular1 }}</div>

@endforeach

@endsection