@extends('dashboard')

@section('content')
    <!-- Page Heading -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de cuentas</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Cuenta origen</th>
                                        <th>Cuenta destino</th>
                                        <th>Código de transacción</th>
                                        <th>Monto</th>
                                        <th>Fecha de creación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $value)
                                        @foreach ($value as $transaction)
                                            <tr>
                                                <td>{{ $transaction->origing_account }}</td>
                                                <td>{{ $transaction->destination_account }}</td>
                                                <td>{{ $transaction->code }}</td>
                                                <td>{{ $transaction->value }}</td>
                                                <td>{{ $transaction->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
