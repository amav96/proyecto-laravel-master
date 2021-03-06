@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')



            <div class="card pub_image pub_image_detail">
                <div class="card-header">

                    @if($image->user->image)
                    <div class="container-avatar">
                        <img class="avatar" src="{{ route('user.avatar',['filename'=>$image->user->image])}}" alt="">
                    </div>
                    @endif
                    <div class="data-user">
                        {{ $image->user->name }}
                        <span class="nickname">
                            {{' | @'.$image->user->nick}}
                        </span>
                    </div>
                </div>

                <div class="card-body">

                    @if($image->user->image)
                    <div class="image-container image-detail">
                        <img src="{{route('image.file',['filename' => $image->image_path])}}" alt="">
                    </div>
                    @endif

                    <div class="description">
                        <span class="nickname">{{'@'.$image->user->nick}}</span>
                        <span class="nickname date">{{ ' | '.\FormatTime::LongTimeFilter($image->created_at)}}</span>

                        <p>
                            {{$image->description}}
                        </p>

                    </div>


                    <div class="likes">

                        {{-- Comprobar si el usuario le dio like a la imagen --}}

                        <?php  $user_like = false; ?>
                        @foreach($image->likes as $like)
                        @if($like->user->id == Auth::user()->id)
                        <?php  $user_like = true; ?>
                        @endif
                        @endforeach

                        @if($user_like)
                        <img src="{{asset('img/heart-red.png')}}" class="btn-dislike" data-id="{{$image->id}}" alt="">
                        @else
                        <img src="{{asset('img/heart-black.png')}}" class="btn-like" data-id="{{$image->id}}" alt="">
                        @endif
                        <span class="number_likes">{{count($image->likes)}} </span>


                    </div>

                    @if(Auth::user() && Auth::user()->id == $image->user->id)

                    <div class="actions">
                        <a href="{{route('image.edit',['id' => $image->id])}}"
                            class="btn btn-sm btn-primary">Actualizar</a>


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                            data-target="#exampleModal">
                            Eliminar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Si eliminas esta imagen nunca podras recuperar, ¿Estas seguro?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                        <a href="{{route('image.delete',['id' => $image->id])}}"
                                            class="btn btn-danger">Borrar definitvamaente</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    @endif



                    <div class="clearfix"></div>

                    <div class="comments">
                        <h2>Comentarios ({{count($image->comments)}})</h2>
                        <hr>
                        <form action="{{route('comment.save')}}" method="POST">
                            @csrf
                            <input type="hidden" name="image_id" value="{{$image->id}}">
                            <p>
                                <textarea class="form-control {{$errors->has('content') ? 'is-invalid' : ''}}"
                                    name="content"></textarea>

                                @if($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{$errors->first('content')}}</strong>
                                </span>

                                @endif
                            </p>

                            <button class="btn btn-success" type="submit">Enviar</button>

                        </form>
                        <hr>

                        @foreach($image->comments as $comment)
                        <div class="comment">


                            <span class="nickname">{{'@'.$comment->user->nick}}</span>
                            <span
                                class="nickname date">{{ ' | '.\FormatTime::LongTimeFilter($comment->created_at)}}</span>

                            <p>
                                {{$comment->content}} <br>


                                @if(Auth::check() && ($comment->user_id == Auth::user()->id ||
                                $comment->image->user_id==Auth::user()->id))
                                <a class="btn btn-sm btn-danger"
                                    href="{{route('comment.delete',['id' => $comment->id])}}">
                                    Eliminar
                                </a>

                                @endif
                            </p>
                        </div>

                        @endforeach

                    </div>
                </div>
            </div>


            {{-- Paginacion --}}


        </div>


    </div>
</div>
@endsection