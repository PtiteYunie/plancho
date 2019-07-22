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

        /*
         *
         *
         * <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown button
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div>
        */

        for ($i = 1; $i <= $numberDays; $i++) {
            $date = $i . "-" . $this->month . "-" . $this->year;
            //Display first column
            $row .= "<tr><td>" . $date . "</td>";

            //Display others columns
            for ($j = 0; $j < count($users); $j++) {

                $row .= "<td onclick='' class='dropdown-toggle' data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
 
              <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                <a class=\"dropdown-item\" onclick=\"addRequest('J1'," . $users[$j]['id'] . "," . $date . ")\">J1</a>
                <a class=\"dropdown-item\" onclick=\"addRequest('J2'," . $users[$j]['id'] . "," . $date . ")\">J2</a>
                <a class=\"dropdown-item\" onclick=\"addRequest('N'," . $users[$j]['id'] . "," . $date . ")\">N</a>
                <a class=\"dropdown-item\" onclick=\"addRequest('Section', " . $users[$j]['id'] . "," . $date . ")\">Section</a>
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