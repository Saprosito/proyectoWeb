@extends('adminlte::page')

@section('title', 'Mundo mangas')

@section('content_header')
    <h1>Mundo mangas/manhwa/manhua</h1>
@stop

@section('content')
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-xl sm:rounded-lg">
                
            <a type="button" href="{{ route('productos.create') }}" class="bg-blue-500 px-12 py-2 rounded text-gray-200 font-semibold hover:bg-blue-800 transition duration-200 each-in-out">Añadir nuevo manga</a>
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th style="display: none;">ID</th>
                        <th class="border px-4 py-2">NOMBRE</th>
                        <th class="border px-4 py-2">DESCRIPCION</th>
                        <th class="border px-4 py-2">IMAGEN</th>
                        <th class="border px-4 py-2">ACCIONES</th>
                    </tr>  
                </thead>    
                <tbody>
                    @foreach ($productos as $producto)
                    <tr>
                        <td style="display: none;">{{$producto->id}}</td>
                        <td><a href=""><b>{{$producto->nombre}}</b></a></td>
                        <td>{{$producto->descripcion}}</td>
                        <td  class="border px-14 py-1">
                            <img src="/imagen/{{$producto->imagen}}" width="60%">
                        </td>                        
                        <td class="border px-4 py-2">
                            <div class="flex justify-center rounded-lg text-lg" role="group">
                                <!-- botón editar -->
                                <a href="{{ route('productos.edit', $producto->id) }}" class="rounded bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4">Editar</a>

                                <!-- botón borrar -->
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="formEliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded bg-pink-400 hover:bg-pink-500 text-white font-bold py-2 px-4">Borrar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach   
                </tbody>  
                
            </table>   
                <div>
                    {!! $productos->links() !!}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    (function () {
    'use strict'
  //debemos crear la clase formEliminar dentro del form del boton borrar
  //recordar que cada registro a eliminar esta contenido en un form  
    var forms = document.querySelectorAll('.formEliminar')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {        
            event.preventDefault()
            event.stopPropagation()        
            Swal.fire({
                title: '¿Eliminará este manga/manhwa/manhua permanentemente?',        
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#20c997',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Confirmar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                    Swal.fire('¡Eliminado!', 'El manga/manhwa/manhua se ha eliminado exitosamente.','success');
                }
            })                      
        }, false)
    })
})()
</script>
@stop