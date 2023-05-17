<h2>Auta zablokowane do usunięcia gdy ilość rezerwacji = 0</h2>
<table class='table'>
              <thead>
                <tr>
                  <th scope='col'>Model</th>
                  <th scope='col'>Marka</th>
                  <th scope='col'>Nr. Rejestracyjny</th>
                  <th scope='col'>Pozostałe rezerwacje</th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once "connect.php";
                $connect = new mysqli($host, $db_user, $db_pass, $db_name);
                $sql = "SELECT c.marka, c.model, c.nrrejestracyjny, count(r.idreservation) as dni FROM car as c INNER JOIN reservation as r ON c.idcar=r.idcar WHERE c.visible = 0 GROUP BY c.idcar";
                $result = mysqli_query($connect, $sql);
                //while ($pole = $result->fetch_row()) {
                while ($pole = $result->fetch_assoc()) {
                    echo "
                        <tr>
                        <td id='markawys'>{$pole['marka']}</td>
                        <td id='modelwys'>{$pole['model']}</td>
                        <td id='dataodwys'>{$pole['nrrejestracyjny']}</td>
                        <td id='datadowys'>{$pole['dni']}</td>";
                  }
                $connect->close();
                ?>
              </tbody>
            </table>