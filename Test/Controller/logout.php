<?php
session_start();
session_destroy();
header("Location: ../register_login.php ");
