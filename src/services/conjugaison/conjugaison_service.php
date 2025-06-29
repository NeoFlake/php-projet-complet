<?php

function conjuguer($verb = "conjuguer", $temps = "present") {

    $result = "Erreur: Impossible de conjuguer ";
    if($verb != ""){
        if(substr($verb, -2, 2) == "er" and $verb != "aller"){
            $result = ["je ", "tu ", "il / elle ", "nous ", "vous ", "ils / elles "];
            switch($temps){
                case "present":
                    $verb = substr($verb, 0, strlen($verb) - 1);
                    $result[0] .= $verb;
                    $result[1] .= $verb . "s";
                    $result[2] .= $verb;
                    $result[3] .= (substr($verb, -2, 1) == "g" ? $verb . "ons" : (substr($verb, -2, 1) == "c" ? 
                    substr($verb, 0, strlen($verb) - 2) . "çons" : substr($verb, 0, strlen($verb) - 1) . "ons"));
                    $result[4] .= $verb . "z";
                    $result[5] .= $verb . "nt";
                    break;
                case "futur":
                    $result[0] .= $verb . "ai";
                    $result[1] .= $verb . "as";
                    $result[2] .= $verb . "a";
                    $result[3] .= $verb . "ons";
                    $result[4] .= $verb . "ez";
                    $result[5] .= $verb . "ont";
                    break;
                case "imparfait":
                    $verb = substr($verb, -3, 1) == "g" ? substr($verb, 0, strlen($verb) - 1) : 
                        (substr($verb, -3, 1) == "c" ?   substr($verb, 0, strlen($verb) - 3) . "ç" : substr($verb, 0, strlen($verb) - 2));
                    $result[0] .= $verb . "ais";
                    $result[1] .= $verb . "ais";
                    $result[2] .= $verb . "ait";
                    $result[3] .= $verb . "ions";
                    $result[4] .= $verb . "iez";
                    $result[5] .= $verb . "aient";
                    break;
            }
        } else {
            $result .= "car le verbe entré qui est \"" . $verb . "\" n'est pas un verbe du premier groupe";
        }
    } else {
        $result .= "car vous n'avez pas entré de verbe";
    }

    return $result;

}