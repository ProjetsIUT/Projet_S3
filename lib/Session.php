<?php

class Session {

    public static function is_user($login) {
        return (!empty($_SESSION['loginUtilisateur']) && ($_SESSION['loginUtilisateur'] === $login));
    }

    public static function is_admin() {
        return (!empty($_SESSION['typeUtilisateur']) && $_SESSION['typeUtilisateur'] === 'administrateur');
    }
    
    public static function is_student() {
        return (!empty($_SESSION['typeUtilisateur']) && $_SESSION['typeUtilisateur'] === 'etudiant');
    }

    public static function is_teacher() {
        return (!empty($_SESSION['typeUtilisateur']) && $_SESSION['typeUtilisateur'] === 'enseignant');
    }
}

?> 