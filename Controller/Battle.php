<?php
namespace Controller;

class Battle {

    public function PostType()
    {
        register_post_type('battle',
            array(
                'labels' => array(
                    'name' => __('Battle'),
                    'singular_name' => __('Battle'),
                    'add_new_item' => __('Ajouter un battle'),
                    'new_item' => __('Nouveau battle'),
                    'edit_item' => __('Modifier un battle'),
                    'view_item' => __('Voir battle'),
                    'all_items' => __('Tous les battles'),
                ),
                'public' => true
            )
        );
    }

    public function construct()
    {

    }

    public function addMetaBox()
    {
        add_meta_box("battle", "Battle Options", array($this, "BattleMetaBoxContent"), 'battle', 'advanced',
            'high');
    }

    public function BattleMetaBoxContent()
    {
        /** @var \Model\Battle $battle_model */
        $battle_model = \Services\SingletonFactory::getInstance('\Model\Battle');

        global $twig, $post;

        

        //Format dancer datas
        echo $twig->render('admin/battle-metabox.twig',
            [
                "battle" =>,
                "vote" =>
            ]
        );

    }

    public function SavePost()
    {
        /** @var \Model\DancersModel $dancers_model */
        $dancers_model = \Services\SingletonFactory::getInstance('\Model\BattleModel');

        global $post;
        if (isset($_POST["post_name"])) {
            $dancers_model->setMeta($post->ID, "post_name", $_POST["post_name"]);
        }
    }

    public function init()
    {
        add_action('init', [$this, "PostType"]);
        add_action('add_meta_boxes', [$this, "addMetaBox"]);

        add_action('post_updated', [$this, "SavePost"]);
    }

}