@extends('layouts.app')
@section('title', 'Instrucciones')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Intrucciones Bingo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Intrucciones Bingo</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid" >
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    @can('admin.instructions.edit')
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fa fa-edit"></i></button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <p style="font-size: 1.8rem; font-weight: 500"> Instrucciones:</p>
                                    @foreach($instructions as $instruction)
                                        {!! $instruction->description_one !!}
                                    @endforeach
                                </div>
                                <div class="col-12 mt-3">
                                    <p style="font-size: 1.8rem; font-weight: 500"> Cómo cantar ¡BINGO FOPRE!:</p>
                                    @foreach($instructions as $instruction)
                                        {!! $instruction->description_two !!}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @can('admin.instructions.edit')
            <div class="modal fade" id="modal-default"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-edit"></i> Editar Instrucciones</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @foreach($instructions as $instruction)

                    <form action="{{route('admin.instructions.update', $instruction)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                <div class="d-flex justify-content-end">
                                    <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                </div>
                                <div class="form-group">
                                    <label for="edit-instrucciones"><span class="text-danger">*</span> Instrucciones:</label>
                                    <textarea id="edit-instrucciones" name="description_one" required class="form-control" style="height: 500px!important;">
                                        {{$instruction->description_one}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit-cantarbingo"><span class="text-danger">*</span> Cómo cantar ¡BINGO FOPRE!:</label>
                                    <textarea id="edit-cantarbingo" name="description_two" required class="form-control" style="height: 500px!important;">
                                        {{$instruction->description_two}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                            <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button>
                        </div>
                    </form>
                    @endforeach

                </div>
            </div>
        </div>
        @endcan
    </section>
@endsection
@section('js')
    <script>
        $(function () {
            //Add text editor
            $('#edit-instrucciones').summernote(
                {
                    tabsize: 2,
                    height: 200
                }
            );
        });
        $(function () {
            //Add text editor
            $('#edit-cantarbingo').summernote(
                {
                    tabsize: 2,
                    height: 200
                }
            );
        });
    </script>
@endsection
