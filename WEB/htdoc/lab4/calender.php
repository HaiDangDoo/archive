<?php
    if(isset($_GET['month']) && isset($_GET['year'])){
        $month=intval($_GET['month']);
        $year=intval($_GET['year']);
    }else{
        $month=date('n');
        $year=date('Y');
    }
    $firstDayOfMonth=mktime(0,0,0,$month,1,$year);
    $dayInMonth=date("t",$firstDayOfMonth);
    $dayOfWeek=date("w",$firstDayOfMonth);
    $dayHTML="<tr>";

    for($i=0;$i<$dayOfWeek;$i++){
        $dayHTML.= "<td></td>";
    }
    for($day=1;$day<=$dayInMonth;$day++){
        $dayHTML.="<td value=$day>$day</td>";
        if( ($day+$dayOfWeek ) % 7===0){
            $dayHTML.="</tr><tr>";
        }
    }
    $remainingDays = (7 - (($dayInMonth + $dayOfWeek) % 7)) % 7;
    for ($i = 0; $i < $remainingDays; $i++) {
        $dayHTML .= "<td></td>";
    }
$res=[
    "dayHTML"=>$dayHTML."</tr>"
];
echo json_encode($res);
?>