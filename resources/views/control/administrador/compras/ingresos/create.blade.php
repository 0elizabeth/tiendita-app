@extends('adminlte::page')
@section('title','Nueva compra')
@section('content_header')
<h1>Nueva compra</h1>
@stop
@section('content')

{!! Form::open(['route'=>'control.administrador.compras.ingresos.create','method'=>'get','role'=>'search']) !!}
<div class="row">
  <div class="col-sm-12">
    <div class="mb-1 col-sm-12 col-md-3" style='display:inline-block'>
      <input type="text" name="search_dniRuc"  class="form-control" placeholder="ingrese Ruc para buscar">
    </div>
      <div class="col-sm-12 col-md-3" style='display:inline-block'>
        <button class="btn btn-outline-primary" id="btn_search" type="submit"><i class="fas fa-search"></i></button>
      </div>
  </div>
</div>
    <div class="row"> 
      <div class="col-sm-12 col-md-4">
        <label for="">Nombre</label>
        {!! Form::text('nombre', null, ['class'=>'form-control']) !!}
      </div>
      <div class="col-sm-12 col-md-3">
        <label for="">Telefono</label>
        {!! Form::text('telefono', null, ['class'=>'form-control']) !!}
      </div>
      <div class="col-sm-12 col-md-4">
        <label for="">Direccion</label>
        {!! Form::text('direccion', null, ['class'=>'form-control']) !!}
      </div>
    </div>
{!! Form::close() !!}

<div class='row'>
  <div class="col-sm-12 col-md-12 col-lg-12">
  <div class="card">
  </div>
     <div class="card-body">
      {!! Form::open(['route'=>'control.administrador.compras.ingresos.store','method'=>'post']) !!}
          {{-- @if (isset($proveedore))
          <input type="hidden" value="{{ $proveedore->id }}" name="catalogo_d">
          @endif --}}
  {{--         <div class="col-sm-6 col-md-12"> --}}
               <div class="row">
                 
                 <div class="col-sm-12 col-md-2">
                  {!! Form::label(null, 'fecha', [null]) !!}
                  {!! Form::date('fecha', $ingreso->fecha, ['class'=>'form-control']) !!}
                </div>
                                
                <div class="col-sm-12 col-md-4">
                  {!! Form::label(null, 'Tipo de comprobante', [null]) !!}
                  {!! Form::text('tipoComprobante', $ingreso->tipoComprobante, ['class'=>'form-control', 'id'=>'tcomprob']) !!}
                </div>
                <div class="col-sm-12 col-md-3" style='display:inline-block'>
                  {!! Form::label(null, 'Codigo de comprobante', [null]) !!}
                  {!! Form::text('codComprobante', $ingreso->codComprobante, ['class'=>'form-control']) !!}
                </div>                 
                </div>
     {{--        </div> --}}
            <div class="row">
              
            </div>
            <div class="row">
              {{-- <div class="col-sm-12 col-md-1 d-block">
                <label for="">.</label>
                <a class="btn btn-outline-primary mb-1" id="btn_add" type="button">
                  <i class="fas fa-plus"></i>
                </a>
              </div> --}}
              <div class="col-sm-12 col-md-7">
                {!! Form::label('catalogo', 'Producto', [null]) !!}

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button class="btn btn-outline-primary" id="btn_add" type="button"><i class="fas fa-plus"></i></button>
                  </div>
                  <select id="catalogo"  class="form-control" aria-label="Example select with button addon">
                    <option selected value="0">Elija...</option>
                    @foreach ($catalogos as $catalogo)
                      <option value="{{ $catalogo->id }}" >{{ $catalogo->nombre }} - {{ $catalogo->precio }}</option>
                    @endforeach
                  </select>
                </div>

                
              </div>
              <div class="col-ms-12 col-md-1">
                {!! Form::label('cantidad', 'Cant.', [null]) !!}
                {!! Form::text('cantidad', null, ['class'=>'form-control','id'=>'cantidad']) !!}
              </div>
              <div class="col-ms-12 col-md-1">
                {!! Form::label(null, 'Precio', [null]) !!}
                {!! Form::text('precio', null, ['class'=>'form-control','id'=>'precio']) !!}
              </div>
              <div class="col-ms-12 col-md-2">
                {!! Form::label(null, 'total', [null]) !!}
                {!! Form::label(null, null, ['class'=>'form-control','id'=>'total-label']) !!}
              </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 4rem"></th>
                        <th>Cantidad</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                       {{--  <th></th> --}}
                    </tr>
                </thead>
                <tbody id="cuerpo">
                </tbody>
            </table>
        </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary" type="submit">
                Guardar
            </button>
          </div>
        {!! Form::close() !!}
          </div>
     </div>
  </div>
