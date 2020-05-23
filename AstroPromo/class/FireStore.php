<?php


require_once '../vendor/autoload.php';

use Google\Cloud\Firestore\DocumentReference;
use Google\Cloud\Firestore\FirestoreClient;

class Firestore
{
    protected $db;
    protected $name;
    protected $idDocument;
    public function __construct(string $collection)
    {
        $this->db = new FirestoreClient([
            'projectId' => 'astropromo-f50d6'
        ]);
        $this->name = $collection;
    }




    public function getWhere(string $field, $value)
    {

        $resultado = [];
        $snapshot = $this->db->collection($this->name)->where($field, '==', $value)->documents();
        foreach ($snapshot as $document) {
            $arreglo = $document->data();
            $arreglo["id"]=$document->id();
            array_push($resultado, $arreglo);
        }
        return $resultado;
    }
    public function existe($id)
    {
        return $this->db->collection($this->name)->document($id)->snapshot()->exists();
    }

    public function newDocument(array $data = [])
    {
        $addedDocRef = $this->db->collection($this->name)->add($data);
        return $addedDocRef->id();
    }

    public function newDocumentId(string $id, array $data = [])
    {
        if ($this->db->collection($this->name)->document($id)->snapshot()->exists()) {
            throw new Exception('Ya existe');
        } else {
            $this->db->collection($this->name)->document($id)->create($data);
        }
    }

    public function updateDocument(String $id, array $data = [])
    {
        if ($this->db->collection($this->name)->document($id)->snapshot()->exists()) {
            $this->db->collection($this->name)->document($id)->update($data);
        } else {
            throw new Exception('No existe');
        }
    }

    public function getDocument(string $id)
    {
        if (empty($id)) throw new Exception('Falta ID');
        if ($this->db->collection($this->name)->document($id)->snapshot()->exists()) {
            return $this->db->collection($this->name)->document($id)->snapshot()->data();
        } else {
            throw new Exception('No existe');
        }
    }


    public function newCollection(string $name, string $doc_name, array $data = [])
    {
        try {
            $this->db->collection($name)->document($doc_name)->create($data);
            return true;
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function dropDocument(string $id)
    {
        if ($this->db->collection($this->name)->document($id)->snapshot()->exists()) {
            $this->db->collection($this->name)->document($id)->delete();
        } else {
            throw new Exception('No existe');
        }
    }

    public function dropCollection(string $name)
    {
        $documents = $this->db->collection($name)->limit(1)->documents();
        while (!$documents->isEmpty()) {
            foreach ($documents as $item) {
                $item->reference()->delete();
            }
        }
    }
}
