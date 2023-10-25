     <section class="text-white py-5 flex-grow-1">
        <div class="container py-4">
            <div class="row">
                <div class="col-12 px-5">

                <h1 class="display-4 text-center mb-5 text-uppercase">Saabuvate lendude haldus</h1>
                    <nav class="nav nav-pills flex-column flex-sm-row m-0 d-flex justify-content-between">
                    <button class='btn btn-light' type ='button'><a class="flex-sm-fill text-sm-center nav-link" href='?page=arrivals&lisamine=jah'>Sisesta uus lend</a></button>
                    <button class='btn btn-light' type ='button'><a class="flex-sm-fill text-sm-center nav-link" href='?page=arrivals&change_all_flights=1'>Määra kõigile 'Tühistatud'</a></button>
                    <button class='btn btn-light' type ='button'><a class="flex-sm-fill text-sm-center nav-link" href='?page=arrivals&change_all_flights=2'>Määra kõigile 'Hilineb'</a></button>
                    </nav>
                    <hr> 

                    <h1 class="display-4">Saabuvad lennud</h1>
                    <div class='table-responsive'>
                    <table class="table table-borderless table-sm text-muted">
                    <?php
                       
                        $kask = $yhendus ->prepare("SELECT id, arrivaltime, flightnumber, destination, airline, flightstatus FROM arrivals where arrivaltime >= CURDATE()-1 AND arrivaltime < CURDATE()+2 order by arrivaltime");
                        $kask->bind_result($id, $arrivaltime, $flightnumber, $destination, $airline, $flightstatus);
                        $kask->execute();
                        
                        function replace_status($flightstatus){
                            if($flightstatus == -1){return "";} //graafikus
                            if($flightstatus == 1){return "TÜHISTATUD";}
                            if($flightstatus == 2){return "Hilineb";}
                            if($flightstatus == 3){return "Maandus";}
                            if($flightstatus == 4){return "Saabus";}
                            return "Tundmatu staatus";
                            }
                                                                    
                        $lastdate='01.01.1900';
                        while($kask->fetch()){
                            $datetime = new DateTime($arrivaltime);
                            if($lastdate<>($datetime->format('d.m.Y'))) {  
                                echo '<tr class="date text-white">
                                    <th colspan="6">';
                                    echo $datetime->format('d.m.Y')."</th></tr>";
                                echo '
                                <tr>
                                    <th>Aeg</th>
                                    <th>Lennunumber</th>
                                    <th>Lähtekoht</th>
                                    <th>Lennufirma</th>
                                    <th>Lennustaatus</th>
                                    <th></th>
                                    <th></th>
                                </tr>';
                            }         
                        
                            $lastdate = $datetime->format('d.m.Y');
                            echo "
                            <tr>
                            <td>".($datetime->format('H:i'))."</td>
                            <td>$flightnumber</td>
                            <td>$destination</td>
                            <td>$airline</td>
                            <td>".replace_status($flightstatus)."</td>";

                            if ($flightstatus == -1 or  $flightstatus==2 or $flightstatus == 3) {
                                echo "
                                <td><a class='flex-sm-fill text-sm-center' href='?page=arrivals&update=$id'><button class='btn btn-dark'>Muuda staatust</button></a></td>
                                ";
                            }
                            if ($flightstatus == -1)
                           echo "
                           <td><a class='flex-sm-fill text-sm-center' href='?page=arrivals&delete_id=$id'><button class='btn btn-dark'>Kustuta</button></a></td>                       
                            </tr>";
                            };
                            ?>
                            </table>
                            </div>

                    <?php

                        if(isSet($_REQUEST["update"])){
                            $kask=$yhendus->prepare(
                            "SELECT id, airline, flightnumber, flightstatus
                            FROM arrivals WHERE id=?");
                            $kask->bind_param("i", $_REQUEST["update"]);
                            $kask->bind_result(
                            $id, $airline, $flightnumber, $flightstatus);
                            $kask->execute();
                            if($kask->fetch()){
                            
                            $airline=htmlspecialchars($airline);
                            echo "

                            <h4 class='mt-5 mb-3'>Lennu $flightnumber staatuse muutmine</h4>
                            <table class='flights text-muted'>
                            <tr>
                            <td>".($datetime->format('H:i'))."</td>
                            <td>$flightnumber</td>
                            <td>$destination</td>
                            <td>$airline</td>
                            </tr>
                            </table>
                            <form method='post' action='?' class='mt-3'>
                            <input type='hidden' name='update_id' value='$id' />
                            <input type='hidden' name='page' value='arrivals' />
                            <div class='mb-3'>
                            <label for='flightstatus'>Uus lennustaatus</label>
                                <select class='form-select w-50' id='flightstatus' name='flightstatus'>
                                    <option value='1'>Tühistatud</option>
                                    <option value='2'>Hilineb</option>
                                    <option value='3'>Maandus</option>
                                    <option value='4'>Saabus</option>
                                </select>
                                </div>

                            <button type='submit' class='btn btn-dark'>Rakenda muudatus</button>
                            </form>
                            ";
                        } 
                    }
                    else if(isSet($_REQUEST["lisamine"]))
                        {
                        ?>
                        <form method='post' action='?' class='w-50 my-5'>
                        <input type="hidden" name="page" value="arrivals" />
                        <input type="hidden" name="submit_arrival" value="jah" />
                        <h1 class="display-4">Uue lennu lisamine</h1>

                        <div class="mb-3">
                            <label for="arrivaltime" class="form-label">Aeg</label>
                            <input type="datetime-local" class="form-control" id="arrivaltime" name="arrivaltime" required>
                        </div>
                        <div class="mb-3">
                            <label for="airline" class="form-label">Lennufirma</label>
                            <select class="form-control" id="airline"  name='airline' onchange="showDestinations(this.value)">
                            <option value="">Vali lennufirma</option>
                                <?php
                                $kask=$yhendus->prepare("SELECT distinct a.airline FROM airlines a
                                INNER JOIN airline_destinations b ON a.id = b.airline_id");
                                $kask->bind_result($airline);
                                $kask->execute();
                                while($kask->fetch()){
                                    echo "<option value='".htmlspecialchars($airline)."'>".htmlspecialchars($airline)."</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="destination" class="form-label">Lähtekoht</label>
                            <select class="form-control" id="destination" name="destination" required>
                            <option value="">Vali lähtekoht</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="flightnumber" class="form-label">Lennunumber</label>
                            <input type="text" class="form-control" id="flightnumber" name="flightnumber" required>
                        </div>                  
                                        
                        <button type="submit" class="btn btn-dark" name="submit_arrival">Submit</button>
                        </form>
                        <script>
                            function showDestinations(str) {
                            if (str == "") {
                                document.getElementById("destination").innerHTML = "<option value=''>Vali lähtekoht</option>";
                                return;
                            } else {
                                if (window.XMLHttpRequest) {
                                    xmlhttp = new XMLHttpRequest();
                                } else {
                                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                }
                                xmlhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById("destination").innerHTML = this.responseText;
                                    }
                                };
                                xmlhttp.open("GET", "getdestinations.php?q=" + str, true);
                                xmlhttp.send();
                            }
                        }
                        </script>
 <?php
    }
    ?>
                     
    </div>
    </div>
    </section>

 <?php
$yhendus->close();
?>


