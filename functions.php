<?php

function clean($userInput){
    return htmlspecialchars($userInput);
}

//uue lennu lisamine
if(isSet($_REQUEST["submit_arrival"])){
$kask=$yhendus->prepare(
"INSERT INTO arrivals(arrivaltime, flightnumber, destination, airline) VALUES (?, ?, ?, ?)");
$kask->bind_param("ssss", $_REQUEST["arrivaltime"], $_REQUEST["flightnumber"],$_REQUEST["destination"], $_REQUEST["airline"]);
$kask->execute();
$yhendus->close();
header("Location: $_SERVER[PHP_SELF]?page=$_REQUEST[page]"); 
exit();

}
//uue lennu lisamine
if(isSet($_REQUEST["submit_departure"])){
    $kask=$yhendus->prepare(
    "INSERT INTO departures(departuretime, flightnumber, destination, airline) VALUES (?, ?, ?, ?)");
    $kask->bind_param("ssss", $_REQUEST["departuretime"], $_REQUEST["flightnumber"],$_REQUEST["destination"], $_REQUEST["airline"]);
    $kask->execute();
    $yhendus->close();
    header("Location: $_SERVER[PHP_SELF]?page=$_REQUEST[page]"); 
    exit();
    
    }
    //uue lennufirma lisamine
    if(isSet($_REQUEST["submit_airline"])){
    
    $kask=$yhendus->prepare(
    "INSERT INTO airlines(airline, logo, website, phonenumber) VALUES (?, ?, ?, ?)");
    $kask->bind_param("ssss", $_REQUEST["airline"], $_REQUEST["logo"],$_REQUEST["website"], $_REQUEST["phonenumber"]);
    $kask->execute();
    $yhendus->close();
    header("Location: $_SERVER[PHP_SELF]?page=$_REQUEST[page]"); 
    exit();
    
    }

    //uue sihtkoha lisamine
    if(isSet($_REQUEST["submit_destination"])){
    $kask=$yhendus->prepare(
    "INSERT INTO destinations(destination) VALUES (?)");
    $kask->bind_param("s", $_REQUEST["destination"]);
    $kask->execute();
    $yhendus->close();
    header("Location: $_SERVER[PHP_SELF]?page=$_REQUEST[page]"); 
    exit();
    
    }

    //sihtkoha lisamine lennufirmale olemasolevate sihtkohtade seast, uue seostabeli loomine
    if(isSet($_REQUEST["add_destination_to_airline"])){
        $kask=$yhendus->prepare(
        "INSERT INTO airline_destinations (destination_id, airline_id) values ((SELECT id from destinations where destination=?)
            , (SELECT id from airlines where airline =?))");
        $kask->bind_param("ss", $_REQUEST["destination_id"], $_REQUEST["airline_id"]);
        $kask->execute();
        $yhendus->close();
        header("Location: $_SERVER[PHP_SELF]?page=$_REQUEST[page]"); 
        exit();
        
        }

//tühistab  saabuva lennu
if(isSet($_REQUEST["delete_id"])){
    $kask=$yhendus->prepare("DELETE FROM arrivals WHERE id=?");
    $kask->bind_param("i", $_REQUEST["delete_id"]);
    $kask->execute();
}
//tühistab väljuba lennu
if(isSet($_REQUEST["delete_dept_id"])){
    $kask=$yhendus->prepare("DELETE FROM departures WHERE id=?");
    $kask->bind_param("i", $_REQUEST["delete_dept_id"]);
    $kask->execute();
}
//tühistab sihtkoha
if(isSet($_REQUEST["delete_destination_id"])){
    $kask=$yhendus->prepare("DELETE FROM destinations WHERE id=?");
    $kask->bind_param("i", $_REQUEST["delete_destination_id"]);
    $kask->execute();
}

//tühistab lennufirma, kõigepealt sihtkohtade seostabelist ja seejärel lennufirmade tabelist
if(isSet($_REQUEST["delete_airline_id"])){

    $kask_delete_destination=$yhendus->prepare("DELETE FROM airline_destinations WHERE airline_id=?");
    $kask_delete_destination->bind_param("i", $_REQUEST["delete_airline_id"]);
    $kask_delete_destination->execute();

    $kask_delete_airline=$yhendus->prepare("DELETE FROM airlines WHERE id=?");
    $kask_delete_airline->bind_param("i", $_REQUEST["delete_airline_id"]);
    $kask_delete_airline->execute();
}


//määra kõigile kel ei ole staatus maandus või saabus või tühistatud
if(isSet($_REQUEST["change_all_flights"])){
    $olek= intval($_REQUEST["change_all_flights"]);
    $kask=$yhendus->prepare("UPDATE arrivals SET flightstatus=? WHERE flightstatus not in (1,3,4)");
    $kask->bind_param("i", $olek);
    $kask->execute();  

}
//määra kõigile kes ei ole staatus tühistatud või väljus
if(isSet($_REQUEST["change_all_dept_flights"])){
    $olek= intval($_REQUEST["change_all_dept_flights"]);
    $kask=$yhendus->prepare("UPDATE departures SET flightstatus=? WHERE flightstatus not in (1, 4)");
    $kask->bind_param("i", $olek);
    $kask->execute();  

}

//update staatus manuaalselt
if(isSet($_REQUEST["update_id"])){
    $kask=$yhendus->prepare("UPDATE arrivals SET flightstatus=? WHERE id=?");
    $kask->bind_param("ii", $_REQUEST["flightstatus"], $_REQUEST["update_id"]);
    $kask->execute();
        
}

if(isSet($_REQUEST["update_departure_id"])){
    $kask=$yhendus->prepare("UPDATE departures SET flightstatus=? WHERE id=?");
    $kask->bind_param("ii", $_REQUEST["flightstatus"], $_REQUEST["update_departure_id"]);
    $kask->execute();
        
}

?>
