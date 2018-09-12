<?php 

/**
* User
*/
class User implements JsonSerializable
{
    const SESSION_USER_ID_KEY = "user_id";

    /**
     * char(10)
     * @var char(10) $user_id
     */
    public $user_id;
	/**
     * char(25)
     * @var char(25) name
     */
    public $name;
	/**
     * char(50)
     * @var char(50) $password
     */
    public $password;
	/**
     * char(2)
     * @var char(2) $present_level
     */
    public $present_level;
	/**
     * int(1)
     * @var int(1) $certificate_flag
     */
    public $certificate_flag;
	/**
     * char(2)
     * @var char(2) $next_level
     */
	public $next_level;
	/**
     * int(1)
     * @var int(1) $admin_flag
     */
	public $admin_flag;
	/**
     * int(1)
     * @var int(1) $del_flag
     */
	public $del_flag;
    
    function __construct($data) {
        if (isset($data['user_id'])) {
            $this->user_id = $data['user_id'];
        }
        if (isset($data['name'])) {
            $this->name = $data['name'];
        }
		if (isset($data['password'])) {
            $this->password = $data['password'];
        }
		if (isset($data['present_level'])) {
            $this->present_level = $data['present_level'];
        }
		if (isset($data['certificate_flag'])) {
            $this->certificate_flag = $data['certificate_flag'];
        }
		if (isset($data['next_level'])) {
            $this->next_level = $data['next_level'];
        }
		if (isset($data['admin_flag'])) {
            $this->admin_flag = $data['admin_flag'];
        }
		if (isset($data['del_flag'])) {
            $this->del_flag = $data['del_flag'];
        }
    }
	
    // lay danh sach user cua leader
    public function getListUserByLeader(){
        
        $res = array();
        
        User::getAllCapduoi($res, $this->user_id, $this->company_id);

        if(!in_array($this->user_id, $res)){
           $res[] = $this->user_id; 
        }
        
        $user_list = array();
        
                
        sort($res);
        
        foreach ($res as $key => $u) {
            $user_list[] = User::getByID($u, $this->company_id);
        }
    
        return $user_list;
    }

    /**
     * select from database where id=$id
     * @param  string $user_id user id
     * @return User     return null if not found
     */
	public static function getByID($user_id){
	    $user_id = DbAgent::queryEncode($user_id, DbAgent::$DB_STRING);

        $sql = 
            "SELECT user_t.user_id, user_t.name, user_t.password, user_t.present_level, user_t.certificate_flag,
                    user_t.next_level, user_t.admin_flag, user_t.del_flag
            FROM user_t
            WHERE user_id = $user_id";
        $record = Database::currentDb()->getRecord($sql);

        if ($record != null) {
            return new User($record);
        }

        return $record;
    }
    
    /**
     * select from database where name=$name
     * @param  string $name name
     * @return User     return null if not found
     */
    public static function getAllUser(){
        $sql = 
            "SELECT user_t.user_id, user_t.name, user_t.password, user_t.present_level, user_t.certificate_flag,
                    user_t.next_level, user_t.admin_flag, user_t.del_flag
            FROM user_t";
        
        $record = Database::currentDb()->getMultiRecord($sql, $t);        
        return $record;
    }
	
    public static function getCategory($company_id){
        
        $company_id = DbAgent::queryEncode($company_id, DbAgent::$DB_STRING);
        //company_id=$company_id
        $sql ="SELECT  *
            FROM category_t 
            WHERE del_flag = 0";
        $record = Database::currentDb()->getMultiRecord($sql, $t);

        return $record;
    }

    public static function getByIDAndPassword($user_id, $password){
        $user_id = DbAgent::queryEncode($user_id, DbAgent::$DB_STRING);
		$password= DbAgent::queryEncode($password, DbAgent::$DB_STRING);
        $sql = 
            "SELECT user_t.user_id, user_t.name, user_t.password, user_t.present_level, user_t.certificate_flag,
                    user_t.next_level, user_t.admin_flag, user_t.del_flag
            FROM user_t
            WHERE user_t.user_id = $user_id
                and user_t.password = $password";

        $record = Database::currentDb()->getRecord($sql);
		
        return $record;
    }
    // lay danh sach user theo Admin_Flag = 1
    public static function getUserIDListByAdmin()
	{
		$query = "SELECT user_t.user_id, user_t.name
		FROM user_t";	  
		$record = Database::currentDb()->getMultiRecord($query, $t);		
		return $record;
	}
	
	// lay danh sach user theo Admin_Flag = 2
    public static function getUserIDListByManager($company_id, $dep_id)
	{
		$company_id = DbAgent::queryEncode($company_id, DbAgent::$DB_STRING);
		$dep_id = DbAgent::queryEncode($dep_id, DbAgent::$DB_STRING);
		$query = "SELECT user_t.user_id, user_t.name, user_t.leader_id, user_t.dep_id, user_t.company_id
		FROM user_t, company_t, department_t
		where user_t.company_id = $company_id
		and user_t.dep_id = $dep_id
        and company_t.del_flag = 0
        and department_t.del_flag = 0
        and user_t.del_flag = 0
		and company_t.company_id = user_t.company_id 
        and department_t.company_id = user_t.company_id
        and department_t.dep_id = user_t.dep_id
		order by user_id;";	  
		$record = Database::currentDb()->getMultiRecord($query, $t);		
		return $record;
	}
    //edit level
    public static function editLevel($user_id, $present_level, $next_level)
    {
        $user_id = DbAgent::queryEncode($user_id, DbAgent::$DB_STRING);
        $present_level = DbAgent::queryEncode($present_level, DbAgent::$DB_STRING);
        $next_level = DbAgent::queryEncode($next_level, DbAgent::$DB_STRING);
        $query = "UPDATE user_t 
                  SET present_level = $present_level, next_level=$next_level
                  WHERE user_t.user_id = $user_id;";
        Database::currentDb()->execute($query);

    }

