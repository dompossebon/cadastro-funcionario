@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h1>Detalhes - Funcionário</h1></div>
            <div class="card-body detail">
                    <div class="rowmy">
                        <div class="col">
                            @isset($employee->employeephoto[0]['photo'])
                                <img
                                    src="{{ asset('storage/'.Str::after($employee->employeephoto[0]['photo'], 'public/')) }}"
                                    alt="" width="300">
                            @else
                                Não Possui Foto
                            @endisset
                        </div>
                        <div class="col">
                            <p><b>Nome:</b> {{ $employee->name }} </p>
                            <p><b>Email:</b> {{ $employee->email }} </p>
                            <p><b>Telefone:</b> {{ $employee->phone }} </p>
                        </div>
                    </div>
                <div align="center">
                    @guest
                    @else
                        <form action="{{ route('employeeDestroy', $employee->id) }}" method="post">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit"
                                    onclick="return confirm('Tem certeza que deseja Remover este Funcionario??')">
                                Apagar Ficha do Funcionário
                            </button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection
