<?php


namespace app\models;
use core\Model;
use core\Db;

class Book extends Model
{
    public function __construct()
    {
        parent::__construct('books');
    }

    public function getBooksList($page)
    {
        $page = intval($page);
        $offset = ($page - 1) * SHOW_DEFAULT;
        $query = "SELECT  books.id,
                          books.title,  
                          authors.first_name, 
                          authors.last_name,
                          genres.genre,
                          languages.language,
                         books.publication_date,
                         books.isbn_number    
                  FROM books
                  INNER JOIN authors ON books.author_id=authors.id
                  INNER JOIN genres ON books.genre_id=genres.id
                  INNER JOIN languages ON books.language_id=languages.id 
                  LIMIT ".SHOW_DEFAULT." OFFSET $offset";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getBookById($id)
    {
        $query = 'SELECT  books.id,
                          books.author_id,
                          books.genre_id,
                          books.language_id,
                          books.title,  
                          authors.first_name, 
                          authors.last_name,
                          genres.genre,
                          languages.language,
                         books.publication_date,
                         books.isbn_number,
                         books.image
                  FROM books
                  INNER JOIN authors ON books.author_id=authors.id
                  INNER JOIN genres ON books.genre_id=genres.id
                  INNER JOIN languages ON books.language_id=languages.id
                  WHERE books.id='.$id ;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function storeBook($data)
    {
        try {
            $query = 'INSERT INTO books (title, author_id, 
                                    genre_id, language_id, 
                                    publication_date, isbn_number,
                                    image
                                    )
                   VALUES (:title, :author_id, :genre_id, 
                   :language_id, :publication_date, :isbn_number, :image 
                   )';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':author_id', $data['author']);
            $stmt->bindParam(':genre_id', $data['genre']);
            $stmt->bindParam(':language_id', $data['language']);
            $stmt->bindParam(':publication_date', $data['year']);
            $stmt->bindParam(':isbn_number', $data['isbn']);
            $stmt->bindParam(':image', $data['image']);
            $stmt->execute();
        } catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getLastId()
    {
        //return $this->db->lastInsertId();
        $query = 'SELECT MAX(id) AS id FROM books';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $id = $stmt->fetch(\PDO::FETCH_ASSOC);
        return  $id['id'];
    }

    public function getCountBooks()
    {
        $query = 'SELECT count(id) AS count FROM books';
        $result = $this->db->query($query);
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        return $row['count'];
    }

    public function updateBook($id, array $data)
    {
        try {
            $query = 'UPDATE books SET 
                                    title = :title, 
                                    author_id = :author_id, 
                                    genre_id = :genre_id, 
                                    language_id = :language_id, 
                                    publication_date = :publication_date, 
                                    isbn_number = :isbn_number,
                                    image = :image
                                    
                   WHERE id='. $id;
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':author_id', $data['author']);
            $stmt->bindParam(':genre_id', $data['genre']);
            $stmt->bindParam(':language_id', $data['language']);
            $stmt->bindParam(':publication_date', $data['year']);
            $stmt->bindParam(':isbn_number', $data['isbn']);
            $stmt->bindParam(':image', $data['image']);
            $stmt->execute();
        } catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    public  function deleteProductById($id)
    {
        try{
            $sql = "DELETE FROM books WHERE id = :id";
            $result = $this->db->prepare($sql);
            $result->bindParam(':id', $id, \PDO::PARAM_INT);
            return $result->execute();
        } catch (\Exception $e){
            echo "Error: " . $e->getMessage();
        }

    }



}