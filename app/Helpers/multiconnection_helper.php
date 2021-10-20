<?php

function setdb( $db_name )
{
    $dbconect = $db_name;
    $db = \Config\Database::connect();
    $db->setDatabase( $dbconect );
}