    // edit Password
    public static function editPassword($user_id, $password)
    {
        $user_id = DbAgent::queryEncode($user_id, DbAgent::$DB_STRING);
        $password = DbAgent::queryEncode($password, DbAgent::$DB_STRING);
        $query = "UPDATE user_t
                SET password = $password                     
                WHERE user_t.user_id = $user_id;";     
        Database::currentDb()->execute($query); 
    }
    
    /**
     * store current User
     * @var User
     */
    private static $_currentUser = null;

    /**
     * get current user.
     * @return User return null if not yet login
     */
    public static function getCurrentUser(){
        if (self::$_currentUser == null && isset($_SESSION[self::SESSION_USER_ID_KEY])) {
            self::$_currentUser = self::getByID($_SESSION[self::SESSION_USER_ID_KEY]);
        }

        return self::$_currentUser;
    }

    /**
     * login with $login
     * @param string $user_id
	 * @param string $password
     * @return boolean        true if success. false if error
     */
    public static function logIn($user_id, $password){
        unset($_SESSION[self::SESSION_USER_ID_KEY]);
        self::$_currentUser = self::getByIDAndPassword($user_id, $password);
        
        if (self::$_currentUser != null) {
            $_SESSION[self::SESSION_USER_ID_KEY] = self::$_currentUser['user_id'];
            return true;
        }
        return false;
    }

    /**
     * logout : unset session
     * @return [type] [description]
     */
    public static function logOut(){
        self::$_currentUser = null;
        unset($_SESSION[self::SESSION_USER_ID_KEY]);
    }

    /**
     * count all user
     * @return int [description]
     */
    public static function countUser(){
        $sql = "SELECT count(*) FROM user_t";
        $record = Database::currentDb()->getRecord($sql);

        if ($record != null) {
            return $record["count"];
        }

        return 0;
    }

    /**
     * count all user
     * @return int [description]
     */
    public static function countNotAdminUser(){
        $sql = "SELECT count(*) FROM user_t WHERE admin_flag = 0";
        $record = Database::currentDb()->getRecord($sql);

        if ($record != null) {
            return $record["count"];
        }

        return 0;
    }
    
    
    public static function getAllCapduoi(&$res, $user_id, $company_id){
        $company_id_encode = DbAgent::queryEncode($company_id, DbAgent::$DB_STRING);
        
        if (!is_array($user_id)) {
              $user_id = array($user_id);
        }
        
        if(count($user_id) == 0){
            return;
        }
        
        $user_id_map = array_map(function($ele){return DbAgent::queryEncode($ele, DbAgent::$DB_STRING);}, $user_id);
        $res_map = array_map(function($ele){return DbAgent::queryEncode($ele, DbAgent::$DB_STRING);}, $res);
        
        $values = implode(",", $user_id_map);
        $ress = implode(",", $res_map);
        
        $sql = "SELECT user_id 
                from user_t 
                left join company_t
                on user_t.company_id = company_t.company_id
                and company_t.del_flag = 0
                left join department_t
                on user_t.company_id = department_t.company_id
                and user_t.dep_id = department_t.dep_id
                and department_t.del_flag = 0
                where user_t.company_id=$company_id_encode
                and user_t.del_flag = 0 ";
        if ($ress != "") {
            $sql .= " and user_t.user_id not in($ress)";
        }
        if ($values != "") {
            $sql .= " and user_t.leader_id in($values)";
        }

        $records = Database::currentDb()->getMultiRecord($sql, $t);
        $user_arr = array_map(function($ele){return $ele['user_id'];}, $records);
        
        foreach ($user_arr as $key => $value) {
            $res[] = $value;
        }
        
        self::getAllCapduoi($res, $user_arr, $company_id);
    } 
    
    public function JsonSerialize(){
        $leader = User::getByID($this->leader_id, $this->company_id);
    
        return array( 
                    "user_id" => $this->user_id,
                    "company_id"=> $this->company_id,
                    "company_name"=> $this->company_name,
                    "dep_id" => $this->dep_id,
                    "dep_name"=> $this->dep_name,
                    "name"=> $this->name,
                    "leader_id"=> $this->leader_id,
                    "admin_flag"=> $this->admin_flag,
                    "maintenance_flag"=> $this->maintenance_flag,
                    "level"=> $this->level,
                    "password"=> $this->password,
                    "del_flag"=> $this->del_flag,
                    "isLeader" => $this->isLeader(),
                    "leader" => array(
                                "user_id" => $leader->user_id,
                                "name"=> $leader->name),
                    "year"=> $this->year,
                    "start_month"=> $this->start_month);  
    }
}
 ?>