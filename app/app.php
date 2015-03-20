<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/stylist", function() use ($app){
    return $app['twig']->render('stylist.twig', array('stylist' => Stylist::getAll()));
    });

    $app->post("/stylist", function() use ($app){
    $new_stylist = new Stylist($_POST['name']);
    $new_stylist->save();
    return $app['twig']->render('stylist.twig', array('stylist' => Stylist::getAll()));
    });

    $app->get("/stylist/{id}", function($id) use ($app) {
        $current_stylist = Stylist::find($id);
        return $app['twig']->render('stylist.twig', array('stylist' => $current_stylist, 'client' => Client::getAll()));
    });

    $app->get("/stylist/{id}/edit", function($id) use ($app){
        $current_stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.twig', array('stylist' => $current_stylist));
    });

    $app->patch("/stylist/{id}", function($id) use ($app) {
    $current_stylist = Stylist::find($id);
    $new_name = $_POST['name'];
    $current_stylist->update($new_name);
    return $app['twig']->render('stylist.html.twig', array('stylist' => $current_stylist));
    });

    $app->delete("/stylists/{id}", function($id) use ($app) {
        $current_stylist = Stylist::find($id);
        $current_stylist->delete();
        return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });




?>
