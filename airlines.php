    <section class="text-white py-5">
        <div class="container">
            <div class="row justify-content-center gx-5">
                <div class="col-sm-6">
                    <h1 class="display-5 text-uppercase">Lennufirmad</h1>
                    <p class="fst-italic text-muted ">Lennufirma andmete nägemiseks või kustutamiseks vali lennufirma</p>
                    <div class="d-flex justify-content-end">
                        <button class='btn btn-light py-2' type ='button'><a href='?page=airlines&lisamine=jah'>Sisesta uus lennufirma</a></button>
                    </div>
                    <hr>
                </div>
        <div class="container overflow-hidden bg-light">
            <div class="row align-self-center text-center gx-5">
                <div class="col-sm-6 py-5">
                    <div class="row align-self-center text-center">
                        <?php
                        $kask=$yhendus->prepare("SELECT id, logo FROM airlines");
                        $kask->execute();
                        $kask->bind_result($id, $logo);
                        while($kask->fetch()){
                        $imageData = base64_encode(file_get_contents($logo));
                        echo '<a class="col-12 col-sm-6 my-4" href="?page=airlines&id='.$id.'"><img src="data:image/jpeg;base64,'.$imageData.'" style="max-width:200px; height:auto"></a>';
                        }
                        ?> 
                    </div>
                </div>

                <div class="col-sm-6 align-self-center text-center py-5">
                     
                        <?php
                        if(isSet($_REQUEST["id"])){
                        $kask=$yhendus->prepare("SELECT id, airline, logo, website, phonenumber FROM airlines
                        WHERE id=?");
                
                        $kask->bind_param("i", $_REQUEST["id"]);
                        $kask->execute();
                        $kask->store_result();
                        $kask->bind_result($id, $airline, $logo, $website, $phonenumber);
                        if($kask->fetch())
                        {
                        $imageData = base64_encode(file_get_contents($logo));
                        echo"<div class='py-5'>";
                        echo "<a href='?page=airlines&id=$id'>".'<img src="data:image/jpeg;base64,'.$imageData.'" style="max-width:200px; height:auto;;"><br>';
                        echo '<div class="align-self-center text-center p-3" h3 class="text-uppercase">'.htmlspecialchars($airline).'</h3><br>';
                        echo htmlspecialchars($website)."<br>";
                        echo htmlspecialchars($phonenumber)."<br>";
                        
                        ///lennufirma tühistamine, kui puuduvad saabumised ja väljumised baasis. 
                        $kask_delete=$yhendus->prepare("select sum(x.record_count) as total_count
                        from (
                        SELECT count(arrivaltime) as record_count
                        FROM arrivals a
                        INNER JOIN airlines b
                        ON a.airline = b.airline where b.id = ?
                        union all 
                        SELECT count(departuretime) as record_count
                        FROM departures c
                        INNER JOIN airlines d
                        ON c.airline = d.airline where d.id = ?
                        ) x");
                        $kask_delete->bind_param("ii", $id,$id);
                        $kask_delete->execute();
                        $kask_delete->store_result();
                        $kask_delete->bind_result($total_count);

                        if($kask_delete->fetch()){
                            if($total_count==0){
                            echo "<br/><a class='btn btn-dark py-2 my-3' href='?page=airlines&delete_airline_id=$id' role='button'>Kustuta lennufirma</a></div>";
                        }
                        }
                    }
                }

                    else if (isSet($_REQUEST["lisamine"]))
                    {
                    ?>
                    <div class="align-self-center border border-dark text-dark">
                        <form method='post' action='?' class='text-left my-5 mx-5'>
                        <input type="hidden" name="page" value="airlines" />
                        <input type="hidden" name="submit_airline" value="jah" />
                        <h4 class="text-muted py-3 text-uppercase">Uue lennufirma lisamine</h4>

                        <div class="mb-3">
                            <label for="airline" class="form-label">Lennufirma</label>
                            <input type="text" class="form-control" id="airline" name="airline" required>
                        </div>

                        <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input class="form-control" type="url" id="logo" name="logo" placeholder="url" required>
                        </div>

                        <div class="mb-3">
                            <label for="website" clss="form-label">Koduleht</label>
                            <input type="text" class="form-control" id="website" name="website" placeholder ="www" required>
                        </div>

                        <div class="mb-3">
                            <label for="phonenumber" class="form-label">Telefon</label>
                            <input type="text" class="form-control" id="phonenumber" name="phonenumber" required>
                        </div>                  
                                        
                        <button type="submit" class="btn btn-dark" name="submit_airline">Submit</button>
                        </form>
                    </div>
                    <?php
                     }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php
$yhendus->close();
?>

