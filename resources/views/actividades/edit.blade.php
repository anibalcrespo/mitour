@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-semibold text-gray-800">Crear Nueva Actividad</h1>

        <form action="{{ route('actividades.update', $actividade->id) }}" method="POST" class="mt-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="tipo_actividad_id" class="block text-gray-700">Tipo Actividad</label>
                <select name="tipo_actividad_id" id="tipo_actividad_id" class="w-full px-4 py-2 border rounded" required>
                    @foreach($tipo_actividades as $tipo)
                    <option @if($tipo->id == $actividade->id) selected @endif value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
                    @endforeach
                </select>    
                @error('tipo_actividad_id')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="titulo" class="block text-gray-700">Titulo</label>
                <input type="text" name="titulo" id="titulo" class="w-full px-4 py-2 border rounded" value="{{ $actividade->titulo }}" required>
                @error('titulo')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="10" class="ckeditor w-full px-4 py-2 border rounded">{{ $actividade->descripcion }}</textarea>
                @error('descripcion')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image1" class="flex items-center gap-2 cursor-pointer bg-[#009ee3] text-white px-4 py-2 rounded-lg hover:bg-[#009ee3]">Imagen Principal</label>
                <input type="file" name="image1" id="image1" class="hidden" value="" required>
                @error('image1')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image2" class="flex items-center gap-2 cursor-pointer bg-[#009ee3] text-white px-4 py-2 rounded-lg hover:bg-[#009ee3]">Imagen Alternativa 1</label>
                <input type="file" name="image2" id="image2" class="hidden" value="">
                @error('image2')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image3" class="flex items-center gap-2 cursor-pointer bg-[#009ee3] text-white px-4 py-2 rounded-lg hover:bg-[#009ee3]">Imagen Alternativa 2</label>
                <input type="file" name="image3" id="image3" class="hidden" value="">
                @error('image3')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-[#009ee3] text-white py-2 px-4 rounded">Guardar</button>
        </form>
    </div>
@endsection

@section('script')
<script>
        ClassicEditor.create(document.querySelector('.ckeditor')).catch((error) => {
            console.error(error);
        });
    </script>
@endsection