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
        $numberDays = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year); //number of days in a month

        //Get all users formated for table head
        $users = User::getAllUsers();
        $usersFormated = '';
        foreach ($users as $user) {
            $usersFormated .= "<th>" . $user['username'] . "</th>";
        }

        $vacations = Vacation::getAllVacations();

        //Get all Requests from users in a month
        $dateStart = $this->year . "-" . $this->month . "-1";
        $dateEnd = $this->year . "-" . $this->month . "-" . date('t', $this->month);
        $requests = Request::getAllRequestsByDate($dateStart, $dateEnd);

        $row = "<table class=\"uk-table uk-table-divider table-bordered uk-table-small uk-overflow-auto\">
                    <caption></caption>
                        <thead>
                            <tr>
                                <th>Date</th>";

        $row .= $usersFormated;

        $row .= "             </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Date</th>";

        $row .= $usersFormated;

        $row .= "            </tr>
                        </tfoot>
                        <tbody>
                            ";

        //Display the table body line by line
        for ($i = 1; $i <= $numberDays; $i++) {
            $date = date_create($i . "-" . $this->month . "-" . $this->year);

            //Display first cell
            $row .= "<tr><td>" . $date->format('j-m-Y') . "</td>";

            //Display other cells
            for ($j = 0; $j < count($users); $j++) {
                $class = ' ';
                if ($users[$j]['id'] == $_SESSION['id'] || $_SESSION['isAdm'] === '1') {
                    $class = 'dropdown-toggle';
                }
                $row .= "<td class='dropdown'><div class='" . $class . "' data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";

                $row .= $this->requestDay($requests, $date, $users[$j]['id']);

                $row .= "<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">";

                foreach ($vacations as $vacation) { //Create dropwdown menu with vacation + user id + date
                    $row .= "<a class=\"dropdown-item\" onclick=\"addRequest(" . $vacation['id'] . "," . $users[$j]['id'] . ",'" . $date->format('Y-m-d') . "')\">" . $vacation['label'] . "</a>";
                }
                $row .= "</div>";


                $row .= "
                    </div>
                </td>";
            }
            $row .= "</tr>";

        }

        $row .= "</tbody>
        </table>";

        echo $row;
    }

    public function displayGeneratedCalendar()
    {
        $numberDays = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);

        $users = User::getAllUsers();

        $row = "<table class=\"uk-table uk-table-divider table-bordered uk-table-small uk-overflow-auto\">
                    <caption></caption>
                        <thead>
                            <tr>
                                <th>Date</th>";

        foreach ($users as $user) {
            $row .= "<th id='" . $user['id'] . "'>" . $user['username'] . "</th>";
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
            $date = date_create($i . "-" . $this->month . "-" . $this->year);


            //Display first column
            $row .= "<tr><td>" . $date->format('j-m-Y') . "</td>";

            //Display others columns
            for ($j = 0; $j < count($users); $j++) {
                $row .= "<td id=" . $j . "_" . $i . " onclick='getVacation(\"" . $date . "\", \"" . $j . "_" . $i . "\")'>
            <script type='text/javascript'>getVacation(\"" . $date . "\", \"" . $j . "_" . $i . "\")</script>
            </td>";
            }
            $row .= "</tr>";

        }

        $row .= "
        </tbody>
        </table>";

        echo $row;
    }

    private function requestDay($requests, $date, $user)
    { //Return formated request who correspond to the date and the day
        $formatedRequests = '';
        foreach ($requests as $request) {
            if ($request['date'] == $date->format('Y-m-d') && $request['idUser'] == $user) {//Display the vacation
                $infoVac = Vacation::getVacationById($request['idVac']);
                $vacation = new Vacation($request['idVac'], $infoVac['label'], $infoVac['name']);

                $formatedRequests .= "<div>" . $vacation->getLabel() . "</div>";
            }
        }
        if (strlen($formatedRequests) > 0) {
            return $formatedRequests;
        }

        return "<div></div>";
    }

    public function test()
    {
        //Get all Requests from users in a month
        $dateStart = $this->year . "-" . $this->month . "-1";
        $dateEnd = $this->year . "-" . $this->month . "-" . date('t', $this->month);
        $requests = Request::getAllRequestsByDate($dateStart, $dateEnd);
        return $requests;

    }

}
