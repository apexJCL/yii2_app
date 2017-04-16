<?php

namespace console\controllers;


use common\models\User;
use yii\console\Controller;
use yii\db\Exception;
use yii\helpers\Console;
use yii\rbac\Assignment;
use yii\rbac\ManagerInterface;
use yii\rbac\Role;

class AuthController extends Controller
{

    /**
     * Crea un rol con el nombre y descripción dadas
     *
     * @param $role string Nombre del rol
     * @param $description string Descripción del rol
     * @return bool Si se creó exitosamente el rol
     */
    public function actionCreateRole($role, $description)
    {
        /**
         * @var $auth ManagerInterface
         */
        $auth = \Yii::$app->getAuthManager();
        $role = $auth->createRole($role);
        $role->description = $description;
        if ($auth->add($role))
            $this->stdout("Rol creado exitósamente\n", Console::FG_GREEN);
        else
            $this->stdout("Hubo un error al crear el rol\n", COnsole::FG_RED);
    }

    /**
     * Elimina un rol (por ende, todas las asignaciones son eliminadas también)
     *
     * @param $roleName string - Nombre del rol
     * @throws \yii\db\Exception
     */
    public function actionDeleteRole($roleName)
    {
        $auth = \Yii::$app->authManager;
        $role = $auth->getRole($roleName);
        if (!isset($role))
            throw new \yii\db\Exception("Role does not existc");
        $auth->remove($role);
        $this->stdout("Role removed successfully\n", Console::FG_GREEN);
    }

    /**
     * Asigna un rol a un usuario
     *
     * @param $username - Nombre de usuario (username)
     * @param $roleName - Nombre del rol
     * @return bool
     * @throws Exception
     */
    public function actionAssignRole($username, $roleName)
    {
        $auth = \Yii::$app->authManager;
        $user = User::findOne(['username' => $username]);
        if (!isset($user))
            throw new Exception("User not found\n");
        $role = $auth->getRole($roleName);
        if (!isset($role)) {
            $this->stdout("Role not found, aborting\n" . PHP_EOL, Console::FG_RED);
            return false;
        }
        $auth->assign($role, $user->id);
        $this->stdout("Role assigned successfully\n", Console::FG_GREEN);
    }

    /**
     * Remueve el rol del usuario indicado
     *
     * @param $username string - Username
     * @param $role_name string - Nombre del rol
     * @return bool
     * @throws \Exception
     */
    public function actionRemoveRole($username, $role_name)
    {
        $auth = \Yii::$app->authManager;
        $role = $auth->getRole($role_name);
        if (!isset($role_name))
            throw new \Exception("Role not found\n");
        $u = User::findOne(['username' => $username]);
        if (!isset($u))
            throw new \Exception("User not found\n");
        if ($auth->revoke($role, $u->id))
            $this->stdout("Role removed successfully\n", Console::FG_GREEN);
    }

    /**
     * Muestra todos los roles con los que cuenta un usuario
     *
     * @param $username
     * @throws \Exception
     */
    public function actionShowAssignments($username)
    {
        $u = User::findOne(['username' => $username]);
        if (!isset($u))
            throw new \Exception("User not found\n");
        $auth = \Yii::$app->authManager;
        $assignments = $auth->getAssignments($u->id);
        /**
         * @var $assignment Assignment
         */
        foreach ($assignments as $assignment) {
            $this->stdout("Name: $assignment->roleName" . PHP_EOL, Console::FG_CYAN);
        }
        echo PHP_EOL;
    }

    /**
     * Lista todos los roles
     */
    public function actionShowRoles()
    {
        $auth = \Yii::$app->authManager;
        /** @var Role[] $roles */
        $roles = $auth->getRoles();
        if (!isset($roles) || sizeof($roles) == 0) {
            $this->stdout("No roles available\n", Console::FG_CYAN);
            return true;
        }
        $amount = sizeof($roles);
        $this->stdout("There are $amount roles\n", Console::FG_CYAN);
        foreach ($roles as $role) {
            $this->stdout("Name: $role->name \n", Console::FG_GREEN);
            $this->stdout("Description: $role->description \n", Console::FG_GREY);
            echo PHP_EOL;
        }
        $this->stdout("Those are all available\n", Console::FG_GREEN);
        return true;
    }

}