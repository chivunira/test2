@extends('layouts.master')

@section('content')
<!DOCTPE html>
<html>
<head>
<title>View All Rejected Leaves</title>
</head>
<body>

<div class="container-fluid px-4">

<div class="card-header">
<h1>ALL REJECTED LEAVE APPLICATIONS</h1>
</div>

<div class="card-body">
<table border = "2" class="table table-striped table-bordered ">
<tr>
<td>User ID</td>
<td>Email</td>
<td>Leave type</td>
<td>From Date</td>
<td>To Date</td>
<td>Description</td>
<td>Status</td>
<td>Admin Remarks</td>
<td>Number Of Days taken</td>
</tr>
@foreach ($users as $user)
<tr>
<td>{{ $user->user_id }}</td>
<td>{{ $user->email }}</td>
<td>{{ $user->leavetype }}</td>
<td>{{ $user->from_date }}</td>
<td>{{ $user->to_date }}</td>
<td>{{ $user->description }}</td>
<td>{{ $user->status }}</td>
<td>{{ $user->adminRemarks }}</td>
<td>{{ $user->numDays }}</td>
</tr>
@endforeach
</table>
</div>
</div>

</body>
</html>
@endsection