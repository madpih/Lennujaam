    <section class="text-white py-5 flex-grow-1">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-6 px-5 mb-5">
                    <h1 class="display-4 text-uppercase">Sihtkohad</h1>
                    <p class="fst-italic text-muted mb-5">Sihtkohta lendavate lennufirmade nägemiseks kliki sihtkohal, lennufirma info nägemiseks kliki seejärel lennufirma logol.</p>
                    <div class="row gy-5 justify-content-center">
                    <?php
                    $kask=$yhendus->prepare("SELECT id, destination FROM destinations");
                    $kask->execute();
                    $kask->store_result();
                    $kask->bind_result($id, $destination);
                    while($kask->fetch()){
                        // Modal
                        echo "<div class='col-6 col-sm-3 mx-3 text-center py-2'><a class='h3' href='?page=destinations&id=$id' data-toggle='modal' data-target='#destinationModal$id'>". htmlspecialchars($destination)."</a></div>";
                        echo "<div class='modal fade' id='destinationModal$id' tabindex='-1' role='dialog' aria-labelledby='destinationModalLabel' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header text-dark'>
                                        <h5 class='modal-title text-uppercase' id='destinationModalLabel$id'>$destination</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body text-dark'>
                                        
                                        <p>Sihtkohta ".htmlspecialchars($destination)." lendavad lennufirmad: </p>";
                                        
                                        $kask_airlines = $yhendus->prepare('SELECT distinct a.airline, a.logo, a.id as airline_id FROM airlines a INNER JOIN airline_destinations b ON a.id = b.airline_id where b.destination_id = ?');
                                        $kask_airlines->bind_param('i', $id);
                                        $kask_airlines->execute();
                                        $kask_airlines->store_result();
                                        if ($kask_airlines->num_rows > 0) {
                                        $kask_airlines->bind_result($airline, $logo, $airline_id);
                                        echo "<ul class='list-group'>";
                                        while ($kask_airlines->fetch()) {
                                            $imageData = base64_encode(file_get_contents($logo));
                                            echo "<li><a href='?page=airlines&id=$airline_id'>".'<img src="data:image/jpeg;base64,'.$imageData.'" style="max-width:200px; height:auto;;"></li>';
                                        }
                                        echo "</ul>";
                                    } else {
                                        echo "Siia sihtkohta ei lenda hetkel keegi.<br>";
                                        echo" <a class='btn btn-dark py-2 my-3' href='?page=destinations&delete_destination_id=$id' role='button'>Kustuta sihtkoht</a>";

                                    }
                                    $kask_airlines->close();
                                    echo "                                   
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Sulge</button>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }

                        ?>
                    </div>           
                </div> 

                <div class="col-lg-6 px-5 mb-5">
                    <h1 class="display-5">Sihtkohtade haldus</h1>
                    <h4 class="text-muted">Uue sihtkoha lisamine</h4>

                    <hr class="my-4">   

                    <form method='post' action='?'>
                        <input type="hidden" name="page" value="destinations" />
                        <input type="hidden" name="submit_destination"/>

                        <div class="mb-3">
                            <label for="destination" class="form-label">Sihtkoht</label>
                            <input type="text" class="form-control" id="destination" name="destination" required>
                        </div> 

                        <button type="submit" class="btn btn-light">Lisa sihtkoht</button>
                    </form>

                    <hr class="my-4"> 

                    <h4 class="text-muted">Sihtkoha lisamine lennufirmale</h4>
                    <form method='post' action='?'>
                        <input type="hidden" name="page" value="destinations" />
                        <input type="hidden" name="add_destination_to_airline">
                        <div class="mb-3">
                            <label for="airline" class="form-label">Lennufirma</label>
                            <select class="form-control" id="airline"  name='airline_id' required>
                            <option value="">Vali lennufirma</option>
                                <?php
                                $kask=$yhendus->prepare("SELECT id, airline FROM airlines");
                                $kask->bind_result($id, $airline);
                                $kask->execute();
                                while($kask->fetch()){
                                    echo '"<option>'.htmlspecialchars($airline).'</option>"';
                                    }
                                ?>
                            </select>
                        </div>  

                        <div class="mb-3">
                            <label for="airline_destination" class="form-label">Sihtkoht</label>
                            <select class="form-control" id="airline_destination" name='destination_id' required>
                            <option value="">Vali sihtkoht</option>
                                <?php
                                    $kask=$yhendus->prepare("SELECT id, destination FROM destinations");
                                    $kask->bind_result($id, $destination);
                                    $kask->execute();
                                    while($kask->fetch()){
                                        echo '"<option>'.htmlspecialchars($destination).'</option>"';
                                        }
                                    ?>
                            </select>
                        </div> 
                        <button type="submit" class="btn btn-light">Lisa sihtkoht lennufirmale</button>
                    </form>
                </div>
            </div>
        </div>
    </section> 