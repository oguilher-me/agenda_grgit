<?php
require_once('config/Connection.php');

class Contact
{
      private $id;
      private $name;
      private $email;

      private $table = 'contacts';

      /**
       * @return mixed
       */
      public function getId()
      {
          return $this->id;
      }

      /**
       * @param mixed $id
       *
       * @return self
       */
      public function setId($id)
      {
          $this->id = $id;

          return $this;
      }

      /**
       * @return string
       */
      public function getName()
      {
          return $this->name;
      }

      /**
       * @param string $name
       *
       * @return self
       */
      public function setName($name)
      {
          $this->name = $name;

          return $this;
      }

      /**
       * @return mixed
       */
      public function getEmail()
      {
          return $this->email;
      }

      /**
       * @param mixed $email
       *
       * @return self
       */
      public function setEmail($email)
      {
          $this->email = $email;

          return $this;
      }
      

      public function insert()
      {
             $sql = "INSERT INTO {$this->table} (name,email) VALUES (:name,:email) RETURNING id" ;

             $conn = Connection::prepare($sql);
             $conn->bindValue('name',  htmlspecialchars(strip_tags($this->name)));
             $conn->bindValue('email', $this->email);
    	       
             $conn->execute();
             return $conn->fetchAll();
	}

	public function update()
      {
		$sql = "UPDATE {$this->table} SET name = :name, email = :email WHERE id = :id";
		
             $conn = Connection::prepare($sql);
		$conn->bindValue('name', $this->name);
		$conn->bindValue('email', $this->email);
		$conn->bindValue('id', $this->id);
	
        	return $conn->execute();
	}

	public function delete($id)
      {
		$sql =  "DELETE FROM {$this->table} WHERE id = :id";

		$conn = Connection::prepare($sql);
		$conn->bindValue('id',$id);

		return $conn->execute();

	}

	public function get($id = null)
      {
             $sql = "SELECT * FROM {$this->table}";

             if (!is_null($id))
                    $sql .= ' WHERE id = :id ORDER BY name';

             $conn = Connection::prepare($sql);

             if (!is_null($id))
                   $conn->bindValue('id',$id);

             $conn->execute();

             return $conn->fetchAll();
	}

	public function findAll(){
		$sql = "SELECT * FROM {$this->table}";
		$conn = Connection::prepare($sql);
		$conn->execute();
		return $conn->fetchAll();
	}
}