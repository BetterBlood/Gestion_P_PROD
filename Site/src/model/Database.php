<?php

/** 
 * Auteurs : Julien Leresche, Jeremiah Steiner et Ricardo Delgado Miranda
 * Date : 02.12.2020
 * Description : Page modèle de la base de données
*/

include "config.ini.php";

 class Database {


    // Variable de classe
    private $connector;

    /**
     * TODO: � compl�ter
     */
    public function __construct(){
        $user = $GLOBALS['MM_CONFIG']['database']['username'];
        $pass = $GLOBALS['MM_CONFIG']['database']['password'];
        $dbname = $GLOBALS['MM_CONFIG']['database']['dbname'];
        $host = $GLOBALS['MM_CONFIG']['database']['host'];
        $port = $GLOBALS['MM_CONFIG']['database']['port'];
        $charset = $GLOBALS['MM_CONFIG']['database']['charset'];
        try
        {
            $this->connector = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$dbname.';charset='. $charset, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch(exception $e){
            echo "connexion impossible";
        }
        //$this->connector = new PDO('mysql:host=localhost;dbname=db_nickname_julleresche;charset=utf8' , 'root', 'root');
    }

    /**
     * TODO: � compl�ter
     */
    private function querySimpleExecute($query){

        // TODO: permet de pr�parer et d�ex�cuter une requ�te de type simple (sans where)
    }

    /**
     * TODO: � compl�ter
     */
    private function queryPrepareExecute($query, $binds){    
        $req = $this->connector->prepare($query);
        if(isset($binds))
        {
            foreach($binds as $bind)
            {
                $req->bindValue($bind['marker'], $bind['var'], $bind['type']);
            }
        }
        $req->execute();
        return $req;
    }

    /**
     * TODO: � compl�ter
     */
    private function formatData($req){
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * TODO: � compl�ter
     */
    private function unsetData($req){
        $req->closeCursor();
    }

    /**
     * TODO: � compl�ter
     */
    public function getAllProjects(){
        $query = "SELECT * FROM t_project";
        $req = $this->queryPrepareExecute($query,null);
        $projects = $this->formatData($req);
        $this->unsetData($req);
        return $projects;
    }

    // public function getAllProjectsJoinTeacherJoinStudent()
    // {
    //     //$query = "SELECT * FROM t_project LEFT JOIN t_teacher ON t_project.idInitiator = t_teacher.idTeacher LEFT JOIN t_teacher ON t_project.idCoordinator = t_teacher.idTeacher";
    //     $query = "SELECT t_project.idProject, t_teacher.teaFirstName as 'test' FROM t_project LEFT JOIN t_teacher ON t_project.idInitiator = t_teacher.idTeacher 
    //     UNION ALL SELECT t_project.idProject, t_teacher.teaFirstName as 'test2' FROM t_project LEFT JOIN t_teacher ON t_project.idCoordinator = t_teacher.idTeacher";

    //     $req = $this->queryPrepareExecute($query,null);
    //     $projects = $this->formatData($req);
    //     $this->unsetData($req);
    //     return $projects;
    // }

    /**
     * TODO: � compl�ter
     */
    public function getAllTeachers(){
        $query = "SELECT * FROM t_teacher";
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }
    
    /**
     * TODO: � compl�ter
     */
    public function getAllStudents(){
        $query = "SELECT * FROM t_student";
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    /**
     * TODO: � compl�ter
     */
    public function getSomeStudents($request){
        $query = "SELECT * FROM t_student WHERE (CONCAT(stuFirstName, ' ', stuLastName, ' ', stuClass)) LIKE '%" . $request . "%'";
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    public function getStudentsBelongingToProject($id){
        $query = "SELECT * FROM t_belong NATURAL JOIN t_student WHERE idProject=" . $id;
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    /**
     * TODO: � compl�ter
     */
    public function getProjectById(int $idProject){
        $query = "SELECT * FROM t_project WHERE idProject=" . $idProject;
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result[0];
    }


    
    /**
     * TODO: � compl�ter
     */
    public function getTeacherById(int $idTeacher){
        $query = 'SELECT * FROM t_teacher WHERE  idTeacher =' . $idTeacher;
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result[0];
    }


    public function getSomeTeachers($request){
        $query = "SELECT * FROM t_teacher WHERE (CONCAT(teaFirstName, ' ', teaLastName)) LIKE '%" . $request . "%'";
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    public function insertTeacher($lastName, $firstName, $gender, $nickName, $origin, $section){
        $query = "INSERT INTO t_teacher (teaLastName, teaFirstName, teaGender, teaNickName, teaNicknameOrigin, idSection) VALUES (:lastname,:firstname,:gender,:nickname,:origin,:section)";
        $values = array(
            1=> array(
                'marker' => ':lastname',
                'var' => $lastName,
                'type' => PDO::PARAM_STR
            ),
            2=> array(
                'marker' => ':firstname',
                'var' => $firstName,
                'type' => PDO::PARAM_STR
            ),
            3=> array(
                'marker' => ':gender',
                'var' => $gender,
                'type' => PDO::PARAM_STR
            ),
            4=> array(
                'marker' => ':nickname',
                'var' => $nickName,
                'type' => PDO::PARAM_STR
            ),
            5=> array(
                'marker' => ':origin',
                'var' => $origin,
                'type' => PDO::PARAM_STR
            ),
            6=> array(
                'marker' => ':section',
                'var' => $section,
                'type' => PDO::PARAM_INT
            )
        );
        $req = $this->queryPrepareExecute($query,$values);
        $this->unsetData($req);
        header("location: index.php");
    }

    // Insérer un projet à la base de données
    public function insertProject($proName, $proDescription, $idInitiator){
        $query = "INSERT INTO t_project (proName, proDescription, idInitiator) VALUES (:proName, :proDescription, :idInitiator)";
        $values = array(
            1=> array(
                'marker' => ':proName',
                'var' => $proName,
                'type' => PDO::PARAM_STR
            ),
            2=> array(
                'marker' => ':proDescription',
                'var' => $proDescription,
                'type' => PDO::PARAM_STR
            ),
            3=> array(
                'marker' => ':idInitiator',
                'var' => $idInitiator,
                'type' => PDO::PARAM_STR
            )
        );
        $req = $this->queryPrepareExecute($query,$values);
        $this->unsetData($req);
        //header("location: index.php");
    }

    public function insertStudentIntoProject($idProject, $idStudent){
        $query = "INSERT INTO t_belong (idProject, idStudent) VALUES (:idPro, :idStu)";
        $values = array(
            1=> array(
                'marker' => ':idPro',
                'var' => $idProject,
                'type' => PDO::PARAM_INT
            ),
            2=> array(
                'marker' => ':idStu',
                'var' => $idStudent,
                'type' => PDO::PARAM_INT
            )
        );
        $req = $this->queryPrepareExecute($query,$values);
        $this->unsetData($req);
        //header("location: index.php");
    }

    public function deleteTeacher($id){
        $query = 'DELETE FROM t_teacher WHERE idTeacher =' . $id;
        $req = $this->queryPrepareExecute($query,null);
        $this->unsetData($req);
        header("location: index.php");
    }

    public function updateCoordinator($idTeacher,$idProject){
        $query = 'UPDATE t_project SET idCoordinator="' . $idTeacher . '" WHERE idProject =' . $idProject;
        $req = $this->queryPrepareExecute($query,null);
        $this->unsetData($req);
        //header("location: index.php");
    }

    /**
     * TODO: � compl�ter
     */
    public function getAllSections(){
        $query = "SELECT * FROM t_section";
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        return $result;
    }

    public function getStudentById($id)
    {
        $query = 'SELECT * FROM t_student WHERE  idStudent =' . $id;
        $req = $this->queryPrepareExecute($query,null);
        $student = $this->formatData($req);
        $this->unsetData($req);
        return $student[0];
    }

    public function getStudentsByProjectId($id)
    {
        $query = 'SELECT * FROM t_belong LEFT JOIN t_student ON t_belong.idStudent = t_student.idStudent WHERE t_belong.idProject = '. $id;
        $req = $this->queryPrepareExecute($query,null);
        $students = $this->formatData($req);
        $this->unsetData($req);
        return $students;
    }

    // + tous les autres m�thodes dont vous aurez besoin pour la suite (insertTeacher ... etc)
 }


?>