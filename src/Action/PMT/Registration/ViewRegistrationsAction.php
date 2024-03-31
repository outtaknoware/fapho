<?php
namespace App\Action\PMT\Registration;

use App\Core\CoreAction;
use Psr\Http\Message\ResponseInterface;

class ViewRegistrationsAction extends CoreAction
{
	public function invoke(): ResponseInterface
	{
		$this->getView()->setLayout('PMT/Page/DefaultPage.php');
		return $this->getView()->render($this->getResponse(), 'PMT/Content/Registrations.php', []);
	}
}
