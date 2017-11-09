<?php
require_once ('config/Connection.php');

class Phone
{
	private $name;
      private $number;
      private $contact_id;

      private $table = 'phones';

      /**
       * @return mixed
       */
      public function getName()
      {
          return $this->name;
      }

      /**
       * @param mixed $name
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
      public function getNumber()
      {
          return $this->number;
      }

      /**
       * @param mixed $number
       *
       * @return self
       */
      public function setNumber($number)
      {
          $this->number = $number;

          return $this;
      }

      /**
       * @return mixed
       */
      public function getContactId()
      {
          return $this->contact_id;
      }

      /**
       * @param mixed $contact_id
       *
       * @return self
       */
      public function setContactId($contact_id)
      {
          $this->contact_id = $contact_id;

          return $this;
      }

    public function insert()
    {
    	       $sql = "INSERT INTO {$this->table} (name, number, contact_id) VALUES (:name,:number,:contact_id)";

    	       $conn = Connection::prepare($sql);
             $conn->bindValue('name',  $this->name);
             $conn->bindValue('number', $this->number);
             $conn->bindValue('contact_id' , $this->contact_id);

    	       return $conn->execute();
	}

	public function update()
      {
		$sql = "UPDATE {$this->table} SET name = :name, number = :number,contact_id = :contact_id WHERE id = :id ";

		$conn = Connection::prepare($sql);
		$conn->bindValue('name', $this->name);
		$conn->bindValue('number', $this->number);
		$conn->bindValue('contact_id' , $this->contact_id);
		$conn->bindValue('id', $this->id);

		return $conn->execute();
	}

	public function delete($id)
      {
		$sql =  "DELETE FROM {$this->table} WHERE id = :id";

		$conn = Connection::prepare($sql);
		$conn->bindValue('id',$id);

		$conn->execute();
	}

	public function get($id = null)
      {
             $sql = "SELECT * FROM {$this->table}";

             if (!is_null($id))
                    $sql .= ' WHERE id = :id ORDER BY name';

             $conn = Connection::prepare($sql);
             $conn->execute();

             return $conn->fetchAll();
      }

      public function getByNumber($number)
      {
             $sql = "SELECT * FROM {$this->table} WHERE number = :number";

             $conn = Connection::prepare($sql);
             $conn->bindValue('number',$number);
             $conn->execute();

             return $conn->fetchAll();
      }



      public function getByContact($id = null)
      {
             $sql = "SELECT * FROM {$this->table}";

             if (!is_null($id)) 
                    $sql .= ' WHERE contact_id = :id ORDER BY name';

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