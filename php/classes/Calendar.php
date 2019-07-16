<?php


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
        echo $numberDays;

        $row = "<table class=\"uk-table\">
                    <caption></caption>
                        <thead>
                            <tr>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            ";

        for ($i = 1; $i <= $numberDays; $i++) {
            $row .= "<tr><td>" . $i . "-" . $this->month . "-" . $this->year . "</td></tr>";
        }

        $row .= "</tbody>
        </table>";

        echo $row;
    }

}