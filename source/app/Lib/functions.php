<?php

/**
 * Shortcut to if
 *
 * @author Bishwanath Jha
 * @param string $_expression The Expression to Parse
 * @param string $_returnOnTrue The Value to Return if Expression is True
 * @param string $_returnOnFalse The Value to Return if Expression is False
 * @return string $_returnOnTrue if _expression is true or returns _returnOnFalse
 */
function IIF($_expression, $_returnOnTrue = '', $_returnOnFalse = '') {
    return ($_expression ? $_returnOnTrue : $_returnOnFalse);
}

/**
 * Replace space with given sign
 *
 * @author Bishwanath Jha
 * @param string $_new The new char
 * @param string $_string The main string
 * @return string space replaced string
 */
function ReplaceSpace($_new, $_string){
    return preg_replace('/\s+/', $_new, $_string);
}

/**
 * convert database date-time format to string format.
 *
 * @author Bishwanath Jha
 * @param datetime $_datetime
 * @return string with format like "April 24th, 2013"
 */
function Time2Str ($_datetime) {
   return date("F jS, Y", strtotime($_datetime));
}

function Time2StrFull($_datetime) {
    return date("Y/m/d g:i A", strtotime($_datetime));
}

/**
 * Extended Array Check (Combine Count() with is_array())
 *
 * @author Bishwanath Jha
 * @param array $_containerArray The Container Array to Check On
 * @return bool "true" on Success, "false" otherwise
 */
function _is_array($_containerArray) {
    if (!is_array($_containerArray) || !count($_containerArray)) {
        return false;
    } else {
        return true;
    }

    return false;
}

/**
 * Build the Array into a IN() processable value
 *
 * @author Bishwanath Jha
 * @param array $_dataContainer The Data Container
 * @return string The Processed Value
 */
function BuildIN($_dataContainer, $_toInteger = false) {
    $_inText = '';
    if (!_is_array($_dataContainer)) {
        return "'0'";
    }
    foreach ($_dataContainer as $_key => $_val) {
        if ($_toInteger === true) {
            $_inText .= addslashes($_val) . ",";
        } else {
            $_inText .= "'" . addslashes($_val) . "',";
        }
    }
    if (!empty($_inText)) {
        return substr($_inText, 0, -1);
    } else {
        return "'0'";
    }
}

/**
 * Get Array from an array on specific key
 *
 * @author Bishwanath Jha
 * @param String $_msg
 * @return string The Processed Value otherwise false
 */
function GetArrayFromArrayOnKey ($_array, $_key) {
    if(empty ($_array)) return false;
    
    $_res = array();
    foreach ($_array as $k => $v){
        if(array_key_exists($_key, $v)) 
            $_res[] =  $v[$_key];
    }
    return $_res;
}

/**
 * Return the text as an Success message
 *
 * @author Bishwanath Jha
 * @param String $_msg
 * @return string The Processed Value otherwise false
 */
function Success ($_msg = false) {
    if($_msg === false)  return false;
    $str  =  '<ul class="states">';
    $str .= '<li class="succes">Succes : ' .$_msg . '</li>';
    $str .= '</ul>';
    return $str;
}

/**
 * Return the text as an Error message
 *
 * @author Bishwanath Jha
 * @param String $_msg
 * @return string The Processed Value otherwise false
 */
function Error ($_msg = false) {
    if($_msg === false)  return false;
    $str  =  '<ul class="states">';
    $str .= '<li class="error">Error : ' .$_msg . '</li>';
    $str .= '</ul>';
    return $str;
}

/**
 * Return the text as an Warning message
 *
 * @author Bishwanath Jha
 * @param String $_msg
 * @return string The Processed Value otherwise false
 */
function Warning ($_msg = false) {
    if($_msg === false)  return false;
    $str  =  '<ul class="states">';
    $str .= '<li class="warning">Error : ' .$_msg . '</li>';
    $str .= '</ul>';
    return $str;
}

function _pr($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


?>