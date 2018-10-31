<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "createPost"
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // добавляем разрешение "updatePost"
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // добавляем роль "moderator" и даём роли разрешение "createPost"
        $moderator = $auth->createRole('moderator');
        $auth->add($moderator);
        $auth->addChild($moderator, $createPost);

        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "moderator"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $moderator);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($moderator, 2);
        $auth->assign($admin, 1);
    }
}
