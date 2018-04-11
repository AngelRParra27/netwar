@extends('welcome')
@section('contenido')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
	<div class="col-sm-6 text-center">
			<h3>Citas Agendadas</h3>
			<table class="table table-hover" >
				<thead>
					<tr>
						<th class="text-center">Nombre</th>
						<th class="text-center">Fecha</th>
						<th class="text-center">Hora</th>
					</tr>					
				</thead>
				<tbody id="citasTable">
					@foreach($citas as $cita)
						@if($cita->fecha >= date('Y-m-d'))
						<tr id="{{$cita->id}}">
							<td>{{$cita->contacto->nombre}}</td>
							<td>{{$cita->fecha}}</td>
							<td>{{$cita->hora}}</td>
						</tr>
						@endif
					@endforeach
				</tbody>
			</table>
	</div>
	<div class="col-sm-6 text-center">
		<h3>Citas para hoy</h3>
			<table class="table table-hover" >
				<thead>
					<tr>
						<th class="text-center">Nombre</th>
						<th class="text-center">Fecha</th>
						<th class="text-center">Hora</th>
					</tr>					
				</thead>
				<tbody>
					@foreach($hoy_citas as $hoy_cita)
						<tr>
							<td>{{$hoy_cita->contacto->nombre}}</td>
							<td>{{$hoy_cita->fecha}}</td>
							<td>{{$hoy_cita->hora}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
</div>

{{--modal detalles--}}
<div id="modalDetalles" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Detalles</h3>
			</div>
			<div class="modal-body">
				<input id="idCita" type="hidden">
				<div class="row">
					<div class="col-sm-4">
						<h5 style="font-weight: bold">Nombre:</h5>
						<p id="dNombre"></p>
					</div>
					<div class="col-sm-4">
						<h5 style="font-weight: bold">Apellidos:</h5>
						<p id="dApellidos"></p>
					</div>
					<div class="col-sm-4">
						<h5 style="font-weight: bold">Dirección:</h5>
						<p id="dDireccion"></p>
					</div>
					<div class="col-sm-4">
						<h5 style="font-weight: bold">Telefono:</h5>
						<p id="dTelefono"></p>
					</div>
					<div class="col-sm-4">
						<h5 style="font-weight: bold">Fecha:</h5>
						<p id="dFecha"></p>
					</div>
					<div class="col-sm-4">
						<h5 style="font-weight: bold">Hora:</h5>
						<p id="dHora"></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="cancelarCita" class="btn" style="float:left;">Cancelar Cita</button>
				<button id="editarCita" class="btn btn-primary" id="closeModal" data-id="0">Editar</button>
				<button class="btn btn-danger" id="closeModal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
{{--editar Cita--}}
<div id="modalCita" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Editar Cita</h3>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="text" id="id_cita">
					<form id="citasForm" action="">
						<label for="nombre">Fecha:</label>	
						<input type="date" id="fecha" name="fecha" class="form-control" required="">
						<br>
						<label for="apellido_paterno">Hora:</label>	
						<input type="time" id="hora" name="hora" class="form-control" required=""> 
						<input type="hidden" id="contacto_id" name="contacto_id">
				</div>				
			</div>
			<div class="modal-footer">
			
				<button type="submit" class="btn">Editar</button>
				
				</form>
				<button class="btn btn-danger" id="closeModalCita">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<script>
	$('#citasTable tr').on('dblclick', function(){
		$.ajaxSetup({
   		 headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   		 }
    	});
    	$.ajax({
    		type: 'GET',
    		url: "{!! url('citas') !!}" + "/" + $(this).attr('id'),
    		success:function(data){
    			$('#idCita').val(data.id);
    		    $('#dNombre').text(data.contacto.nombre);
    			$('#dApellidos').text(data.contacto.apellido_paterno +" " +  data.contacto.apellido_materno);
    			$('#dDireccion').text(data.contacto.direccion);
    			$('#dTelefono').text(data.contacto.telefono);
    			$('#dFecha').text(data.fecha);
    			$('#dHora').text(data.hora);
    			$('#modalDetalles').modal('show');
    			$('#idContacto').val(data.id);
    			/*$('#editarb').attr('data-id', data.id);/*/
    		}
    	})
	})
	$('#editarCita').on('click', function(){
		$('#id_cita').val($('#idCita').val());
		$('#fecha').val($('#dFecha').text());
		$('#hora').val($('#dHora').text());
		$('#modalDetalles').modal('hide');
		$('#modalCita').modal('show');
	})

	 $('#citasForm').submit(function(e){
     	e.preventDefault();
		var data= $(this).serialize();
		$.ajaxSetup({
   		 headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   		 }
    	});
		$.ajax({
			type: 'PUT',
			url: "{!! url('citas') !!}" + "/" + $('#id_cita').val(),
			data: data,
			success:function(data){
				$('#' + data.id).find('td:eq(1)').text(data.fecha);
				$('#' + data.id).find('td:eq(2)').text(data.hora);
				$('#modalCita').modal('hide');
			}
		})
     })
     $('#cancelarCita').on('click', function(){
		$.ajaxSetup({
   		 headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   		 }
    	});
		$.ajax({
			type: 'DELETE',
			url: "{!! url('citas') !!}" + "/" + $('#idCita').val(),
			success:function(data){
				$('#' + data).remove();
				$('#modalDetalles').modal('hide');
			}
		})
	})
</script>
	
@stop