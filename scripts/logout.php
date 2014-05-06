<?php

//logs the user out and ends the current session.

session_start();

session_destroy();

header( 'Location: ../' ) ;


?>