<?php
/**
 * The array of classes you must Autoload before the app classes.
 */
$_autoload = Array();


// core
$_autoload["CORE"] = ['AccessController'];

// lib
$_autoload["LIB"] = ['FormBuilder'];

// helper
$_autoload["HELPER"] = ['ServicoHelper','EnumHelper'];


Loader::static_load($_autoload);