@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table id="table" class="table  table-striped" cellspacing="0" width="100%">
                    <thead class="thead-default" style="text-transform: uppercase;">
                    <tr>
                        <th>ID</th>
                        <th>Message</th>
                        <th>Sender</th>
                        <th>Length</th>
                        <th>Status</th>
                        <th>Network</th>
                        <th>Cost</th>
                        <th>Sent On</th>
                        <th>TAT</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <th scope="row">
                                {{$log->message_id}}
                            </th>
                            <td>
                                <span class="text-info">{{$log->sent_to}}</span><br/>
                                {{$log->message}}
                            </td>
                            <td>{{$log->sender}}</td>
                            <td>{{strlen($log->message)}}</td>
                            <td>
                                @if($log->response_desc=='Success')
                                    <span class="badge badge-success">
                                        {{$log->response_desc}}
                                    </span>
                                @else
                                    <span class="badge badge-warning">
                                        {{$log->response_desc}}
                                    </span>
                                @endif
                            </td>
                            <td>{{$log->network->name}}</td>
                            <td>{{$log->cost}}</td>
                            <td>{{$log->created_at}}</td>
                            <td>{{\Carbon\Carbon::parse($log->sent_at)->diffForHumans()}}</td>
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