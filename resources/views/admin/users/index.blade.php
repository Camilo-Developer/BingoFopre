@extends('layouts.app')
@section('title', 'Lista de Usuarios')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista de Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Lista de Usuarios</li>
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
                                <div class="col-12 col-md-3">
                                    @can('admin.users.create')
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_crear_user"> <i class="fa fa-plus"></i> Crear Usuarios</button>
                                    @endcan
                                </div>
                                <div class="col-12 col-md-9 d-flex justify-content-end">
                                    <form action="{{ route('admin.users.index') }}" method="GET">
                                        <div class="input-group input-group-sm buq-menu" >
                                            <input value="{{$search}}"   type="search" name="search" class="form-control float-right" placeholder="Buscar Usuario">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col">Creación</th>
                                        <th scope="col">Edición</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr class="text-center">
                                            <th scope="row" style="width: 50px;">{{$user->id}}</th>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->lastname}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->state->name}}</td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                    {{ $role->name }}
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $user->created_at->format('Y-m-d')  }}</td>
                                            <td>{{$user->updated_at->format('Y-m-d')}}</td>
                                            <td style="width: 100px;">
                                                <div class="btn-group">
                                                    @can('admin.users.edit')
                                                        <button type="button" data-toggle="modal" data-target="#modal_edit_user_{{$loop->iteration}}" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                                    @endcan
                                                    @can('admin.users.show')
                                                        <a href="{{route('admin.users.show',$user)}}" class="btn btn-success" style="margin-left: 5px;"><i class="fa fa-eye"></i></a>
                                                    @endcan
                                                    @can('admin.users.destroy')
                                                        <a title="Eliminar" onclick="document.getElementById('eliminaruser_{{ $loop->iteration }}').submit()" class="  btn btn-danger btn-company-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                        @can('admin.users.destroy')
                                            <form method="post" action="{{route('admin.users.destroy', $user)}}" id="eliminaruser_{{ $loop->iteration }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if(!empty($search) && !$users->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-danger"><i class="fa fa-trash"></i> Borrar búsqueda</a>
                                    </div>
                                </div>
                            @endif
                            @if($users->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-center mt-4">No hay resultados para tu búsqueda.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-danger"> <i class="fa fa-trash"></i> Borrar búsqueda</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_crear_user"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="fa fa-user"></i> Nuevo Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{route('admin.users.store')}}" method="post">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                <div class="d-flex justify-content-end">
                                    <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nombre_usuario"><span class="text-danger mt-1">* </span> Nombres del usuario:</label>
                                            <input type="text" class="form-control form-control-border" id="nombre_usuario" name="name" placeholder="Nombre del usuario">
                                        </div>
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="apellido_usuario"><span class="text-danger mt-1">* </span> Apellidos del usuario:</label>
                                            <input type="text" class="form-control form-control-border" id="apellido_usuario" name="lastname" placeholder="Apellidos del usuario">
                                        </div>
                                        @error('lastname')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="email_usuario"><span class="text-danger mt-1">* </span> Correo eléctronico del usuario:</label>
                                            <input autocomplete="off" type="email" class="form-control form-control-border" id="email_usuario" name="email" placeholder="Example@example.com">
                                        </div>
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="password_usuario"><span class="text-danger mt-1">* </span> Contraseña del usuario:</label>
                                            <input autocomplete="off" type="password" class="form-control form-control-border" id="password_usuario" name="password" placeholder="Contraseña del usuario">
                                        </div>
                                        @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="roles"><span class="text-danger mt-1">* </span> Rol del usuario:</label>
                                            <select class="custom-select form-control-border" name="roles[]" id="roles" multiple>
                                                <option value="" disabled>--Seleccionar Rol--</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}" {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('roles')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="state_id"><span class="text-danger mt-1">* </span> Estado del usuario:</label>
                                            <select class="custom-select form-control-border" name="state_id" id="state_id">
                                                <option value="">--Seleccionar Estado--</option>
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('state_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @can('admin.users.edit')
        @foreach($users as $user)
            <div class="modal fade" id="modal_edit_user_{{$loop->iteration}}"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-user-edit"></i> Editar Usuario</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{route('admin.users.update',$user)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                    <div class="d-flex justify-content-end">
                                        <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name"><span class="text-danger mt-1">* </span> Nombres del usuario:</label>
                                                <input type="text" class="form-control form-control-border" id="name" name="name" value="{{$user->name}}">
                                            </div>
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="lastname"><span class="text-danger mt-1">* </span> Apellidos del usuario:</label>
                                                <input type="text" class="form-control form-control-border" id="lastname" name="lastname" value="{{$user->lastname}}">
                                            </div>
                                            @error('lastname')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email"><span class="text-danger mt-1">* </span> Correo eléctronico del usuario:</label>
                                                <input type="email" class="form-control form-control-border" id="email" name="email" value="{{$user->email}}">
                                            </div>
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="password_usuario">Contraseña del usuario:</label>
                                                <input type="password" class="form-control form-control-border" id="password_usuario" name="password" placeholder="Nueva Contraseña del Usuario">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="state_id"><span class="text-danger mt-1">* </span>  Estado del usuario:</label>
                                                <select class="custom-select form-control-border" name="state_id" id="state_id">
                                                    <option >--Seleccionar Estado--</option>
                                                    @foreach($states as $state)
                                                        <option value="{{$state->id}}" {{ $state->id == $user->state_id ? 'selected' : '' }} {{ old('state_id') == $state->id ? 'selected' : '' }}>{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('state_id')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label><span class="text-danger mt-1">* </span>  Rol del usuario:</label>
                                                @foreach($roles as $role)
                                                    <div>
                                                        <div class="form-check">

                                                            <input class="form-check-input" name="roles[]" type="checkbox" value="{{$role->id}}" @if(in_array($role->id,$user->roles->pluck('id')->toArray())) checked @endif id="{{$role->name}}">
                                                            <label class="form-check-label" for="{{$role->name}}">
                                                                {{$role->name}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @error('roles')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-times"></i> Cerrar</button>
                                <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        @endcan

    </section>
@endsection

