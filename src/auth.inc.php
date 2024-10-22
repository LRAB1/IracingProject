<?php
##TODO: fix this so login is actually checked, instead of being able to navigate to the page and just seeing a header error.
##Protects unauthorized acces to pages, needs to be included in the page.


if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
};
?>