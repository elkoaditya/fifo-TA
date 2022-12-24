@if (\Session::has('alert'))
    @php
        $status = json_decode(\Session::get('alert'));
    @endphp
    @if($status->status == 'error')
        <div class="alert alert-danger" role="alert">
            <div class="alert-body">{{$status->message}}</div>
        </div>
    @elseif($status->status == 'warning')
        <div class="alert alert-warning" role="alert">
            <div class="alert-body">{{$status->message}}</div>
        </div>
    @elseif($status->status == 'success')
        <div class="alert alert-success" role="alert">
            <div class="alert-body">{{$status->message}}</div>
        </div>
    @endif
@endif
