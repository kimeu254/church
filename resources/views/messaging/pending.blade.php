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
                        <th>Send Time</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $message)
                        <tr>
                            <th scope="row">
                                {{$message->id}}
                            </th>
                            <td>{{app(\App\Transformers\Messages\MessageTransformer::class)->transform($message->recipient,$message->message->message_content)}}</td>
                            <td>SOLUTECH</td>
                            <td>{{strlen(app(\App\Transformers\Messages\MessageTransformer::class)->transform($message->recipient,$message->message->message_content))}}</td>
                            <td><span class="bg-warning p-2">Pending</span></td>
                            <td><span class="bg-warning p-2">Pending</span></td>
                            <td>{{\Carbon\Carbon::parse($message->message->send_at)->diffForHumans()}}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="deleteMessage('{{$message->id}}')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
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

        function deleteMessage(id) {
            let messageId = id
            Swal.fire({
                title: 'Are you sure you want to delete this message?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    // do ajax to remove the message....
                    location.href = "{{url('/delete-message/')}}" + '/' + messageId;
                }
            })
        }
    </script>
@endsection