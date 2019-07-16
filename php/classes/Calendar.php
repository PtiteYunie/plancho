<?php
require_once "classIncluder.php";

class Calendar
{
    private $month;
    private $year;
    private $days;

    public function __construct($m = null, $y = null)
    {
        $this->month = $m;
        $this->year = $y;
    }

    public function displayCalendar()
    {
        $numberDays = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);

        $users=User::getAllUsers();


        $row = "<table class=\"uk-table uk-table-divider\">
                    <caption></caption>
                        <thead>
                            <tr>
                                <th>Date</th>";

        foreach ($users as $user){
            $row.="<th>".$user['username']."</th>";
        }

        $row.="             </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            ";

        for ($i = 1; $i <= $numberDays; $i++) {
            //Display first column
            $row .= "<tr><td>" . $i . "-" . $this->month . "-" . $this->year . "</td></tr>";

            //Display others columns

        }

        $row .= "</tbody>
        </table>";

        echo $row;
    }



}