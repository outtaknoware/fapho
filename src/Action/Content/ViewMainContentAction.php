<?php
namespace App\Action\Content;

use App\Core\CoreAction;
use Psr\Http\Message\ResponseInterface;

class ViewMainContentAction extends CoreAction
{
	public function invoke(): ResponseInterface
	{
		$this->getView()->setLayout('Page/site.php');
		return $this->getView()->render($this->getResponse(), 'Content/MainPage.php', []);
	}
}
