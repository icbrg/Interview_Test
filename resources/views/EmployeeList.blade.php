<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="/app.css">

    <!-- BootStrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <title>รายชื่อพนักงาน</title>
</head>

<body>
    <div class="main-container">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row card-title">
                        <div class="col-md-6 col-12 list-header">
                            <h5>รายชื่อพนักงาน</h5>
                        </div>
                        <div class="col-12 col-md-6 list-btn">
                            <a href="{{route('register_employee')}}">
                                <button type="button" class="btn btn-primary float-right">เพิ่มพนักงาน</button>
                            </a>
                        </div>
                    </div>
                    <div class="table-scroller">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">ชื่อ-นามสกุล</th>
                                    <th scope="col">เบอร์โทรศัพท์</th>
                                    <th scope="col">เวลาทำการ</th>
                                    <th scope="col">การจัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($employee))
                                @foreach ($employee as $key => $value)
                                <tr>
                                    <td scope="row">{{$value['id']}}</td>
                                    <td>{{$value['prename']}} {{$value['firstname']}} {{$value['surname']}}</td>
                                    <td>
                                        @foreach ($value['all_phonenumber'] as $tel_no)
                                        <p>{{$tel_no}}</p>
                                        @endforeach
                                    </td>
                                    <td>{{$value['new_starttime']}}-{{$value['new_endtime']}}</td>
                                    <td>
                                        <a href="{{url('edit'.'/'.$value['id'])}}"><button type="button" class="btn btn-outline-primary btn-sm">แก้ไข</button></a>
                                        <a href="{{url('delete'.'/'.$value['id'])}}"><button type="button" class="btn btn-outline-danger btn-sm">ลบ</button></a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>