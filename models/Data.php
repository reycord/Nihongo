<?php 

/**
* Data
*/
class Data
{	
	//  them tu hoc duoc len trong bang study_t
	public static function updateVocabulary($user_id,$type_id,$vocabulary_id){
		$user_id = DbAgent::queryEncode($user_id, DbAgent::$DB_NUMBER);
		$type_id = DbAgent::queryEncode($type_id, DbAgent::$DB_NUMBER);
		$vocabulary_id = DbAgent::queryEncode($vocabulary_id, DbAgent::$DB_NUMBER);
		$sql = "INSERT INTO study_t (user_id, type_id, content_id)
				VALUES ($user_id, $type_id,$vocabulary_id)";
				Database::currentDb()->execute($sql);

	} 
	// Lấy từ vựng theo id của bài học.
	public static function getVocabularyByIDLesson($lesson_id){
		$lesson_id = DbAgent::queryEncode($lesson_id, DbAgent::$DB_NUMBER);
		$sql = "SELECT a.lesson_title,b.vocabulary_id,b.vocabulary_word,b.vocabulary_kanji,b.vocabulary_amhan,b.vocabulary_mean
				FROM lesson_t a, vocabulary_t b
				WHERE a.lesson_id = $lesson_id AND b.lesson_id = a.lesson_id";
		$records = Database::currentDb()->getMultiRecord($sql, $total_row);
		return $records;
	}
	// Lấy ngữ pháp theo id của bài học
	public static function getGrammarByIDLesson($lesson_id){
		$lesson_id = DbAgent::queryEncode($lesson_id, DbAgent::$DB_NUMBER);
		$sql = "SELECT a.lesson_title,b.grammar_id,b.grammar_structure,b.grammar_mean,b.grammar_use,b.grammar_sample
				FROM lesson_t a, grammar_t b
				WHERE a.lesson_id = $lesson_id AND b.lesson_id = a.lesson_id";
		$records = Database::currentDb()->getMultiRecord($sql, $total_row);
		return $records;
	}
	// Lấy Level mục tiêu 
	public static function getCertificate(){
        $query = "SELECT certificate_t.certificate_id, certificate_t.certificate_title
            		FROM certificate_t
            		ORDER BY certificate_t.certificate_id desc";  
        
        $record = Database::currentDb()->getMultiRecord($query, $t);        
        return $record;
    }
	// Lấy danh sách bài học hiển thị ở trang cá nhân
	 public static function getListNameLesson($lesson_level, $user_id){
	    $lesson_level = DbAgent::queryEncode($lesson_level,DbAgent::$DB_NUMBER);
	    $user_id = DbAgent::queryEncode($user_id,DbAgent::$DB_NUMBER);
	    $sql = "SELECT a.lesson_id, a.lesson_title,
					(SELECT count(*)
                    FROM lesson_t, study_t, vocabulary_t
                    WHERE study_t.user_id = $user_id
                            AND study_t.type_id = '1'
                            AND lesson_t.lesson_id = a.lesson_id
                            AND study_t.content_id = vocabulary_t.vocabulary_id
                            AND vocabulary_t.lesson_id = lesson_t.lesson_id)  AS vocabulary,
					(SELECT count(*)
                    FROM lesson_t, vocabulary_t
                    WHERE lesson_t.lesson_id = a.lesson_id
                            AND vocabulary_t.lesson_id = lesson_t.lesson_id) as totalVocabulary,
                 	(SELECT count(*)
                    FROM lesson_t, study_t, grammar_t
                    WHERE study_t.user_id = $user_id
                            AND study_t.type_id = '2'
                            AND lesson_t.lesson_id = a.lesson_id
                            AND study_t.content_id = grammar_t.grammar_id
                            AND grammar_t.lesson_id = lesson_t.lesson_id)  AS grammar,
                 	(SELECT count(*)
                    FROM lesson_t, grammar_t
                    WHERE lesson_t.lesson_id = a.lesson_id
                            AND grammar_t.lesson_id = lesson_t.lesson_id) as totalGrammar

				FROM lesson_t a 
				WHERE a.lesson_level = $lesson_level
				ORDER BY a.lesson_level ASC";
	    $records = Database::currentDb()->getMultiRecord($sql, $total_row);
	    return $records;

  	}
  	public static function getTypeContent()
  	{
  		$sql = "SELECT type_id,type_content
  				FROM type_t";
  		$records = Database::currentDb()->getMultiRecord($sql, $total_row);
  		return $records;
  	}
	//////////////////// TEST - START ////////////////////
    public static function getMultiRecord(){
        $sql = "SELECT user_id, user_name, email, password, phone, address, type, signup_day, del_flag FROM user_t";
        $records = Database::currentDb()->getMultiRecord($sql, $total_row);
        return $records;
     }
	
