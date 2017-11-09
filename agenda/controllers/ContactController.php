<?php
require_once 'model/Contact.php';
require_once 'model/Phone.php';

class ContactController 
{
	function postAction(Request $request)
	{
		try {
			$params = $request->parameters;
			$contact = new Contact();

			$errors = [];

			if (empty($params['name']))
				$errors[] = 'O campo nome é de preenchimento obrigatório.';

			if (empty($params['names']))
				$errors[] = 'É obrigatório a inclusão de pelo menos 1 telefone.';

			if (!empty($errors))
				throw new \Exception(json_encode($errors));

			$contact->setName($params['name']);
			
			if (isset($params['email']) && ctype_alnum($params['email']))
				$contact->setEmail($params['email']);

			$id = $contact->insert();

			foreach ($params['names'] as $key => $value) {
				$phone = new Phone();
				$phone->setName($value);
				$phone->setNumber($params['numbers'][$key]);
				$phone->setContactId($id[0]->id);
				$phone->insert();
			}
			return array('status' => true);
		} catch (\Exception $erro) {
			return array('status' => false, 'message' => $erro->getMessage());
		}
	}

	function putAction(Request $request)
	{
		try {
			$params = $request->parameters;
			$contact = new Contact();
			$phone = new Phone();
			
			if (isset($params['id']) && ctype_alnum($params['id']))
				$result = $contact->get($params['id']); 
			else
				throw new \Exception('O contato que deseja alterar não existe');

			if (empty($params['name']))
				throw new \Exception('O campo nome é de preenchimento obrigatório.');

			$contact = new Contact();
			$contact->setId($params['id']);
			$contact->setName($params['name']);
			if (isset($params['email']) && ctype_alnum($params['email']))
				$contact->setEmail($params['email']);
			
			$contact->update();

			foreach ($params['names'] as $key => $value) {
				$phone = new Phone();
				$resultPhone = $phone->getByNumber($params['numbers'][$key]);

				if (empty($resultPhone)) {
					$phone =  new Phone();
					$phone->setName($value);
					$phone->setNumber($params['numbers'][$key]);
					$phone->setContactId($params['id']);
					$phone->insert();
				}
			}

			return array('status' => true);
		} catch (\Exception $erro) {
			return array('status' => false, 'message' => $erro->getMessage());

		}
	}

	function deleteAction(Request $request)
	{
		try {
			$params = $request->parameters;

			if (!isset($params['id']) || (isset($params['id']) && empty($params['id'])))
				throw new \Exception('Nenhum contato informado para a exclusão');

			$contact = new Contact();
			$result = $contact->get($params['id']);

			if (empty($result) )
				throw new \Exception('O contato que deseja excluir não existe.');

			$phone = new Phone();
			foreach ($phone->getByContact($result[0]->id) as $index => $tel) {
				$phone->delete($tel->id);
			}

			$contact->delete($params['id']);
			return array('status' => true);
		} catch (\Exception $erro) {
			return array('status' => false, 'message' => $erro->getMessage());
		}
	}

	function getAction(Request $request)
	{
		
		$contact = new Contact();
		$phone = new Phone();
		if (isset($request->urlElements[2]) && ctype_alnum($request->urlElements[2]))
			$result = $contact->get($request->urlElements[2]); 
		else
			$result = $contact->get();
		$contacts = [];
		foreach ($result as $key => $value) {
				$aux = json_decode(json_encode($value),TRUE); 
			$contacts[$key] = $aux;
			foreach ($phone->getByContact($value->id) as $index => $tel) {
				$aux = json_decode(json_encode($tel),TRUE); 
				$contacts[$key]['phones'][$index] = $aux;
			}
		}
		return $contacts;
	}
}