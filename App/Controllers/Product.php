<?php

namespace App\Controllers;

use App\Models\Articles;
use App\Utility\Upload;
use \Core\View;

/**
 * Product controller
 */
class Product extends \Core\Controller
{

    /**
     * Affiche la page d'ajout
     * @return void
     */
    public function indexAction()
    {

        $error = null;

        if(isset($_POST['submit'])) {

            try {
                if (!isset($_FILES['picture']) || $_FILES['picture']['error'] === UPLOAD_ERR_NO_FILE) {
                    throw new \Exception('Une image est requise');
                }

                $f = $_POST;

                // TODO: Validation

                $f['user_id'] = $_SESSION['user']['id'];
                $id = Articles::save($f);

                try {
                    $pictureName = Upload::uploadFile($_FILES['picture'], $id);
                    Articles::attachPicture($id, $pictureName);
                } catch (\Exception $e) {
                    Articles::delete($id);
                    throw $e;
                }

                header('Location: /product/' . $id);
                return;
            } catch (\Exception $e){
                $error = $e->getMessage();
            }
        }

        View::renderTemplate('Product/Add.html', [
            'error' => $error
        ]);
    }

    /**
     * Affiche la page d'un produit
     * @return void
     */
    public function showAction()
    {
        $id = $this->route_params['id'];

        try {
            Articles::addOneView($id);
            $suggestions = Articles::getSuggest();
            $article = Articles::getOne($id);
        } catch(\Exception $e){
            var_dump($e);
        }

        View::renderTemplate('Product/Show.html', [
            'article' => $article[0],
            'suggestions' => $suggestions
        ]);
    }

    /**
     * Affiche le formulaire de contact et envoie le message
     * @return void
     */
    public function contactAction()
    {
        $id = $this->route_params['id'];

        try {
            $article = Articles::getOne($id);
            $article = $article[0];
        } catch(\Exception $e){
            var_dump($e);
        }

        $sent = false;

        if (isset($_POST['submit'])) {
            $message = $_POST['message'] ?? '';
            $from    = $_POST['email'] ?? '';

            $subject = 'Contact au sujet de ' . $article['name'];
            $to      = $article['email'];

            $headers = 'From: ' . $from;
            @mail($to, $subject, $message, $headers);

            $sent = true;
        }

        View::renderTemplate('Product/Contact.html', [
            'article' => $article,
            'sent'    => $sent
        ]);
    }
}
