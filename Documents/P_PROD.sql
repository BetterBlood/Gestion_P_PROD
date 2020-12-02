

-- Database Section
-- ________________ 

create database db_P_PROD;
use db_P_PROD;


-- Tables Section
-- _____________ 

create table t_belong (
     idProject int not null,
     idStudent int not null,
     constraint ID_t_belong_ID primary key (idStudent, idProject));

create table t_comment (
     idComment int not null auto_increment,
     comContent varchar(200) not null,
     comDate date not null,
     idProject int not null,
     idStudent int not null,
     constraint ID_t_comment_ID primary key (idComment));

create table t_project (
     idProject int not null auto_increment,
     proName varchar(50) not null,
     proDescription varchar(200) not null,
     proStartingDate date not null,
     proEndingDate date not null,
     idCoordinator int null,
     idInitiator int not null,
     constraint ID_t_project_ID primary key (idProject));

create table t_student (
     idStudent int not null auto_increment,
     stuFirstName varchar(50) not null,
     stuLastName varchar(50) not null,
     stuUserName varchar(50) not null,
     stuPassword varchar(200) not null,
     constraint ID_t_student_ID primary key (idStudent));

create table t_teach (
     idProject int not null,
     idTeacher int not null,
     constraint ID_t_teach_ID primary key (idTeacher, idProject));

create table t_teacher (
     idTeacher int not null auto_increment,
     teaFirstName varchar(50) not null,
     teaLastName varchar(50) not null,
     teaUserName varchar(50) not null,
     teaPassword varchar(200) not null,
     constraint ID_t_teacher_ID primary key (idTeacher));


-- Constraints Section
-- ___________________ 

alter table t_belong add constraint FKt_b_t_s
     foreign key (idStudent)
     references t_student (idStudent);

alter table t_belong add constraint FKt_b_t_p_FK
     foreign key (idProject)
     references t_project (idProject);

alter table t_comment add constraint FKt_describe_FK
     foreign key (idProject)
     references t_project (idProject);

alter table t_comment add constraint FKt_write_FK
     foreign key (idStudent)
     references t_student (idStudent);

-- Not implemented
-- alter table t_project add constraint ID_t_project_CHK
--     check(exists(select * from t_teach
--                  where t_teach.idProject = idProject)); 

alter table t_teach add constraint FKt_t_t_t
     foreign key (idTeacher)
     references t_teacher (idTeacher);

alter table t_teach add constraint FKt_t_t_p_FK
     foreign key (idProject)
     references t_project (idProject);
	 
alter table t_project add constraint FKt_p_t_c_FK
     foreign key (idCoordinator)
     references t_teacher (idTeacher);

alter table t_project add constraint FKt_p_t_i_FK
     foreign key (idInitiator)
     references t_teacher (idTeacher);


-- Index Section
-- _____________ 

create unique index ID_t_belong_IND
     on t_belong (idStudent, idProject);

create index FKt_b_t_p_IND
     on t_belong (idProject);

create unique index ID_t_comment_IND
     on t_comment (idComment);

create index FKt_describe_IND
     on t_comment (idProject);

create index FKt_write_IND
     on t_comment (idStudent);

create unique index ID_t_project_IND
     on t_project (idProject);

create unique index ID_t_student_IND
     on t_student (idStudent);

create unique index ID_t_teach_IND
     on t_teach (idTeacher, idProject);

create index FKt_t_t_p_IND
     on t_teach (idProject);

create unique index ID_t_teacher_IND
     on t_teacher (idTeacher);

