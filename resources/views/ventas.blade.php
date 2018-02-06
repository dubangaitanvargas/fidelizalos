
@extends('layouts.app')

@section('content')

<form action="/ventas/create" method="post">
	<div class="form-group @if ($errors->has('cliente')) has-danger @endif">
		{{ csrf_field() }}
		<label> Fecha Venta</label>
		<input type="date" name="fechaVenta" class="form-control">
		<label> Fecha Vencimiento</label>
		<input type="date" name="fechaVencimiento" class="form-control">
		<label>Documento de referencia</label>
		<input type="text" name="docrefe" class="form-control">
		@if ($errors->has('docrefe'))
			@foreach ($errors->get('docrefe') as $error)
				<div class="form-control-feeback"> {{ $error }}</div>
			@endforeach
		@endif
		<label>	<input type="checkbox" name="recosms" value="Recordatorio Sms"> Recordatorio SMS</label>
		<label>	<input type="checkbox" name="recoemail" value="Recordatorio Correo" >Recordatorio Email</label>
		<label>Tipo de Producto</label>
		<input type="text" name="tipoproduc" class="form-control">

		<input type="submit" name="">
	</div>
</form>

@foreach ( $clientes as $cliente)
	<div> {{ $cliente->idClientes }}</div>
	<div> {{ $cliente->NombresClientes }}</div>
	<div> {{ $cliente->Celular1 }}</div>

@endforeach

@endsection