	public static function getRecord(){
        $sql = "SELECT  user_id, user_name, email, password, phone, address, type, signup_day, del_flag FROM user_t where user_id = 1";
		$record = Database::currentDb()->getRecord($sql);
        return $record;
     }
	//////////////////// TEST - END ////////////////////
	
	//////////////////// HOME - START ////////////////////
	// Lấy số từ vựng + ngữ pháp đã học được ở next_level của currentUser
	public static function getUserAndNumberOfStudiedVocabGrammar(){
        // $query = "
        // SELECT user_t.user_id, user_t.name, user_t.password, user_t.present_level, user_t.certificate_flag,
               // user_t.next_level, user_t.admin_flag, user_t.del_flag, 
               // (SELECT count(*)
                // FROM lesson_t, study_t, vocabulary_t
                // WHERE study_t.user_id = user_t.user_id
                    // AND study_t.type_id = '1'
                    // AND lesson_t.lesson_level = user_t.next_level
                    // AND study_t.content_id = vocabulary_t.vocabulary_id
                    // AND vocabulary_t.lesson_id = lesson_t.lesson_id)  AS vocabulary,
               // (SELECT count(*)
                // FROM lesson_t, vocabulary_t
                // WHERE lesson_t.lesson_level = user_t.next_level
                    // AND vocabulary_t.lesson_id = lesson_t.lesson_id) as totalVocabulary,
               // (SELECT count(*)
                // FROM lesson_t, study_t, grammar_t
                // WHERE study_t.user_id = user_t.user_id
                    // AND study_t.type_id = '2'
                    // AND lesson_t.lesson_level = user_t.next_level
                    // AND study_t.content_id = grammar_t.grammar_id
                    // AND grammar_t.lesson_id = lesson_t.lesson_id)  AS grammar,
               // (SELECT count(*)
                // FROM lesson_t, grammar_t
                // WHERE lesson_t.lesson_level = user_t.next_level
                    // AND grammar_t.lesson_id = lesson_t.lesson_id) as totalGrammar
        // FROM user_t
        // ORDER BY user_t.user_id ASC";
        
        $query = "
            SELECT u.user_id, u.name, u.password, u.certificate_flag, u.admin_flag, u.del_flag,
                (SELECT DISTINCT(certificate_t.certificate_title)
                    FROM certificate_t
                    LEFT JOIN user_t u1
                  ON certificate_t.certificate_id = u1.present_level
                    WHERE u1.present_level = u.present_level) AS present_level,
                (SELECT DISTINCT(certificate_t.certificate_title)
                    FROM certificate_t
                    LEFT JOIN user_t u2
                  ON certificate_t.certificate_id = u2.next_level
                    WHERE u2.next_level = u.next_level) AS next_level, 
                (SELECT count(*)
                    FROM lesson_t, study_t, vocabulary_t
                    WHERE study_t.user_id = u.user_id
                            AND study_t.type_id = '1'
                            AND lesson_t.lesson_level = u.next_level
                            AND study_t.content_id = vocabulary_t.vocabulary_id
                            AND vocabulary_t.lesson_id = lesson_t.lesson_id)  AS vocabulary,
                 (SELECT count(*)
                    FROM lesson_t, vocabulary_t
                    WHERE lesson_t.lesson_level = u.next_level
                            AND vocabulary_t.lesson_id = lesson_t.lesson_id) as totalVocabulary,
                 (SELECT count(*)
                    FROM lesson_t, study_t, grammar_t
                    WHERE study_t.user_id = u.user_id
                            AND study_t.type_id = '2'
                            AND lesson_t.lesson_level = u.next_level
                            AND study_t.content_id = grammar_t.grammar_id
                            AND grammar_t.lesson_id = lesson_t.lesson_id)  AS grammar,
                 (SELECT count(*)
                    FROM lesson_t, grammar_t
                    WHERE lesson_t.lesson_level = u.next_level
                            AND grammar_t.lesson_id = lesson_t.lesson_id) as totalGrammar
        FROM user_t u
        ORDER BY u.user_id ASC ";
        
        $record = Database::currentDb()->getMultiRecord($query, $t);        
        return $record;
	}
	
