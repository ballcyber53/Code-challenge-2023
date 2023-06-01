<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Created</title>
</head>

<body>
    <h1>Company Created</h1>

    <p>Dear {{ $company->name }},</p>

    <p>Your company has been successfully created. Here are the details:</p>

    <table>
        <tr>
            <td>Name:</td>
            <td>{{ $company->name }}</td>
        </tr>
        <tr>
            <td>Address:</td>
            <td>{{ $company->address }}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>{{ $company->email }}</td>
        </tr>
        <tr>
            <td>Logo:</td>
            <td><img src="{{ asset('storage/logos/' . $company->logo) }}" width="200" height="200" alt="Company Logo">
            </td>
        </tr>
        <tr>
            <td>Website:</td>
            <td><a href="{{ $company->website }}">{{ $company->website }}</a></td>
        </tr>
    </table>

    <p>Thank you for choosing our platform!</p>

    <p>Best regards,</p>
    <p>{{ config('app.name') }}</p>
</body>

</html>
