                            <?php
                            require_once "connect.php";
                            $connect = new mysqli($host, $db_user, $db_pass, $db_name);
                            $idcar = $_POST['idcar'];
                            $datado = $_POST['datado'];
                            $dataod = $_POST['dataod'];
                            $diff = date_diff(date_create($dataod), date_create($datado));
                            $days = $diff->format('%a');
                            $days = intval($days) + 1;
                            $arr = array_fill(0, 32, 0);
                            $sql = "SELECT data_start, ile_dni FROM reservation where idcar = $idcar and (data_start between'" . date('Y-m-1') . "' and '" . date('Y-m-31') . "')";
                            $result = mysqli_query($connect, $sql);
                            while ($pole = $result->fetch_assoc()) {
                              $date = strtotime($pole['data_start']);
                              $day = idate('d', $date);
                              $ile = $pole['ile_dni'];
                              for ($i = 0; $i < $ile; $i++) {
                                $arr[$day + $i] = 1;
                              }
                            }
                            $datefrom = strtotime($_POST['dataod']);
                            $dayfrom = idate('d', $datefrom);
                            $dateto = strtotime($_POST['datado']);
                            $dayto = idate('d', $dateto);
                            $clear = true;
                            for ($i = $dayfrom; $i <= $dayto; $i++) {
                              if ($arr[$i] == 1) {
                                $clear = false; //Zmienna walidacyjna czy samochóch wolny(true = wolny tj można rezerwować)
                              }
                            }
                            if($clear == true){
                                echo "Samochód dostępny";
                            }
                            else{
                                echo "Samochód zajęty";
                            }
                            $connect->close();
                              ?>