</div>
@stop
@section('js')
<script>
  //variable toma valor de boton agregar
  const btn = document.getElementById('btn_add');
  //funcion al hacer click
  btn.addEventListener('click', function(){
  //variable toma valor del select
  const select = document.getElementById('catalogo');
  //value toma el id del select y se guarda en la variable
  const id = select.value;
  //la variable guarda en texto del select
  text = select.options[select.selectedIndex].text;
  //declaracion de variables para cantidad y precio
  const txt_cantidad = document.getElementById('cantidad');
  const txt_precio = document.getElementById('precio');
  //division de la cadena del select
  let data = text.split('-');
  //creacion de fila
  let row = document.createElement('tr');
  //darle valor al id de la fila
  row.id = select.value;
  //creacion de columna para el boton
  let c_btn = document.createElement('td');
  //creacion de boton
  let btn_eliminar = document.createElement('a');
  //asignar propiedades a boton
  btn_eliminar.innerHTML="X";
  btn_eliminar.setAttribute('class', 'btn btn-danger');
  btn_eliminar.setAttribute('onClick', 'eliminar('+select.value+')');
  //agregar boton en columna
  c_btn.appendChild(btn_eliminar);
  //creacion de columna para la cantidad
  let cantidad = document.createElement('td');
  //nombre a la columna 'cant_' mas id
  cantidad.id = 'cant_'+select.value;
  //mas columnas y sus nombres
  let nombre = document.createElement('td');
  let precio = document.createElement('td');
  precio.id = 'pre_'+select.value;
  let subtotal = document.createElement('td');
  subtotal.id = 'subt_'+select.value;
  //dar valor a columna cantidad
  cantidad.innerHTML = txt_cantidad.value;
  //dar valor a columna nombre
  nombre.innerHTML = data[0];
  //valor a columna precio
  precio.innerHTML = txt_precio.value;
  //agregamos columnas a la fila
  row.appendChild(c_btn); //columna del boton
  row.appendChild(cantidad); //columna cantidad
  row.appendChild(nombre);
  row.appendChild(precio);
  row.appendChild(subtotal);
  //declaracion de variable tomando espacio en tabla HTML
  let tabla = document.getElementById('cuerpo');
  //verificar producto en tabla
  //variable que toma id a verificar
  let verificar = document.getElementById(select.value);
  if(verificar){//si devuelve el valor true
    //variable que tomará el valor del id
    let c_cantidad = document.getElementById("cant_"+select.value);
    //suma la cantidad
    c_cantidad.innerHTML = parseInt(c_cantidad.innerHTML) + parseInt(txt_cantidad.value);
    //variable para el subtotal
    let subto = document.getElementById("sub_"+select.value);
    //operacion con la cantidad unitaria y el precio
    subto.innerHTML = parseInt(c_cantidad.innerHTML) * parseInt(txt_precio.value);
  }else{//si devuelve valor false
    //agrega la fila a la tabla
    tabla.appendChild(row);
    let subto = document.getElementById("subt_"+select.value);
    subto.innerHTML = parseInt(txt_precio.value);
  }
  });

  function eliminar(id){
    let row = document.getElementById(id);
    row.remove();
  }
</script>
@stop