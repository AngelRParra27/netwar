@extends('welcome')
@section('contenido')
<style>
	
	.input{
		border: none;
	}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<button style="margin-top: 3%;" id="añadirContacto" class="btn btn-sm">Añadir Contacto</button>
			<label for="buscar" style="float:right;">Buscar: 
			<input id="buscar" name="buscar" type="text" class="form-control">
			</label>
		</div>
		<div class="col-sm-12 text-center">
			<table class="table table-hover" >
				<thead>
					<tr>
						<th class="text-center">Nombre</th>
						<th class="text-center">Telefono</th>
						<th class="text-center">Detalles</th>
					</tr>					
				</thead>
				<tbody id="contactosTable">
				@foreach($contactos as $contacto)
					<tr id="{{$contacto->id}}" class="buscar">
						<td>{{$contacto->nombre}} {{$contacto->apellido_paterno}} {{$contacto->apellido_materno}}</td>
						<td>{{$contacto->telefono}}</td>
						<td><button id="detalles" class="btn btn-primary btn-sm" data-id="{{$contacto->id}}">Detalles</button></td>
					</tr>
			    @endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
{{--Modal detalles--}}
<div id="modalDetalles" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Detalles</h3>
			</div>
			<div class="modal-body">
				<input id="idContacto" type="hidden">
				<div class="row">
					<div class="col-sm-4">
						<h5 style="font-weight: bold">Nombre:</h5>
						<p id="dnombre"></p>
					</div>
					<div class="col-sm-4">
						<h5 style="font-weight: bold">Apellido Paterno:</h5>
						<p id="dapellidop"></p>
					</div>
					<div class="col-sm-4">
						<h5 style="font-weight: bold">Apellido Materno:</h5>
						<p id="dapellidom"></p>
					</div>
					<div class="col-sm-4">
						<h5 style="font-weight: bold">Estado:</h5>
						<p id="destado"></p>
					</div>
					<div class="col-sm-4">
						<h5 style="font-weight: bold">Ciudad:</h5>
						<p id="dciudad"></p>
					</div>
					<div class="col-sm-4">
						<h5 style="font-weight: bold">Dirección:</h5>
						<p id="dDireccion"></p>
					</div>
					<div class="col-sm-4">
						<h5 style="font-weight: bold">Telefono:</h5>
						<p id="dTelefono"></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="cita" class="btn" style="float:left;">Agendar Cita</button>
				<button id="editarb" class="btn btn-primary" id="closeModal" data-id="0">Editar</button>
				<button class="btn btn-danger" id="closeModal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

 
{{--Agregar Contactos--}}
<div id="modalAñadir" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Añadir Nuevo Contacto</h3>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<form id="añadirContactoForm" action="">
						<label for="nombre">Nombre:</label>	
						<input type="text" id="nombre" name="nombre" class="form-control" required="">
						<br>
						<label for="apellido_paterno">Apellido Paterno:</label>	
						<input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control" required="">
						<br>
						<label for="apellido_materno">Apellido Materno:</label>	
						<input type="text" id="apellido_materno" name="apellido_materno" class="form-control" required="">
						<br>
						<label for="direccion">Direccion</label>
						<input type="text" class="form-control" id="direccion" name="direccion" required="">
						<br>
						<label for="telefono">Telefono</label>
						<input type="text" class="form-control" id="telefono" name="telefono" required="">
						<br>
						<label for="telefono">Estado</label>
						<select class="form-control" name="estado" id="estado" required="">
							@foreach($estados as $estado) 
								<option value="{{$estado->id}}">{{$estado->estado}}</option>
							@endforeach
						</select>
						
						<br>
						<label for="telefono">Ciudad</label>
						<select class="form-control" name="ciudad" id="ciudad" required="">					
						</select>		
				</div>				
			</div>
			<div class="modal-footer">
			
				<button type="submit" class="btn">Añadir</button>
				<button class="btn btn-danger" id="closeModal">Cerrar</button>
				</form>
			</div>
		</div>
	</div>
</div>
{{--editar Contactos--}}
<div id="modalEditar" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Editar Contacto</h3>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="hidden" id="eidContacto">
					<form id="editarForm" action="">
						<label for="nombre">Nombre:</label>	
						<input type="text" id="enombre" name="nombre" class="form-control" required="">
						<br>
						<label for="apellido_paterno">Apellido Paterno:</label>	
						<input type="text" id="eapellido_paterno" name="apellido_paterno" class="form-control" required="">
						<br>
						<label for="apellido_materno">Apellido Materno:</label>	
						<input type="text" id="eapellido_materno" name="apellido_materno" class="form-control" required="">
						<br>
						<label for="direccion">Direccion</label>
						<input type="text" class="form-control" id="edireccion" name="direccion" required="">
						<br>
						<label for="telefono">Telefono</label>
						<input type="text" class="form-control" id="etelefono" name="telefono" required="">
						<br>
						<label for="telefono">Estado</label>
						<select class="form-control" name="estado" id="eestado" required="">
							@foreach($estados as $estado)
								<option value="{{$estado->id}}">{{$estado->estado}}</option>
							@endforeach
						</select>
						
						<br>
						<label for="telefono">Ciudad</label>
						<select class="form-control" name="ciudad" id="eciudad" required="">					
						</select>		
				</div>				
			</div>
			<div class="modal-footer">
				<button id="editarButton" type="submit" class="btn">Editar</button>
				</form>
				<button class="btn btn-danger" id="closeModalEditar">Cerrar</button>
			</div>
		</div>
	</div>
