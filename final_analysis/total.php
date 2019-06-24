<?php
session_start();
include '../includes/db_conn.php';
$sem = $_SESSION["sem-select"];
$data = array();
$table_suffix = array("_before_rev", "");
$index_suffix = array("-rv", "");

for ($i=0; $i < 2; $i++) { 
    
    // Number of students passed without KT
    // male
    $total = array();
    $sql1 = 'select count(*) 
    from student_cgpa'.$table_suffix[$i].' c inner join students s
    on SUBSTR(c.seat_no, 2, LENGTH(c.seat_no) - 1) = s.seat_no
    where gpa <> "--" and c.seat_no like "'.$sem.'%" and s.gender <> "/";';
    $result = $conn->query($sql1);
    $result_array = $result->fetch(PDO::FETCH_NUM);
    $total["male"] = $result_array[0];

    // female
    $sql2 = 'select count(*) 
    from student_cgpa'.$table_suffix[$i].' c inner join students s
    on SUBSTR(c.seat_no, 2, LENGTH(c.seat_no) - 1) = s.seat_no
    where gpa <> "--" and c.seat_no like "'.$sem.'%" and s.gender = "/";';
    $result = $conn->query($sql2);
    $result_array = $result->fetch(PDO::FETCH_NUM);
    $total["female"] = $result_array[0];

    $data["total".$index_suffix[$i]] = $total;


    // Number of minority students passed without KT
    // male
    $minority = array();
    $sql3 = 'select count(*)
    from student_cgpa'.$table_suffix[$i].' c inner join students s 
    on SUBSTR(c.seat_no, 2, LENGTH(c.seat_no) - 1) = s.seat_no 
    where gpa <> "--" and c.seat_no like "'.$sem.'%" and s.Seat_Type = "MI" and s.gender <> "/";';
    $result = $conn->query($sql3);
    $result_array = $result->fetch(PDO::FETCH_NUM);
    $minority["male"] = $result_array[0];

    // female
    $sql4 = 'select count(*)
    from student_cgpa'.$table_suffix[$i].' c inner join students s 
    on SUBSTR(c.seat_no, 2, LENGTH(c.seat_no) - 1) = s.seat_no 
    where gpa <> "--" and c.seat_no like "'.$sem.'%" and s.Seat_Type = "MI" and s.gender = "/";';
    $result = $conn->query($sql4);
    $result_array = $result->fetch(PDO::FETCH_NUM);
    $minority["female"] = $result_array[0];

    $data["minority".$index_suffix[$i]] = $minority;

}
// Number of students getting grade point 10
// male
$grade_pt = array();
$sql5 = 'select count(*) 
from student_cgpa c inner join students s
on SUBSTR(c.seat_no, 2, LENGTH(c.seat_no) - 1) = s.seat_no
where gpa = 10 and c.seat_no like "'.$sem.'%" and s.gender <> "/";';
$result = $conn->query($sql5);
$result_array = $result->fetch(PDO::FETCH_NUM);
$grade_pt[0] = array();
$grade_pt[0]["male"] = $result_array[0];

// female
$sql6 = 'select count(*) 
from student_cgpa c inner join students s
on SUBSTR(c.seat_no, 2, LENGTH(c.seat_no) - 1) = s.seat_no
where gpa = 10 and c.seat_no like "'.$sem.'%" and s.gender = "/";';
$result = $conn->query($sql6);
$result_array = $result->fetch(PDO::FETCH_NUM);
$grade_pt[0]["female"] = $result_array[0];

// Number of students getting grade point between 9-10, 8-9...5-6
$pointers =  array(10, 9, 8, 7, 6, 5);
for ($i=0; $i < count($pointers)-1; $i++) { 
    $temp = array();
    $sql7 = 'select count(*) 
    from student_cgpa c inner join students s
    on SUBSTR(c.seat_no, 2, LENGTH(c.seat_no) - 1) = s.seat_no
    where gpa < '.$pointers[$i].' and gpa >= '.$pointers[$i+1].' and c.seat_no like "'.$sem.'%" and s.gender <> "/";';
    $result = $conn->query($sql7);
    $result_array = $result->fetch(PDO::FETCH_NUM);
    $temp["male"] = $result_array[0];

    $sql8 = 'select count(*) 
    from student_cgpa c inner join students s
    on SUBSTR(c.seat_no, 2, LENGTH(c.seat_no) - 1) = s.seat_no
    where gpa < '.$pointers[$i].' and gpa >= '.$pointers[$i+1].' and c.seat_no like "'.$sem.'%" and s.gender = "/";';
    $result = $conn->query($sql8);
    $result_array = $result->fetch(PDO::FETCH_NUM);
    $temp["female"] = $result_array[0];
    array_push($grade_pt, $temp);
}
$data["grade-point"] = $grade_pt;


// KT in theory subject
//male
$kt_count_male = array();
$sql9 = 'SELECT t.seat_no 
FROM student_theory_marks t inner join students s 
ON SUBSTR(t.seat_no, 2, LENGTH(t.seat_no) - 1) = s.seat_no 
WHERE t.total_theory_marks = "--" and t.seat_no LIKE "'.$sem.'%" and s.gender <> "/";';
$result = $conn->query($sql9);
$result_array = $result->fetchAll(PDO::FETCH_NUM);

for ($i=0; $i < count($result_array); $i++) { 
    if (!array_key_exists($result_array[$i][0], $kt_count_male))
        $kt_count_male[$result_array[$i][0]] = 0;
    $kt_count_male[$result_array[$i][0]]++;
}

//female
$kt_count_female = array();
$sql10 = 'SELECT t.seat_no 
FROM student_theory_marks t inner join students s 
ON SUBSTR(t.seat_no, 2, LENGTH(t.seat_no) - 1) = s.seat_no 
WHERE t.total_theory_marks = "--" and t.seat_no LIKE "'.$sem.'%" and s.gender = "/";';
$result = $conn->query($sql10);
$result_array = $result->fetchAll(PDO::FETCH_NUM);

for ($i=0; $i < count($result_array); $i++) { 
    if (!array_key_exists($result_array[$i][0], $kt_count_female))
        $kt_count_female[$result_array[$i][0]] = 0;
    $kt_count_female[$result_array[$i][0]]++;
}

$num_kt = array(
    array("male" => 0, "female" => 0),
    array("male" => 0, "female" => 0),
    array("male" => 0, "female" => 0),
    array("male" => 0, "female" => 0),
);

foreach ($kt_count_male as $seat_no => $count_kt) {
    $num_kt[$count_kt-1]["male"] += 1;
}
foreach ($kt_count_female as $seat_no => $count_kt) {
    $num_kt[$count_kt-1]["female"] += 1;
}
$data["kt"] = $num_kt;
echo json_encode($data);

?>