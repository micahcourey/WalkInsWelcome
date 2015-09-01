<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Activity.php";
    require_once __DIR__."/../src/Business.php";
    //require_once __DIR__."/../src/Category.php";
    //require_once __DIR__."/../src/User.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=walk_in';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('activities'=>Activity::getAll()));
    });

    // $app->get("/userhome", function() use ($app) {
    //         return $app['twig']->render('userhome.html.twig', array('activities'=>Activity::getAll()));
    // });

    $app->get("/businesses", function() use ($app) {
       return $app['twig']->render('businesses.html.twig', array('businesses'=>Business::getAll()));
    });

    $app->get("/businesshome/{id}", function($id) use ($app) {
        $business = Business::find($id);
        return $app['twig']->render('businesshome.html.twig', array('business' => $business, 'businesses' => Business::getAll, 'all_activities' =>Activity::getALl()));
    });

    // $app->get("/activity/{id}", function($id) use ($app) {
    //     $activity = Activity::find($id);
    //     $activity_id = $activity->getId();
    //     return $app['twig']->render('activity.html.twig', )
    // })


    return $app
?>
