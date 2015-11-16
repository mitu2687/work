<?php
App::uses('AppController', 'Controller');

class LoginController extends AppController {

	public function index() {

		if ($this->Session->read("login")) {
			$this->redirect("/");
		}

		if ($this->request->data) {

			try {
				$conditions = array(
					"account" => $this->request->data("account"),
					"password" => Security::hash($this->request->data("password"), null, true),
					"delete_flg" => 0,
				);

				$master = $this->Designer->find("first", array(
					"conditions" => $conditions,
				));

				if ($master) {

					$login["login_date"] = date("Y-m-d H:i:s");
					$login["master"] = $master;

					$this->Session->write("login", $master);

					$this->redirect("/");
				}
			}

			catch (Exception $e) {
			}

		}
	}
}
