<?php
namespace Opencart\Admin\Controller\Startup;
class Login extends \Opencart\System\Engine\Controller {
	public function index(): object|null {
		if (isset($this->request->get['route'])) {
			$route = (string)$this->request->get['route'];
		} else {
			$route = '';
		}

		$ignore = [
			'common/login',
			'common/forgotten',
			'common/reset',
			'common/cron'
		];

		// User
		$this->registry->set('user', new \Opencart\System\Library\Cart\User($this->registry));

		if (!$this->user->isLogged() && !in_array($route, $ignore)) {
			return new \Opencart\System\Engine\Action('common/login');
		}

		$ignore = [
			'common/login',
			'common/logout',
			'common/forgotten',
			'common/reset',
			'common/cron',
			'error/not_found',
			'error/permission'
		];

		if (!in_array($route, $ignore) && (!isset($this->request->get['user_token']) || !isset($this->session->data['user_token']) || ($this->request->get['user_token'] != $this->session->data['user_token']))) {
			return new \Opencart\System\Engine\Action('common/login');
		} else {
			return null;
		}
	}
}
