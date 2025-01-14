@extends('layouts.admin')

@section('content')
<h1>User Plans Management</h1>

<table id="userPlans" class="display" style="width:100%">
    <thead>
        <tr>
            <th>User</th>
            <th>Current Plan</th>
            <th>Plan Start Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
            <td>{{ $user->plan->first()->name ?? 'No Plan' }}</td>
            <td>{{ $user->plan->first()->pivot->start_date ?? 'N/A' }}</td>
            <td>
                @if($user->plan->first())
                <form method="POST" action="{{ route('user-plans.revoke', $user->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to revoke this plan?')">
                        <i class="fas fa-ban"></i> Revoke Plan
                    </button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#userPlans').DataTable();
    });
</script>
@endsection