@extends('adminlte::page')

@section('title', 'Usuarios CRM')

@section('content_header')
    <h1>Usuarios del CRM</h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="ct-section-header mb-3">
        <h2 class="ct-section-title">Gestión de usuarios</h2>
        <div class="d-flex align-items-center" style="gap: 10px;">
            <div class="ct-muted">Solo superadmin</div>
            <form action="{{ route('usuarios.sync') }}" method="POST">
                @csrf
                <button class="btn btn-ct-secondary" onclick="return confirm('Esto creará usuarios para trabajadores con email. Rol por defecto: usuario. ¿Continuar?')">
                    <i class="fas fa-sync-alt ct-btn-icon" aria-hidden="true"></i>Sincronizar trabajadores
                </button>
            </form>
        </div>
    </div>

    <div class="ct-card p-0">
        <table class="table table-hover mb-0 ct-table ct-users-table">
            <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Ficha</th>
                    <th style="width: 240px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $u)
                    @php($photoUrl = $u->profilePhotoUrl())
                    @php($t = $u->trabajador)
                    <tr>
                        <td class="align-middle">{{ $u->id }}</td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                @if($photoUrl)
                                    <img src="{{ $photoUrl }}" alt="Foto" class="ct-profile-photo" style="width: 38px; height: 38px; margin-right: 10px;">
                                @else
                                    <div class="ct-profile-photo ct-profile-photo--placeholder" style="width: 38px; height: 38px; margin-right: 10px; font-size: 16px;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold">{{ $u->name }}</div>
                                    <div class="ct-muted" style="font-size: 0.9rem;">{{ $u->created_at?->format('d/m/Y') ?? '' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">{{ $u->email }}</td>
                        <td class="align-middle">
                            <div class="d-flex flex-column" style="gap: 8px;">
                                <div>
                                    @if($t)
                                        <span class="ct-pill ct-pill-success">Vinculado</span>
                                    @else
                                        <span class="ct-pill">Sin ficha</span>
                                    @endif
                                    @if($u->role === 'superadmin')
                                        <span class="ct-pill ct-pill-ct">superadmin</span>
                                    @elseif($u->role === 'admin')
                                        <span class="ct-pill ct-pill-warning">admin</span>
                                    @else
                                        <span class="ct-pill ct-pill-ct">usuario</span>
                                    @endif
                                </div>

                                @if($t)
                                    <div class="d-flex flex-wrap" style="gap: 8px;">
                                        <span class="ct-pill ct-pill-ct"><i class="fas fa-briefcase"></i> {{ $t->puesto }}</span>
                                        <span class="ct-pill ct-pill-ct"><i class="fas fa-euro-sign"></i> {{ $t->salario_hora }} €/h</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="ct-users-actions">
                                <form action="{{ route('usuarios.role', $u) }}" method="POST" class="ct-users-actions__role">
                                    @csrf
                                    @method('PUT')

                                    <select name="role" class="form-control ct-select" {{ ($u->role === 'superadmin' || auth()->id() === $u->id) ? 'disabled' : '' }}>
                                        <option value="usuario" {{ $u->role === 'usuario' ? 'selected' : '' }}>usuario</option>
                                        <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>admin</option>
                                    </select>

                                    <button class="btn btn-ct-primary ct-btn-icon-only"
                                            type="submit"
                                            title="Guardar rol"
                                            aria-label="Guardar rol"
                                            {{ ($u->role === 'superadmin' || auth()->id() === $u->id) ? 'disabled' : '' }}>
                                        <i class="fas fa-save" aria-hidden="true"></i>
                                    </button>
                                </form>

                                <div class="ct-users-actions__row">
                                    @if(auth()->id() !== $u->id && auth()->user()->can('delete', $u))
                                        <form action="{{ route('usuarios.destroy', $u) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-ct-danger ct-btn-icon-only"
                                                type="submit"
                                                title="Borrar"
                                                aria-label="Borrar"
                                                onclick="return confirm('¿Eliminar usuario?')">
                                            <i class="fas fa-trash" aria-hidden="true"></i>
                                        </button>
                                        </form>
                                    @else
                                        <button class="btn btn-ct-secondary" disabled>No borrable</button>
                                    @endif

                                    @if($t)
                                        <a href="{{ route('trabajadores.edit', $t) }}"
                                           class="btn btn-ct-secondary ct-btn-icon-only"
                                           title="Editar trabajador"
                                           aria-label="Editar trabajador">
                                            <i class="fas fa-pen" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $usuarios->links('vendor.pagination.default') }}
    </div>

    <div class="ct-section-header mt-5 mb-3">
        <h2 class="ct-section-title">Trabajadores sin usuario</h2>
        <div class="ct-muted">Crea su acceso al CRM (rol por defecto: usuario)</div>
    </div>

    <div class="ct-card p-0">
        <table class="table table-hover mb-0 ct-table">
            <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Trabajador</th>
                    <th>Email</th>
                    <th>Puesto</th>
                    <th style="width: 140px;">€/h</th>
                    <th style="width: 180px;">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trabajadoresSinUsuario as $t)
                    <tr>
                        <td class="align-middle">{{ $t->id }}</td>
                        <td class="align-middle">
                            <div class="fw-bold">{{ $t->nombre }} {{ $t->apellido }}</div>
                            <div class="ct-muted" style="font-size: 0.9rem;">DNI: {{ $t->dni }}</div>
                        </td>
                        <td class="align-middle">{{ $t->email }}</td>
                        <td class="align-middle">
                            <span class="ct-pill ct-pill-ct"><i class="fas fa-briefcase"></i> {{ $t->puesto }}</span>
                        </td>
                        <td class="align-middle">
                            <span class="ct-pill ct-pill-ct"><i class="fas fa-euro-sign"></i> {{ $t->salario_hora }} €/h</span>
                        </td>
                        <td class="align-middle">
                            <form action="{{ route('usuarios.fromTrabajador', $t) }}" method="POST">
                                @csrf
                                <button class="btn btn-ct-success" onclick="return confirm('¿Crear usuario para este trabajador? (rol: usuario)')"><i class="fas fa-plus ct-btn-icon" aria-hidden="true"></i>Crear</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="ct-muted">No hay trabajadores pendientes de usuario.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