	// Lấy số từ vựng + ngữ pháp cần học ở next_level của currentUser
    public static function getDataForChart(){
        $query = "
            select c.certificate_title as `level`, COUNT(*) as total, (
                select count(ct.certificate_title)
                from certificate_t ct
                LEFT OUTER JOIN user_t u on ct.certificate_id = u.present_level
                where u.certificate_flag = 1
                    and ct.certificate_id = c.certificate_id
                group by ct.certificate_title
                order by ct.certificate_title DESC) as cer
            from certificate_t c
            LEFT OUTER JOIN user_t u on c.certificate_id = u.present_level
            group by c.certificate_title
            order by c.certificate_title DESC
        ";
        
        $record = Database::currentDb()->getMultiRecord($query, $t);        
        return $record;
    }
    //////////////////// HOME - END ////////////////////
    
    //////////////////// TESTING - START ////////////////////
    public static function getLesson(){
        $query = "
            select lesson_t.lesson_id, lesson_t.lesson_title, lesson_t.lesson_level
            from lesson_t
        ";
        
        $record = Database::currentDb()->getMultiRecord($query, $t);        
        return $record;
    }
    
    public static function getLessonByLevelId($level_id){
        $level_id = DbAgent::queryEncode($level_id,DbAgent::$DB_NUMBER);
        
        $query = "
            select lesson_t.lesson_id, lesson_t.lesson_title
            from lesson_t
            where lesson_t.lesson_level = $level_id
        ";
        
        $record = Database::currentDb()->getMultiRecord($query, $t);        
        return $record;
    }
    
    public static function getVocabByLevelAndLessonId($level_id, $lesson_id){
        $level_id = DbAgent::queryEncode($level_id,DbAgent::$DB_NUMBER);
        $lesson_id = DbAgent::queryEncode($lesson_id,DbAgent::$DB_NUMBER);
        
        $query = "
            select v.vocabulary_word, v.vocabulary_mean, v.vocabulary_kanji
            from vocabulary_t v, lesson_t l
            where v.lesson_id = l.lesson_id
                and l.lesson_id = $lesson_id
                and l.lesson_level = $level_id
            ORDER BY RAND()
        ";
        
        $record = Database::currentDb()->getMultiRecord($query, $t);        
        return $record;
    }
    //////////////////// TESTING - END ////////////////////
    
    //////////////////// TESTING - START ////////////////////
    public static function getTrialTestingRequest($level_id){
        $level_id = DbAgent::queryEncode($level_id,DbAgent::$DB_NUMBER);
        
        $query = "
            select t.type_id, t.mondai, t.request_content
            from trial_testing_request_t t
            where t.certificate_id = $level_id
        ";
        
        $record = Database::currentDb()->getMultiRecord($query, $t);        
        return $record;
    }
    
    public static function getTrialTestingExam($level_id, $exam_id){
        $level_id = DbAgent::queryEncode($level_id,DbAgent::$DB_NUMBER);
        $exam_id = DbAgent::queryEncode($exam_id,DbAgent::$DB_NUMBER);
        
        $query = "
            select t.type_id, t.mondai, t.number, t.type_paragraph,
                    t.paragraph, t.question1, t.question2, t.question3, 
                    t.answer1, t.answer2, t.answer3, t.answer4, t.answer_correct
            from trial_testing_exam_t t
            where t.certificate_id = $level_id
                and t.exam = $exam_id
        ";
        
        $record = Database::currentDb()->getMultiRecord($query, $t);        
        return $record;
    }    
    
    public static function getListType($level_id, $exam_id){
        $level_id = DbAgent::queryEncode($level_id,DbAgent::$DB_NUMBER);
        $exam_id = DbAgent::queryEncode($exam_id,DbAgent::$DB_NUMBER);
        
        $query = "
            select DISTINCT t.type_id, type.type_content
            from trial_testing_exam_t t, type_t type
            where t.certificate_id = $level_id
                            and t.exam = $exam_id
                            and t.type_id = type.type_id
        ";
        
        $record = Database::currentDb()->getMultiRecord($query, $t); 
        return $record;
    } 
    
    public static function getListMondai($level_id, $exam_id, $type_id){
        $level_id = DbAgent::queryEncode($level_id,DbAgent::$DB_NUMBER);
        $exam_id = DbAgent::queryEncode($exam_id,DbAgent::$DB_NUMBER);
        $type_id = DbAgent::queryEncode($type_id,DbAgent::$DB_NUMBER);
        
        $query = "
            select count(DISTINCT t.mondai) as result
            from trial_testing_exam_t t
            where t.certificate_id = $level_id
                    and t.exam = $exam_id
                    and t.type_id = $type_id
        ";
        
        $record = Database::currentDb()->getRecord($query);
        return $record;
    }
    //////////////////// TESTING - END ////////////////////
}


 ?>