<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>excel</title>

    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/bootstrap-theme.css">

    <script src="../../js/bootstrap.js"></script>
    <script src="../../js/jquery1.10.0.js"></script>

</head>
<body>

    <div class="container">
        <h3 class="text-center h3">数据下载中心</h3>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>创建人</th>
                    <th>文件</th>
                    <th>操作</th>
                </tr>
                </thead>


                <tbody>
                @foreach($list as $info)
                    <tr>
                        <td>{{$info['id']}}</td>
                        <td>{{$info['created_user_id']}}</td>
                        <td>{{$info['export_file_path']}}</td>
                        <td><a href="{{$info['export_file_path']}}">下载</a></td>
                    </tr>
                @endforeach


                </tbody>

            </table>
        </div>


    </div>
</body>

</html>
