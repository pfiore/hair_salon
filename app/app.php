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

    $app->get("/", function() use ($app){
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/stylists", function() use ($app){
        $new_stylist = new Stylist($_POST['name']);
        $new_stylist->save();
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}", function($id) use ($app) {
        $current_stylist = Stylist::find($id);
        return $app['twig']->render('stylist.twig', array('stylist' => $current_stylist, 'clients' => Client::getAll()));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app){
        $current_stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.twig', array('stylist' => $current_stylist));
    });

    $app->patch("/stylists/{id}", function($id) use ($app) {
        $current_stylist = Stylist::find($id);
        $new_name = $_POST['name'];
        $current_stylist->update($new_name);
        return $app['twig']->render('stylist.twig', array('stylist' => $current_stylist));
    });

    $app->delete("/stylists/{id}", function($id) use ($app) {
        $current_stylist = Stylist::find($id);
        $current_stylist->delete();
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/delete_stylists", function() use ($app) {
        Stylist::deleteAll();
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });


    $app->get("/clients", function() use ($app){
        return $app['twig']->render('clients.twig', array('clients' => Client::getAll()));
    });

    $app->post("/clients", function() use ($app){
        $new_client = new Client($_POST['name'], $id = null, $_POST['stylist_id']);
        $new_client->save();
        return $app['twig']->render('clients.twig', array('clients' => Client::getAll()));
    });

    $app->get("/clients/{id}", function($id) use ($app) {
        $current_client = Client::find($id);
        return $app['twig']->render('client.twig', array('client' => $current_client));
    });
    $app->get("/clients/{id}/edit", function($id) use ($app){
        $current_client = Client::find($id);
        return $app['twig']->render('client_edit.twig', array('client' => $current_client));
    });

    $app->patch("/clients/{id}", function($id) use ($app) {
        $current_client = Client::find($id);
        $new_name = $_POST['name'];
        $current_client->update($new_name);
        return $app['twig']->render('client.twig', array('client' => $current_client));
    });

    $app->delete("/clients/{id}", function($id) use ($app) {
        $current_client = Client::find($id);
        $current_client->delete();
        return $app['twig']->render('clients.twig', array('clients' => Client::getAll()));
    });

    $app->post("/delete_clients", function() use ($app) {
        Client::deleteAll();
        return $app['twig']->render('clients.twig', array('clients' => Client::getAll()));
    });



    return $app;
?>
