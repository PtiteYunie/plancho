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

        $users = User::getAllUsers();
        $vacations = Vacation::getAllVacations();

        $row = "<table class=\"uk-table uk-table-divider table-bordered uk-table-small uk-overflow-auto\">
                    <caption></caption>
                        <thead>
                            <tr>
                                <th>Date</th>";

        foreach ($users as $user) {
            $row .= "<th>" . $user['username'] . "</th>";
        }


        $row .= "             </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            ";

        for ($i = 1; $i <= $numberDays; $i++) {
            $date = $i . "-" . $this->month . "-" . $this->year;
            //Display first column
            $row .= "<tr><td>" . $date . "</td>";

            //Display others columns
            for ($j = 0; $j < count($users); $j++) {

                $row .= "<td onclick='' class='dropdown-toggle' data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">";
                foreach ($vacations as $vacation) {
                    $row .= "<a class=\"dropdown-item\" onclick=\"addRequest(" . $vacation['id'] . "," . $users[$j]['id'] . ",'" . $date . "')\">" . $vacation['label'] . "</a>";
                }

                $row .= "
                <div class=\"dropdown-divider\"></div>
                <a class=\"dropdown-item\" href=\"#\">Request</a>
              </div>
            </td>";
            }
            $row .= "</tr>";

        }

        $row .= "</tbody>
        </table>";

        echo $row;
    }


}