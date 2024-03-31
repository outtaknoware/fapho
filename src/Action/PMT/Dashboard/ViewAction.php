<?php
namespace App\Action\PMT\Dashboard;

use App\Core\CoreAction;
use Psr\Http\Message\ResponseInterface;

class ViewAction extends CoreAction
{
	public function invoke(): ResponseInterface
	{
		$this->getView()->setLayout('PMT/Page/DefaultPage.php');
		return $this->getView()->render($this->getResponse(), 'PMT/Content/DashboardContent.php', []);
	}
}
