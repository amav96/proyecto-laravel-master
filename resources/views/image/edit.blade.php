@extends('layouts.app')


@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Editar mi imagen</div>


                <div class="card-body">
                    <form method="POST" action="{{route('image.update')}}" enctype="multipart/form-data">

                        @csrf

                        <input type="hidden" name="image_id" value="{{$image->id}}">

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right" for="image_path">Imagen</label>
                            <div class="col-md-7">

                                @if($image->user->image)
                                <div class="image-container image-detail">
                                    <img class="avatar" src="{{route('image.file',['filename' => $image->image_path])}}"
                                        alt="">
                                </div>
                                @endif
                                <input type="file" id="image_path" name="image_path"
                                    class="form-control {{$errors->has('image_path') ? 'is-invalid' : ''}}">
                                @if($errors->has('image_path'))
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$errors->first('image_path')}}</strong>
                                </span>



                                @endif
                            </div>

                            {{-- @error('image_path')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror --}}


                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right" for="description">Descripcion</label>
                            <div class="col-md-7">

                                <textarea type="text" id="description" name="description"
                                    class="form-control {{$errors->has('content') ? 'is-invalid' : ''}}" required>
                                    {{$image->description}}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input class="btn btn-primary" type="submit" value="Actualizar imagen">

                            </div>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection