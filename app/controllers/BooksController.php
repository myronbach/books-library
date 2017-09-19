<?php


namespace app\controllers;


use app\models\Author;
use app\models\Book;
use app\models\Genres;
use app\models\Language;
use core\Controller;
use core\Flash;
use core\Pagination;
use core\View;
use core\Model;


class BooksController extends Controller
{


    public function indexAction()
    {
        $b = new Book();
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        //debug($page);
        $books = $b->getBooksList($page);
        $total = $b->getCountBooks();
        $pagination = new Pagination($total,  SHOW_DEFAULT);
        //debug($books);
        $this->setView('books/index');
        $title = 'Library books';
        $this->set(compact('title', 'books', 'pagination'));
    }

    /**
     * books/create
     */
    public function createAction()
    {
        $authorObj = new Author();
        $authors = $authorObj->getAllItems(['*'], ['asc' => 'id']);

        $genresObj = new Genres();
        $genres = $genresObj->getAllItems(['*']);

        $l = new Language();
        $languages = $l->getAllItems(['*']);

        $title = 'Create a new book.';
        //debug($languages);
        $this->setView('books/create');
        $this->set(compact('title', 'authors', 'genres', 'languages'));
    }

    /**
     * books/store
     */
    public function storeAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [];
            $errors = [];

            // title
            if (strlen($_POST['title']) < 2) {
                //Flash::instance()->addMessage('Ім\'я повинно містити більше 2-х символів');
                $errors['title'] = 'Назва повинна містити більше 2-х символів';
            } else {
                $data['title'] = testInput($_POST['title']);
            }

            // author
            if (empty($_POST['author'])) {
                //Flash::instance()->addMessage();
                $errors['author'] = 'Виберіть автора';
            } else {
                $data['author'] = testInput($_POST['author']);
            }
            // genre
            if (empty($_POST['genre'])) {
                //Flash::instance()->addMessage('Виберіть жанр');
                $errors['genre'] = 'Виберіть жанр';
            } else {
                $data['genre'] = testInput($_POST['genre']);
            }

            //language
            if (empty($_POST['language'])) {
                //Flash::instance()->addMessage();
                $errors['language'] = 'Виберіть мову';
            } else {
                $data['language'] = testInput($_POST['language']);
            }

            // year
            if (!preg_match('~^[0-9]{4}$~', $_POST['year'])) {
                //Flash::instance()->addMessage('Введіть коректно рік видавництва');
                $errors['year'] = 'Введіть коректно рік видавництва';
            } else {
                $data['year'] = testInput($_POST['year']);
            }

            if (!preg_match('~^[0-9]{10}$~', $_POST['isbn'])) {
                //Flash::instance()->addMessage('Введіть коректно ISBN');
                $errors['isbn'] = 'Введіть коректно ISBN';
            } else {
                $data['isbn'] = testInput($_POST['isbn']);
            }

            $b = new Book();
            $id = $b->getLastId() + 1;

            if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/uploads/images/books/{$id}.jpg");
                $data['image'] = $id.'.jpg';
            } else {
                $data['image'] = 'noimage.jpg';
            }
            //debug($_SESSION);
            //debug($errors);
            if (count($errors) > 0) {
                setData($data); // save old data for the form to SESSION
                setErrors($errors); // save errors to SESSION

                //debug($data);
                header('Location:/books/create');
                exit;
            } else {

                $b->storeBook($data);
                Flash::instance()->addMessage('Книгу успішно додано до бібліотеки');
                header('Location:/books');
                exit;
            }

        }
    }

    /**
     * books/id
     * @param $id
     */
    public function showAction($id)
    {
        $b = new Book();
        $book = $b->getBookById($id);
        //debug($book);
        $this->setView('books/show');
        $title = $book['title'];
        $this->set(compact('title', 'book'));

    }

    /**
     * book/id/edit
     */
    public function editAction($id)
    {
        $a = new Author();
        $authors = $a->getAllItems(['*'], ['asc' => 'id']);

        $g = new Genres();
        $genres = $g->getAllItems(['*']);

        $l = new Language();
        $languages = $l->getAllItems(['*']);

        $b = new Book();
        $book = $b->getBookById($id);

        $title = 'Edit the book '. $book['title'];
        //debug($languages);
        $this->setView('books/edit');
        $this->set(compact('title', 'authors', 'genres', 'languages', 'book'));

    }


    /**
     * books/id/update
     * @param $id
     */
    public function updateAction($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [];
            $errors = [];

            // title
            if (strlen($_POST['title']) < 2) {

                $errors['title'] = 'Назва повинна містити більше 2-х символів';
            } else {
                $data['title'] = testInput($_POST['title']);
            }

            // author
            if (empty($_POST['author'])) {

                $errors['author'] = 'Виберіть автора';
            } else {
                $data['author'] = testInput($_POST['author']);
            }
            // genre
            if (empty($_POST['genre'])) {

                $errors['genre'] = 'Виберіть жанр';
            } else {
                $data['genre'] = testInput($_POST['genre']);
            }

            //language
            if (empty($_POST['language'])) {

                $errors['language'] = 'Виберіть мову';
            } else {
                $data['language'] = testInput($_POST['language']);
            }

            // year
            if (!preg_match('~^[0-9]{4}$~', $_POST['year'])) {
                //Flash::instance()->addMessage('Введіть коректно рік видавництва');
                $errors['year'] = 'Введіть коректно рік видавництва';
            } else {
                $data['year'] = testInput($_POST['year']);
            }

            if (!preg_match('~^[0-9]{10}$~', $_POST['isbn'])) {
                //Flash::instance()->addMessage('Введіть коректно ISBN');
                $errors['isbn'] = 'Введіть коректно ISBN';
            } else {
                $data['isbn'] = testInput($_POST['isbn']);
            }

            $b = new Book();
            $img_id = $b->getLastId() + 1;
            //debug($_POST);

            if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/uploads/images/books/{$img_id}.jpg");
                $data['image'] = $img_id.'.jpg';
            } else {
                $data['image'] = testInput($_POST['old_images']);
            }
            //debug($_SESSION);
            //debug($errors);
            if (count($errors) > 0) {
                setErrors($errors); // save errors to SESSION

                //debug($data);
                header("Location:/books/{$id}/edit");
                exit;
            } else {

                $b->updateBook($id, $data);
                Flash::instance()->addMessage('Книгу успішно відредаговано');
                header('Location:/books');
                exit;
            }

        }

    }


    /**
     * books/id/delete
     * @param $id
     */
    public function deleteAction($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $title = testInput($_POST['title']);
            $b = new Book();
            if($b->deleteProductById($id)){
                Flash::instance()->addMessage('Книгу '.$title .' успішно видалено');
                header('Location:/books');
                exit;
            }


        }

    }
}