</div>
{{--Agendar Cita--}}
<div id="modalCita" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Agendar Cita</h3>
			</div>
			<div class="modal-body">
				<div class="form-group">
					
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
			
				<button type="submit" class="btn">Agerdar</button>
				
				</form>
				<button class="btn btn-danger" id="closeModalCita">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).on('click', '#editarb',function(){
	
		$('#enombre').val($('#dnombre').text());
		$('#eapellido_paterno').val($('#dapellidop').text());
		$('#eapellido_materno').val($('#dapellidom').text());
		$('#edireccion').val($('#dDireccion').text());
		$('#etelefono').val($('#dTelefono').text());
		$('#eidContacto').val($('#idContacto').val());
		$('#modalDetalles').modal('hide')
		$('#modalEditar').modal('show');
	})

	$('#estado').on('change', function(){
		$.ajaxSetup({
   		 headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   		 }
    	});
    	$.ajax({
    		type: 'GET',
    		url: "{{url('/getCiudades')}}",
    		data:{
    			'id': $(this).val()
    		},success:function(data){
    			$('#ciudad option').remove();
    			data.forEach(function(ciudad){
    				  $('#ciudad').append($("<option></option>").attr("value",ciudad.id).text(ciudad.municipio)); 
    			})
    		}
    	})
	})
	$('#eestado').on('change', function(){
		$.ajaxSetup({
   		 headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   		 }
    	});
    	$.ajax({
    		type: 'GET',
    		url: "{{url('/getCiudades')}}",
    		data:{
    			'id': $(this).val()
    		},success:function(data){
    			$('#eciudad option').remove();
    			data.forEach(function(ciudad){
    				  $('#eciudad').append($("<option></option>").attr("value",ciudad.id).text(ciudad.municipio)); 
    			})
    		}
    	})
	})
	$(document).on('click', '#detalles', function(){
		$.ajaxSetup({
   		 headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   		 }
    	});
    	$.ajax({
    		type: 'GET',
    		url: "{!! url('contactos') !!}" + "/" + $(this).data('id'),
    		success:function(data){
    			$('#dnombre').text(data.nombre);
    			$('#dapellidom').text(data.apellido_materno);
    			$('#dapellidop').text(data.apellido_paterno);
    			$('#dDireccion').text(data.direccion);
    			$('#dciudad').text(data.ciudad.municipio);
    			$('#destado').text(data.estado.estado);
    			$('#dTelefono').text(data.telefono)
    			$('#modalDetalles').modal('show');
    			$('#idContacto').val(data.id);
    			/*$('#editarb').attr('data-id', data.id);/*/
    		}
    	})
	})
	$(document).on('click', '#closeModal', function(){
		$('#modalDetalles').modal('toggle');
	})
	$(document).on('click',' #añadirContacto', function(){
		$('#modalAñadir').modal('show');
	})
	$('#añadirContactoForm').submit(function(e){
		e.preventDefault();
		var data= $(this).serialize();
		$.ajaxSetup({
   		 headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   		 }
    	});
		$.ajax({
			type: 'POST',
			url: "{!! url('contactos') !!}",
			data: data,
			success:function(data){
				$('#contactosTable').append(
					'<tr class="buscar" id="'+data.id+'">' +
					'<td>' + data.nombre + '</td>' +
					'<td>' + data.telefono + '</td>' +
					'<td>' + '<button id="detalles" class="btn btn-primary btn-sm" data-id="'+data.id+'">Detalles</button>'+ '</td>'+
					'</tr>'
					);
				$('#modalAñadir').modal('hide');
			}
		})

		console.log($(this).serialize())
	})
	  $('#buscar').keyup(function () {
             var rex = new RegExp($(this).val(), 'i');
             $('#contactosTable tr').hide();
             $('#contactosTable tr').filter(function () {
                  return rex.test($(this).text());
              }).show();
      })

     $('#editarForm').submit(function(e){
     	e.preventDefault();
		var data= $(this).serialize();
		$.ajaxSetup({
   		 headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   		 }
    	});
		$.ajax({
			type: 'PUT',
			url: "{!! url('contactos') !!}" + "/" + $('#eidContacto').val(),
			data: data,
			success:function(data){
				
			}
		})
     })
      $('#closeModalEditar').on('click', function(){
     	$('#modalEditar').modal('hide');
     })
     $('#closeModalCita').on('click', function(){
     	$('#modalCita').modal('hide');
     })
     $('#cita').on('click', function(){
     	$('#modalDetalles').modal('hide');
     	$('#contacto_id').val($('#idContacto').val())
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
			type: 'POST',
			url: "{!! url('citas') !!}",
			data: data,
			success:function(data){
				$('#modalCita').modal('hide');
			}
		})
     })
</script>
@stop