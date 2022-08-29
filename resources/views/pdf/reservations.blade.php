<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

 
    <title>Reservations PDF</title>
</head>
<body>
    <h1>Reservations</h1>
    <table style="text-align: center">
        <tr>
          <th>Reservation ID</th>
          <th>Created at</th>
          <th>Updated at</th>
          <th>First name</th>
          <th>Last name</th>
          <th>User phone</th>
          <th>Reservation confirmation</th>
          <th>Performance ID</th>
        </tr>
        @foreach ($reservations as $r)
            <tr>
                <td>{{ $r->res_id }}</td>
                <td>{{ $r->created_at }}</td>
                <td>{{ $r->updated_at }}</td>
                <td>{{ $r->first_name }}</td>
                <td>{{ $r->last_name }}</td>
                <td>{{ $r->user_phone }}</td>
                <td>{{ $r->reservation_confirmation }}</td>
                <td>{{ $r->performance_id }}</td>
            </tr>
        @endforeach
        
      </table>
      
</body>
</html>