@extends('layouts.app')


@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Subir nueva imagen</div>


                <div class="card-body">
                    <form method="POST" action="{{route('image.save')}}" enctype="multipart/form-data">

                        @csrf



                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right" for="image_path">Imagen</label>
                            <div class="col-md-7">
                                <input type="file" id="image_path" name="image_path"
                                    class="form-control {{$errors->has('image_path') ? 'is-invalid' : ''}}" required>
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
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input class="btn btn-primary" type="submit" value="Subir imagen">

                            </div>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection