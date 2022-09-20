@extends('layouts.app')
@section('content')
    <!-- import CSS -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <div class="page-hero page-container " id="page-hero">
                    <div class="padding d-flex">
                        <div class="page-title">
                            <small class="text-muted">
                                To send messages, first filter through your members then select scheduling options.
                                After that, click on
                                <button class="btn btn-primary btn-sm disabled">Send SMS</button>
                                button below:
                            </small>
                        </div>
                    </div>
                    <div class="page-content page-container" id="page-content">
                        <div class="padding m-t-40">
                            <form action="{{route('schedule')}}" method="post">
                                <div class="row">
                                    <h4><strong>Filter Members</strong></h4>
                                    <div class="col-md-12 m-b-20">
                                        <label for="" class="col-md-3">Group</label>
                                        <select class="selectpicker col-md-9" data-live-search="true" multiple
                                                name="groups[]">
                                            @foreach($groups as $group)
                                                <option data-tokens="ketchup mustard"
                                                        value="{{$group->id}}">{{$group->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-4 m-b-20">
                                        <label for="" class="col-md-3">Zone</label>
                                        <select class="selectpicker col-md-9" data-live-search="true"
                                                name="zones[]" multiple>
                                            <option value="">Select Zone</option>
                                            @foreach($zones as $zone)
                                                <option data-tokens="ketchup mustard"
                                                        value="{{$zone->id}}">{{$zone->zone_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{csrf_field()}}
                                    <div class="col-md-12 mt-4">
                                        <label for="" class="col-md-3">Gender</label>
                                        <select class="selectpicker col-md-9" data-live-search="true" multiple
                                                name="gender[]">
                                            <option data-tokens="ketchup mustard" value="Male">Male</option>
                                            <option data-tokens="ketchup mustard" value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-12 m-t-20">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group col-md-8">
                                                    <label for="messageField">Compose Message <span
                                                                class="text-warning text-sm">[15 characters are automatically added for opt out]</span></label>
                                                    <textarea name="message" id="messageField" rows="5" required
                                                              class="form-control "></textarea>
                                                    <div id="sms-counter" class="d-flex mt-2 text-sm">
                                                        <span><span class="length">0</span>/<span
                                                                    class="remaining">160</span> characters</span>
                                                        <span class="d-none d-md-block">&nbsp;&nbsp; Encoding:<span
                                                                    class="encoding">GSM_7BIT</span></span>
                                                        <span class="flex"></span>
                                                        <span>Per MSg:<span class="per_message">160</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                        <span><span class="messages">0</span>/6 sms</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row col-md-4">
                                                    <label for="">Custom Member Properties</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <select class="selectpicker col-md-9"
                                                                    onchange="addCustomProperty(this.value)"
                                                                    data-live-search="true">
                                                                <option value="">Select custom property below:</option>
                                                                @foreach($properties as $property)
                                                                    <option data-tokens="ketchup mustard"
                                                                            value="{{$property}}">
                                                                        {{$property}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row col-md-12">
                                                    <label class="col-sm-3 col-form-label">Time to Send</label>
                                                    <div class="mt-2 col-sm-9" id="event-type">
                                                        <div class="form-check form-check-inline"
                                                             onclick="toggleTime('now')">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input scheduler" type="radio"
                                                                       name="scheduled" value="no" checked=""> Send Now
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline"
                                                             onclick="toggleTime('later')">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input scheduler" type="radio"
                                                                       name="scheduled" value="yes"> Send Later
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="timePicker" class="form-group row row-sm hidden">
                                                    <label class="col-sm-3 col-form-label">Choose Time</label>
                                                    <div class="col-sm-5">
                                                        <input name="date" type="date" class="form-control"
                                                               placeholder="Date" value="">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input name="time" step="0" type="time" class="form-control"
                                                               placeholder="Time" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group py-3 col-md-12">
                                                    <button type="submit" name="action" value="send"
                                                            class="btn btn-primary">
                                                        Save Message
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleTime(val) {
            if (val === "now") {
                $("#timePicker").addClass('hidden')
            } else {
                $("#timePicker").removeClass('hidden')
            }
        }

        function addCustomProperty(val) {
            let text = $('#messageField').val();
            text += " {" + val + "}";
            $('#messageField').val(text);
        }
    </script>
@endsection