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

    <!-- DateTimePicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <!-- DateTimePicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    </link>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    </link>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <title>เพิ่มพนักงาน</title>
</head>

<body>
    <div class="main-container">
        <div class="container">
            <div class="card">
                <form action="{{ route('add_employee') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <h3 class="card-title">แบบฟอร์มเพิ่มพนักงาน</h3>
                        <div class="form-row mb-3">
                            <div class="col-sm-12 col-md-2 mb-3">
                                <label>คำนำหน้า</label>
                                <select class="form-control" name="employee-prename">
                                    @foreach ($prename as $value)
                                    <option value="<?= (isset($employee_data['prename']) && $employee_data['prename'] == $value) ? $employee_data['prename'] : $value ?>"><?= (isset($employee_data['prename']) && $employee_data['prename'] == $value) ? $employee_data['prename'] : $value ?></option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-5 mb-3">
                                <label>ชื่อ</label>
                                <input type="text" class="form-control" name="employee-name" value="<?= (isset($employee_data['firstname']) ? $employee_data['firstname'] : "") ?>">
                            </div>
                            <div class="col-sm-12 col-md-5 mb-3">
                                <label>นามสกุล</label>
                                <input type="text" class="form-control" name="employee-surname" value="<?= (isset($employee_data['surname']) ? $employee_data['surname'] : "") ?>">
                            </div>
                        </div>
                        <label>เบอร์โทรศัพท์</label>
                        @if (!isset($telephone_data) || count($telephone_data) < 1) 
                        <div id="tel_no_box" class="form-row mb-3">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <input type="text" class="form-control" name="employee-tel[]" value="<?= (isset($telephone_data) ? $telephone_data[0] : "") ?>">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3 display-flex">
                            </div>
                        </div>
                        @else
                        @foreach($telephone_data as $key => $data)
                        <div id="tel_no_box" class="form-row mb-3">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <input type="text" class="form-control" name="employee-tel[]" value="<?= (isset($data) ? $data : "") ?>" maxlength="10">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3 display-flex">
                                @if($key != 0)
                                <button type="button" class="btn btn-danger delTel">ลบ</button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div class="form-row mb-3">
                            <div class="col-12 mb-3 text-center justify-center">
                                <button type="button" id="addTel" class="btn btn-primary">เพิ่มเบอร์โทรศัพท์</button>
                                <input hidden name="employee_id" type="text" value="<?= (isset($employee_data['id']) ? $employee_data['id'] : "") ?>"></input>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12 col-md-6">
                                <label>เวลาเริ่มงาน</label>
                                <div class="input-group date mb-3" id="starttimePicker">
                                    <input type="text" class="form-control timePicker" name="employee-starttime" value="<?= (isset($employee_data['start_worktime']) ? $employee_data['start_worktime'] : "") ?>">
                                    <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label>เวลาเลิกงาน</label>
                                <div class="input-group date mb-3" id="endtimePicker">
                                    <input type="text" class="form-control timePicker" name="employee-endtime" value="<?= (isset($employee_data['end_worktime']) ? $employee_data['end_worktime'] : "") ?>">
                                    <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                <a href="{{route('employeelist')}}">
                                    <button type="button" class="btn btn-danger">ย้อนกลับ</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $('#starttimePicker').datetimepicker({
        format: "HH:mm"
    });
    $('#endtimePicker').datetimepicker({
        format: "HH:mm"
    });

    $('#addTel').click(function() {
        const telnumber_input =
            `
        <div class="col-sm-12 col-md-6 mb-3">
            <input type="text" class="form-control" name="employee-tel[]">
        </div>
        <div class="col-sm-12 col-md-6 mb-3 display-flex">
            <button type="button" class="btn btn-danger delTel">ลบ</button>
        </div>
        `

        $("#tel_no_box").append(telnumber_input)
    });

    $(document).on("click", ".delTel", function() {
        $(this).parent().prev().remove()
        $(this).parent().remove()
    });
</script>