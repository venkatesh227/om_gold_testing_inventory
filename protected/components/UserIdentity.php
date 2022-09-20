<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public $__id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */

	public function authenticate()
	{
			$user= Users::model()->findByAttributes(array('vcUserName'=>$this->username));

            if($user===null) {
                $this->errorCode = self::ERROR_USERNAME_INVALID;                
            }
            else if(!$user->validatePassword($this->password)) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            }
            else if($user->iStatus=='0') {
                $this->errorCode = "Account Not Activate";                
            }
            else
            { 
				Yii::app()->user->setState('__id', $user->iUserID);
				Yii::app()->user->setState('uname', $user->vcUserName);
				Yii::app()->user->setState('role_id', $user->iRoleID);
				Yii::app()->user->setState('userid', $user->iUserID);

				$this->errorCode = self::ERROR_NONE;
			}
		return !$this->errorCode;
	}	

	public function getId()
    {
        return $this->_id;
    }	
}