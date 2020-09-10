<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>export</title>

    <script src="../../js/jquery1.10.0.js"></script>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/bootstrap-theme.css">
    <script src="../../js/bootstrap.js"></script>


</head>
<body>

<div class="container">
    <h3 class="text-center h3">用户列表</h3>

    <div>
        <form class="form-inline" action="/excel/userList">
            <div class="form-group">
                <label class="sr-only" for="minId">minId</label>
                <input type="text" value="{{$minId}}" class="form-control" id="minId" placeholder="minId">
            </div>
            -
            <div class="form-group">
                <label class="sr-only" for="maxId">MaxId</label>
                <input type="text" value="{{$maxId}}" class="form-control" id="maxId" placeholder="maxId">
            </div>

            <button type="submit" class="btn btn-default jsSearchBtn">搜索</button>
        </form>
    </div>
    <div class="table-responsive ">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>NickName</th>
                <th>Email</th>
            </tr>
            </thead>


            <tbody>
            @foreach($list as $info)
                <tr>
                    <td>{{$info['id']}}</td>
                    <td>{{$info['nickname']}}</td>
                    <td>{{$info['email']}}</td>
                </tr>
            </tbody>
            @endforeach

        </table>
    </div>


</div>


</body>

</html>