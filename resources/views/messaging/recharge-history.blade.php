@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table id="table" class="table  table-striped" cellspacing="0" width="100%">
                    <thead class="thead-default" style="text-transform: uppercase;">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Transaction Code</th>
                        <th>Phone Number</th>
                        <th>Amount</th>
                        <th>Units</th>
                        <th>TAT</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td scope="row">
                                {{$log->created_at}}
                            </td>
                            <td>
                                @if(!empty($log->transaction))
                                    @php
                                        $body = json_decode($log->transaction->checkout_request_body);
                                        $trans =  $body->Body->stkCallback->CallbackMetadata->Item[1];
                                        echo $trans->Value;
                                    @endphp
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if(!empty($log->transaction))
                                    @php
                                        $body = json_decode($log->transaction->checkout_request_body);
                                        $trans =  $body->Body->stkCallback->CallbackMetadata->Item[4];
                                        echo $trans->Value;
                                    @endphp
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                {{$log->amount}}
                            </td>
                            <td>{{$log->units}}</td>
                            <td>{{\Carbon\Carbon::parse($log->created_at)->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#table').DataTable();
        });
    </script>
@endsection