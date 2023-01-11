@extends('layouts.main')

@section('content')
<div class="containar-lg" style="margin: 0 auto;">

<h2 class="text-center mt-2">Appointment</h2>

    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <th scope='col'>*</th>
                <th scope='col'>Department name</th>
                <th scope='col'>Appointment date</th>
                <th scope='col'>Token</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
            <tr>
                <th scope='row'>{{$appointment->id}}</th>
                <td>{{$appointment->department_name}}</td>
                <td>{{$appointment->appointment_date}}</td>
                @if ($appointment->taken)
                       <td>you can't book this now</td>
                @else
                <td>
                <form method="POST" action="{{route('bookappointment')}}">
                @csrf
                    <input type="text" style="display:none;" value="{{$appointment->id}}" name="appointment_id"/>
                    <input type="text" style="display:none;" value="{{$appointment->department_name}}" name="department_name"/>
                    <input type="text" style="display:none;" value="{{$appointment->appointment_date}}" name="appointment_date"/>


                    <input type="submit" value="book" class="btn btn-primary"/>
                </form>
                    </td>
                @endif

            </tr>


            @endforeach


        </tbody>
    </table>

</div>
</div>



@endsection
