@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @elseif(session()->has('danger'))
                    <div class="alert alert-danger">
                        {{ session()->get('danger') }}
                    </div>
                @endif
                <h1>LISTAGEM GERAL DE FUNCIONÁRIOS</h1>
            </div>
            <div class="card-body-all-row">
                @foreach($employees as $employee)
                    <div class="card-body-all-colunas">
                        @isset($employee->employeephoto[0]['photo'])
                            <img class="card-body-image"
                                 src="{{ asset('storage/'.Str::after($employee->employeephoto[0]['photo'], 'public/')) }}"
                                 alt="Foto do Funcionário">
                        @else
                            Não Possui Foto
                        @endisset
                    </div>
                    <div class="card-body-all-colunas">
                        {{ $employee->name }}
                    </div>
                    <div class="card-body-all-colunas">
                        <a href="{{ route('employeeListDetail', $employee->id) }}">Visualizar Detalhes</a>
                    </div>
                    <div class="card-body-all-colunas">
                        @guest
                        @else
                            <a href="{{ route('employeeEdit', $employee->id) }}">Editar</a>
                        @endguest
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
