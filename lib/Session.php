<?php

class Session {
    public static function is_user($login) {
        return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
    }

    public static function is_admin() {
        return (!empty($_SESSION['admin']) && $_SESSION['admin']);
    }

    public static function is_student($login) {
        return (!empty($_SESSION['loginEtudiant']) && $_SESSION['loginEtudiant'] == $login);
    }

    public static function is_teacher($login) {
        return (!empty($_SESSION['loginEnseignant']) && $_SESSION['loginEnseignant'] == $login);
    }
}

?>