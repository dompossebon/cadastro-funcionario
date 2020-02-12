@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><h1>Detalhes - Funcionário</h1></div>
                <div class="card-body">
                    @isset($employee->employeephoto[0]['photo'])
                        <img src="{{ asset('storage/'.Str::after($employee->employeephoto[0]['photo'], 'public/')) }}"
                             alt="" width="300">
                    @else
                        Não Possui Foto
                    @endisset
                    <br/>
                    <br/>
                    <p><b>Nome:</b> {{ $employee->name }} </p>
                    <p><b>Email:</b> {{ $employee->email }} </p>
                    <p><b>Telefone:</b> {{ $employee->phone }} </p>
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
