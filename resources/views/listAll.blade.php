@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @elseif(session()->has('danger'))
                            <div class="alert alert-danger">
                                {{ session()->get('danger') }}
                            </div>
                        @endif
                    <h1>LISTAGEM GERAL DE FUNCIONÁRIOS<h1>
                </div>
                <div class="card-body">
                    <div class="form-ṕadrao">
                        @foreach($employees as $employee)
                            <p>

                                @isset($employee->employeephoto[0]['photo'])
                                    <img
                                        src="{{ asset('storage/'.Str::after($employee->employeephoto[0]['photo'], 'public/')) }}"
                                        alt="" width="50">
                                @else
                                    Não Possui Foto
                                @endisset
                                => {{ $employee->name }}
                                || <a href="{{ route('employeeListDetail', $employee->id) }}">Visualizar Detalhes</a>
                                @guest
                                @else
                                    || <a href="{{ route('employeeEdit', $employee->id) }}">Editar</a>
                                @endguest
                            </p>
                            <br/>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
