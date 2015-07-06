<?php
/**
 * Created by PhpStorm.
 * User: Jérémie
 * Date: 31/05/2015
 * Time: 00:23
 */

namespace Controller;

class DancersController
{

    public function construct()
    {

    }

    public function PostType()
    {
        register_post_type('dancer',
            array(
                'labels' => array(
                    'name' => __('Danseur'),
                    'singular_name' => __('Dancer'),
                    'add_new_item' => __('Ajouter un danseur'),
                    'new_item' => __('Nouveau danseur'),
                    'edit_item' => __('Modifier un danseur'),
                    'view_item' => __('Voir danseur'),
                    'all_items' => __('Tous les danseurs'),
                ),
                'public' => true
            )
        );
    }

    public function addMetaBox()
    {
        add_meta_box("dancer", "Danseur Options", array($this, "DancerMetaBoxContent"), 'dancer', 'advanced',
            'high');
    }

    public function DancerMetaBoxContent()
    {
        /** @var \Model\DancersModel $dancers_model */
        $dancers_model = \Services\SingletonFactory::getInstance('\Model\DancersModel');

        global $twig, $post;
        //Format dancer datas
        echo $twig->render('admin/dancer-metabox.twig',
            [
                "post_name" => $dancers_model->getMeta($post->ID , "post_name"),
                "subtitle" => $dancers_model->getMeta($post->ID , "subtitle"),
                "post_punchline" => $dancers_model->getMeta($post->ID , "post_punchline"),
                "post_color" => $dancers_model->getMeta($post->ID , "post_color"),
                "post_image" => $dancers_model->getMeta($post->ID , "post_image"),
                "post_profile" => $dancers_model->getMeta($post->ID , "post_profile"),
            ]
        );
    }

    public function SavePost()
    {
        /** @var \Model\DancersModel $dancers_model */
        $dancers_model = \Services\SingletonFactory::getInstance('\Model\DancersModel');

        global $post;
        if (isset($_POST["post_name"])) {
            $dancers_model->setMeta($post->ID, "post_name", $_POST["post_name"]);
        }
        if (isset($_POST["subtitle"])) {
            $dancers_model->setMeta($post->ID, "subtitle", $_POST["subtitle"]);
        }
        if (isset($_POST["post_punchline"])) {
            $dancers_model->setMeta($post->ID, "post_punchline", $_POST["post_punchline"]);
        }
        if (isset($_POST["post_color"])) {
            $dancers_model->setMeta($post->ID, "post_color", $_POST["post_color"]);
        }

        if (isset($_POST["post_media_cover"])) {
            $dancers_model->setMeta($post->ID, "post_image", $_POST["post_media_cover"]);
        }

        if (isset($_POST["post_media_profile"])) {
            $dancers_model->setMeta($post->ID, "post_profile", $_POST["post_media_profile"]);
        }

    }

    public function init()
    {
        add_action('init', [$this, "PostType"]);
        add_action('add_meta_boxes', [$this, "addMetaBox"]);

        add_action('post_updated', [$this, "SavePost"]);
    }

}