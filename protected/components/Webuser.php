<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class WebUser extends CWebUser
{
    /**
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed $params (opt) Parameters for this operation, usually the object to access.
     * @return bool Permission granted?
     */
    /*public function checkAccess($operation, $params=array())
    {
		$role_id=Yii::app()->user->role_id;	
		$permission_id=Permission::model()->findall("permission_key='$operation'");
		if(count($permission_id)>0  && RolesPermission::Model()->check_roles_permission($role_id,$permission_id[0]['permission_id'])==true)
		return true;
		else
		throw new CHttpException(403,'You are not authorized to perform this action.');
   }

    public function checkAccess_boolen($operation, $params=array())
    {
		$role_id=Yii::app()->user->role_id;	
		$permission_id=Permission::model()->findall("permission_key='$operation'");
		if(count($permission_id)>0  && RolesPermission::Model()->check_roles_permission($role_id,$permission_id[0]['permission_id'])==true)
		return true;
		else
		return false;
   }*/


}
?>