<?php
namespace App\Action\PMT\Registration;

use App\Core\CoreAction;
use Aws\S3\S3Client;
use Cake\Utility\Text;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\Filesystem;
use Psr\Http\Message\ResponseInterface;

class RegisterAction extends CoreAction
{
	public function invoke(): ResponseInterface
	{
		$this->getView()->setLayout('PMT/Page/DefaultPage.php');

		if ($this->getRequest()->getMethod() === 'GET') {
			return $this->getView()->render($this->getResponse(), 'PMT/Content/RegistrationForm.php', []);
		} elseif ($this->getRequest()->getMethod() === 'POST') {
			$fs = new Filesystem(new AwsS3V3Adapter(
				new S3Client([
					'version' => $_ENV['DIGITALOCEAN_SPACES_VERSION'],
					'region' => $_ENV['DIGITALOCEAN_SPACES_REGION'],
					'endpoint' => $_ENV['DIGITALOCEAN_SPACES_ENDPOINT'],
					'credentials' => [
						'key' => $_ENV['DIGITALOCEAN_SPACES_KEY'],
						'secret' => $_ENV['DIGITALOCEAN_SPACES_SECRET'],
					],
				]),
				$_ENV['DIGITALOCEAN_SPACES_BUCKET'],
				'registrations',
			));

			$registration = $this->getRequest()->getParsedBody();

			$registrationID = Text::uuid();
			$registration['id'] = $registrationID;

			$registration = json_encode($registration);

			$fs->write($registrationID . ".json", $registration);

			return $this->getView()->render($this->getResponse(), 'PMT/Content/RegistrationForm.php', []);
		}
	}
}
