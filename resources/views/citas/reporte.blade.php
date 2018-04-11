@extends('welcome')
@section('contenido')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row ">
	<div class="col-sm-3" style="float: right;">
		<label for="">Mes</label>
		<select name="" id="mes" class="form-control">
			<option value="" disabled selected>Selecciona un mes</option>
			<option value="1">Enero</option>
			<option value="2">Febrero</option>
			<option value="3">Marzo</option>
			<option value="4">Abril</option>
			<option value="5">Mayo</option>
			<option value="6">Junio</option>
			<option value="7">Julio</option>
			<option value="8">Agosto</option>
			<option value="9">Septiembre</option>
			<option value="10">Octubre</option>
			<option value="11">Noviembre</option>
			<option value="12">Diciembre</option>
		</select>
	</div>

</div>
<br>
<div class="panel panel-default">
  <div class="panel-heading">
  	<h3>Reporte de Citas</h3>
  </div>
  <div class="panel-body">
  	<div class="row">
  		<div class="col-sm-6 text-center">
  			<h4>Total de citas en el mes: <span id="total" style="font-weight:bold">{{$citasTotales}}</span></h4>
  		</div>
  		<div class="col-sm-6 text-center">
  			<h4>Total de citas canceladas en el mes: <span id="canceladas" style="font-weight:bold">{{$canceladas}}</span></h4>
  		</div>
  		<br><br>
  		<div class="col-sm-12" style="margin-top:5%;">
  			<table class="table table-bordered">
  				<thead>
  					<tr>
  						<th class="text-center">Fecha</th>
  						<th class="text-center">Hora</th>
  						<th class="text-center">Nombre</th>
  						<th class="text-center">Telefono</th>
  						<th class="text-center">Direccion</th>
  					</tr>
  				</thead>
  				<tbody id="tableBody">
  					@foreach($citas as $cita)
  						<tr>
  							<td>{{$cita->fecha}}</td>
  							<td>{{$cita->hora}}</td>
  							<td>{{$cita->nombre}}</td>
  							<td>{{$cita->telefono}}</td>
  							<td>{{$cita->direccion}}</td>
  						</tr>
  					@endforeach
  				</tbody>
  			</table>
  		</div>
  	</div>
  </div>
</div>
<script>
	$('#mes').on('change', function(){
		$.ajaxSetup({
   		 headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   		 }
    	});
    	$.ajax({
    		type: 'GET',
    		url: "{{url('/getCitasMes')}}",
    		data: {
    			'mes': $('#mes :selected').val()
    		},
    		success: function(data){
    			 $('#tableBody').empty();
    		   $('#total').text(data.citasTotales);
           $('#canceladas').text(data.canceladas);
    			data.citas.forEach(function(cita){
    			 $('#tableBody').append(
            '<tr>' +
            '<td>'+cita.fecha+'</td>'+
            '<td>'+cita.hora+'</td>'+
            '<td>'+cita.nombre+'</td>'+
            '<td>'+cita.telefono+'</td>'+
            '<td>'+cita.direccion+'</td>'+
            '</tr>'
            );
    			})    		
    		}
    	})
	})
</script>
@stop