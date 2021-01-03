<?php

    use Symfony\Component\Yaml\Yaml;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    // activation du système d'autoloading de Composer
    require_once __DIR__.'/../vendor/autoload.php';
    
    // instanciation du chargeur de templates
    $loader = new FilesystemLoader(__DIR__.'/../templates');
    
    // instanciation du moteur de template
    $twig = new Environment($loader);
    
    // traitement des données

    $config = Yaml::parseFile(__DIR__.'/../config/config.yaml');

    $data =[
        'login' => '',
        'password' => '',
    ];

    $errors = [];

    if($_POST){
        foreach ($data as $key => $value){
            if (isset($_POST[$key])) {
                $data[$key] = $_POST[$key];
            }
        }

        if(empty($_POST['login'])){
            $errors['login'] = "Veuillez renseigner votre identifiant";
        } elseif(strlen($_POST['login'] >= 190)){
            $errors['login'] = "Mot de passe ou login incorrect";
        } elseif($_POST['login'] != $config['login']){
            $errors['login'] = "Mot de passe ou login incorrect";
            $errors['password'] = "Mot de passe ou login incorrect";
        } 
        
        if(empty($_POST['password'])){
            $errors['password'] = "Veuillez renseigner votre mot de passe";
        } elseif(strlen($_POST['password']) <= 8 || strlen($_POST['password']) >= 32){
            $errors['password'] = "Le mot de passe doit contenir entre 8 et 32 caractères";
        } elseif (preg_match('/[^A-Za-z]/', $_POST['password']) === 0 || preg_match('/[0-9]/', $_POST['password']) === 0 || preg_match('/[^A-Za-z0-9]/', $_POST['password']) === 0){
            $errors['password'] = "Le mot de passe doit contenir au moins un caractère latin, un chiffre, et un caractère spécial";   
        } elseif (!password_verify($_POST['password'], $config['password'])) {
            $errors['login'] = "Mot de passe ou login incorrect";
            $errors['password'] = "Mot de passe ou login incorrect";
        }

        if(empty($errors)){
            $url = 'private.php';
            header("location: {$url}", true, 301);
            exit();
        }
    }
    
    // affichage du rendu d'un template
    echo $twig->render('login.html.twig', [
        // transmission de données au template
        'errors' => $errors,
        'data' => $data
    ]);