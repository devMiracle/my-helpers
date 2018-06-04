<?php

function escape($input) {
    return htmlentities($input, ENT_QUOTES);
}
