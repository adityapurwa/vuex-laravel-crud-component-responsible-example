<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta name="csrf-token" content="{{csrf_token()}}"/>
</head>
<body>

<main id="app">
    <div class="app-box">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">User Form</h3>
                        </div>
                        <div class="panel-body">
                            <user-form action-url="{{route('rest.user.index')}}"></user-form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <user-table action-url="{{route('rest.user.index')}}"></user-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="{{asset('js/app.js')}}"></script>

</body>
</html>