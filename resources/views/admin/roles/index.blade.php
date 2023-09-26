@extends('layouts.app')
@section('title', 'Listar Roles')
@section('content')
    @if(Session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session('edit'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            {{session('edit')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista de Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Lista de Roles</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('admin.roles.create')}}" title="Crear Rol" class="new-mas"><i class="fas fa-plus"></i></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-3">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Nombre del Rol</th>
                                    <th scope="col">Creación</th>
                                    <th scope="col">Edición</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr class="text-center">
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{ $role->created_at->format('Y-m-d')  }}</td>
                                        <td>{{$role->updated_at->format('Y-m-d')}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <form method="post" action="{{route('admin.roles.destroy', $role)}}" id="eliminarrol_{{ $loop->iteration }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a title="Eliminar" onclick="document.getElementById('eliminarrol_{{ $loop->iteration }}').submit()" class="  btn btn-danger btn-company-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                <a title="Editar" href="{{route('admin.roles.edit',$role)}}"
                                                   class="me-2 btn btn-warning btn-company-danger">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{route('admin.roles.show',$role->id)}}"
                                                   class=" btn btn-success"><i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
