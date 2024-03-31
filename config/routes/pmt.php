<?php
use App\Action\PMT\Dashboard\ViewAction as DashboardView;
use App\Action\PMT\Registration\RegisterAction;
use App\Action\PMT\Registration\ViewRegistrationsAction;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
	$app->get('[/]', DashboardView::class);

	$app->group('/session/{id:[a-fA-F0-9]{12}4[a-fA-F0-9]{3}[89abAB][a-fA-F0-9]{15}}', function (RouteCollectorProxy $session) {
		$session->get('[/]', ViewRegistrationsAction::class);
		$session->map(['GET', 'POST'], '/register', RegisterAction::class);
	});

	return $app;
};
