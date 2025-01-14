@extends('layouts.admin')

@section('content')

<h1>Plan Change Requests</h1>

<table id="planRequests" class="display" style="width:100%">
    <thead>
        <tr>
            <th>User</th>
            <th>Current Plan</th>
            <th>Requested Plan</th>
            <th>Status</th>
            <th>Requested At</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($planChangeRequests as $request)
        <tr>
            <td>{{ $request->user->name }}</td>
            <td>{{ $request->oldPlan->name ?? 'None' }}</td>
            <td>{{ $request->newPlan->name }}</td>
            <td>{{ ucfirst($request->status) }}</td>
            <td>{{ $request->created_at }}</td>
            <td style="width: 20%;text-align:right;">
                @if($request->status === 'pending')
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <form class="dropdown-item" method="POST" action="{{ route('plan-change-requests.approve', $request->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-link p-0"><i class="fas fa-check"></i> Approve</button>
                            </form>
                        </li>
                        <li>
                            <form class="dropdown-item" method="POST" action="{{ route('plan-change-requests.deny', $request->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-link p-0"><i class="fas fa-times"></i> Deny</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#planRequests').DataTable();
    });
</script>
@endsection
